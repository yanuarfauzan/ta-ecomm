<?php

namespace App\Http\Controllers;

use App\Models\BannerHome;
use Exception;
use App\Models\Cart;
use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Str;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\VariationOption;
use App\Events\PaymentNotifEvent;
use Illuminate\Support\Facades\DB;
use App\Events\PaymentSuccessEvent;
use App\Models\ProvinciesAndCities;
use Illuminate\Support\Facades\Log;
use App\Models\MergeVariationOption;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use App\Http\Requests\AddAddressessRequest;
use App\Http\Requests\AddProductToCartRequest;

class UserController extends Controller
{
    public $user;
    public function __construct()
    {
        $this->user = auth()->user();
    }
    public function home(Request $request)
    {
        $take = $request->loadMoreProduct == true ? 16 : 16;
        $startIndex = $request->input('startIndex', 0);
        $categoryId = $request->category;
        $keyword = $request->keyword;
        $products = Product::with('hasImages', 'hasCategory')
            ->skip($startIndex)
            ->take($take)
            ->when($categoryId, function ($query) use ($categoryId) {
                $query->whereHas('hasCategory', function ($query1) use ($categoryId) {
                    $query1->where('category.id', $categoryId);
                });
            })
            ->when($keyword, function ($query) use ($keyword) {
                $query->where('name', 'like', '%' . $keyword . '%');
            })
            ->orderBy('created_at', 'desc')
            ->get();
        if ($request->loadMoreProduct == true) {
            return response()->json(
                [
                    'message' => 'load more products success',
                    'data' => $products,
                    'startIndex' => $startIndex + $take
                ],
                200
            );
        }
        $banners = BannerHome::all();
        $categories = Category::all();
        $title = 'Home';
        return view('user.home', compact('products', 'categories', 'startIndex', 'banners', 'title'));
    }
    public function addAddresses(AddAddressessRequest $request)
    {
        if ($this->user) {
            collect($request->address)->each(function ($item) {
                $this->user->address()->create([
                    'address' => $item['address'],
                    'postal_code' => $item['postal_code'],
                    'province' => $item['province'],
                    'city' => $item['city'],
                    'detail' => $item['detail']
                ]);
            });
            return response()->json(['message' => 'Berhasil menambahkan alamat']);
        } else {
            return response()->json(['message' => 'Anda harus login terlebih dahulu']);
        }
    }
    public function showCart(Request $request)
    {
        $user = $this->user;
        $usersCarts = $user?->cart()->with(
            'pickedVariation.variationOption',
            'hasProduct',
            'hasProduct.pickedVariation',
            'hasProduct.pickedVariationOption',
            'hasProduct.variation',
            'hasProduct.variation.variationOption'
        )->get();
        $title = 'Keranjang';
        return view('user.cart', compact('usersCarts', 'user', 'title'));
    }
    public function isCartExist($productId)
    {
        $userCart = $this->user->cart()->whereHas('hasProduct', function ($query) use ($productId) {
            $query->where('product_id', $productId);
        })->first();
        return $userCart;
    }
    public function isVariationDifferent($cartProduct, $request)
    {
        $isDifferent = false;
        collect($request['variation'])->each(function ($variationItem, $index) use (&$isDifferent, $cartProduct) {
            $variation = $cartProduct->pickedVariation()->wherePivot('variation_id', $variationItem['variation_id'])->first();
            $variationOption = $cartProduct->pickedVariationOption()->wherePivot('variation_option_id', $variationItem['variation_option_id'])->first();
            if (!isset($variation) || !isset($variationOption)) {
                $isDifferent = true;
            } else {
                $isDifferent = false;
            }
        });
        return $isDifferent;
    }
    public function addProductToFav($productId)
    {
        if ($this->user) {
            $favouriteProduct = $this->user->favouriteProduct();
            if (!$this->user->favouriteProduct->contains($productId)) {
                $favouriteProduct->attach($productId, ['id' => Str::uuid(36)]);
                return response()->json(['message' => 'Berhasil menambahkan produk ke favorit']);
            } else {
                $favouriteProduct->detach($productId);
                return response()->json(['message' => 'Berhasil menghapus produk dari favorit']);
            }
        } else {
            return response()->json(['message' => 'Anda harus login terlebih dahulu']);
        }
    }
    public function detailProduct(Request $request, $productId)
    {
        $user = $this->user;
        if ($user) {
            $defaultUserAddress = $user->userAddresses->where('is_default', true)->first();
        } else {
            $defaultUserAddress = [];
        }
        if ($defaultUserAddress === null) {
            return back()->with(['showModal' => true]);
        }

        $product = Product::where('id', $productId)->with(
            'variation',
            'variation.variationOption',
            'hasCategory',
            'variation.variationOption.productImage',
            'productAssessment'
        )->first();
        $firstVarOption = '';

        $dataForAmounts = [
            $product->variation()->first()->id,
            $product->variation()->first()->variationOption()->first()->name,
            $product->variation()->first()->variationOption()->first()?->productImage()
                ->first()?->filepath_image
        ];
        $dataForCart = [
            $product->variation()->first()->id,
            $product->variation()->first()->variationOption()->first()->id,
            $product->variation()->first()->variationOption()->first()?->productImage()
                ->first()?->filepath_image
        ];

        $take = $request->loadMoreProduct == true ? 16 : 16;
        $startIndex = $request->input('startIndex', 0);
        $products = Product::with('hasImages')->skip($startIndex)->take($take)->get();

        $firstVarOption = implode('_', $dataForAmounts);
        $firstVarOptionForCart = implode('_', $dataForCart);
        $categories = Category::all();


        $totalReviews = 0;
        $positiveReviews = 0;
        $fiveStarsCount = 0;
        $percentFiveStars = 0;
        $fourStarsCount = 0;
        $percentFourStars = 0;
        $threeStarsCount = 0;
        $percentThreeStars = 0;
        $twoStarsCount = 0;
        $percentTwoStars = 0;
        $oneStarsCount = 0;
        $percentOneStars = 0;
        $acumulatedRating = 0;
        $acumulatedInPercentRating = 0;
        $totalRating = 0;

        if ($totalReviews = $product->productAssessment()->count()) {
            $positiveReviews = $product->productAssessment()->whereIn('rating', [4, 5])->count();

            $fiveStarsCount = $product->productAssessment()->where('rating', 5)->count();
            $percentFiveStars = number_format(($fiveStarsCount / $totalReviews) * 100, 2);

            $fourStarsCount = $product->productAssessment()->where('rating', 4)->count();
            $percentFourStars = number_format(($fourStarsCount / $totalReviews) * 100, 2);

            $threeStarsCount = $product->productAssessment()->where('rating', 3)->count();
            $percentThreeStars = number_format(($threeStarsCount / $totalReviews) * 100, 2);

            $twoStarsCount = $product->productAssessment()->where('rating', 2)->count();
            $percentTwoStars = number_format(($twoStarsCount / $totalReviews) * 100, 2);

            $oneStarsCount = $product->productAssessment()->where('rating', 1)->count();
            $percentOneStars = number_format(($oneStarsCount / $totalReviews) * 100, 2);

            $acumulatedRating = round($product->productAssessment()->avg('rating'), 1);
            // Percentage of positive reviews to total reviews with 2 decimal places
            $acumulatedInPercentRating = round(($positiveReviews / $totalReviews) * 100);

            $totalRating = $product->productAssessment()->sum('rating');
        }

        if ($user) {
            $costs = $this->getCostValueShipping($product, $defaultUserAddress);
            $costResults = $costs->json()['rajaongkir']['results'][0];
            $defaultCost = $costs->json()['rajaongkir']['results'][0]['costs'][0];
        } else {
            $costs = [];
            $costResults = [];
            $defaultCost = [];
        }
        $product->update([
            'rate' => $acumulatedRating
        ]);
        $orderFromBuyNow = Order::where('product_id', $productId)->where('order_status', 'completed')->count();
        $orderFromCart = Order::whereNull('product_id')->where('order_status', 'completed')->count();
        $totalOrders = $orderFromBuyNow + $orderFromCart;
        $totalReviews = $product->productAssessment()->count();
        $title = 'Detail Produk';
        return view(
            'user.detail-product',
            compact(
                'title',
                'categories',
                'product',
                'firstVarOption',
                'firstVarOptionForCart',
                'products',
                'user',
                'defaultUserAddress',
                'costResults',
                'defaultCost',
                'acumulatedRating',
                'acumulatedInPercentRating',
                'totalRating',
                'totalReviews',
                'percentFiveStars',
                'fiveStarsCount',
                'percentFourStars',
                'fourStarsCount',
                'percentThreeStars',
                'threeStarsCount',
                'percentTwoStars',
                'twoStarsCount',
                'percentOneStars',
                'oneStarsCount',
                'totalOrders',
                'totalReviews'
            )
        );
    }

    public function getCostValueShipping($product, $defaultUserAddress)
    {
        $user = $this->user;
        $defaultOperatorAddress = User::where('role', 'operator')->first()->userAddresses->where('is_default')->first();
        $userCityId = ProvinciesAndCities::where('city_name', $defaultUserAddress->city)->first()->city_id;
        $operatorCityId = ProvinciesAndCities::where('city_name', $defaultOperatorAddress->city)->first()->city_id;
        try {
            $costs = Http::withHeaders([
                'key' => env('API_KEY_RAJAONGKIR')
            ])->post(env('API_BASE_URL_RAJA_ONGKIR') . '/cost', [
                        'origin' => $operatorCityId,
                        'destination' => $userCityId,
                        'weight' => $product->weight,
                        'courier' => 'jne'
                    ]);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
        }
        return $costs;
    }

    public function order(Request $request)
    {
        $user = $this->user;
        $defaultUserAdress = $this->user->userAddresses->where('is_default', true)->first();

        $usersCarts = $user->cart()->whereIn('id', $request->cartIds)
            ->with(
                'hasProduct',
                'hasProduct.pickedVariation',
                'hasProduct.pickedVariationOption',
                'hasProduct.variation',
                'hasProduct.voucher',
                'hasProduct.variation.variationOption'
            )
            ->get();

        $cartProductIds = $usersCarts->map(function ($userCart) {
            return $userCart->hasProduct->pluck('pivot.id');
        })->flatten();
        $cartProductIds = $cartProductIds->unique();
        $existOrders = Order::whereHas('cartProduct', function ($query) use ($cartProductIds) {
            $query->whereIn('id', $cartProductIds)->where('order_status', 'unpaid');
        })->get();
        if (!count($existOrders) == 0) {
            $order = $existOrders->first();
        } else {
            $order = Order::create([
                'user_id' => $user->id,
                'order_number' => $this->generateOrderNumber(),
                'order_date' => date('Ymd'),
                'order_status' => 'unpaid'
            ]);
            $usersCarts->each(function ($cart) use ($order) {
                DB::table('cart_product')
                    ->where('product_id', $cart->hasProduct->first()->id)
                    ->update(['order_id' => $order->id]);
            });
            $totalAllPrice = $usersCarts->reduce(function ($total, $cart) {
                $product = $cart->hasProduct->first();
                if ($product->discount) {
                    return $total + $cart->total_price_after_discount;
                } else {
                    return $total + $cart->total_price;
                }
            }, 0);
            $order->update([
                'total_price' => $totalAllPrice,
            ]);
        }

        $productVoucher = $usersCarts->map(function ($userCart) {
            $product = $userCart->hasProduct->first();
            if ($product && $product->voucher()->exists()) {
                return $product->voucher; // Tidak perlu memanggil get() lagi
            }
            return collect();
        })->filter(function ($voucher) {
            return $voucher->isNotEmpty(); // Memastikan kita hanya mengembalikan voucher yang tidak kosong
        })->flatten()->unique('id');

        $userAddresses = $order->user->userAddresses()->get();
        $title = 'Pesanan';
        return view('user.order', compact('usersCarts', 'user', 'defaultUserAdress', 'order', 'productVoucher', 'userAddresses', 'title'));
    }
    public function buyNow(Request $request)
    {
        $user = $this->user;
        $variationBuyNow = $request->variation;
        $countBuyNow = $request->qty;
        $totalPriceBuyNow = $request->totalPrice;
        $defaultUserAdress = $this->user->userAddresses->where('is_default', true)->first();
        $productBuyNow = Product::findOrFail($request->productId);

        $order = $user->order()->where('product_id', $request->productId)
            ->whereIn('order_status', ['unpaid', 'pending'])->first();
        if (!isset($order)) {
            $order = $user->order()->create([
                'product_id' => $request->productId,
                'order_number' => $this->generateOrderNumber(),
                'order_date' => date('Ymd'),
                'qty' => $countBuyNow,
                'total_price' => isset($productBuyNow->discount) ?
                    $countBuyNow * $productBuyNow->price_after_dsicount
                    : $countBuyNow * $totalPriceBuyNow,
                'order_status' => 'unpaid'
            ]);
            collect($variationBuyNow)->each(function ($variation) use ($order, $request) {
                $variationId = explode('_', $variation)[0];
                $variationOptionId = explode('_', $variation)[1];
                $productId = $request->productId;
                $order->pickedVariation()->attach(
                    $variationId,
                    [
                        'id' => Str::uuid(36),
                        'product_id' => $productId,
                        'variation_option_id' => $variationOptionId
                    ]
                );
            });
        } else {
            if ($countBuyNow != $order->qty) {
                $order->update([
                    'qty' => $countBuyNow,
                    'order_date' => date('Ymd'),
                    'total_price' => isset($productBuyNow->discount) ?
                        $countBuyNow * $productBuyNow->price_after_dsicount
                        : $countBuyNow * $totalPriceBuyNow,
                ]);
            }
        }
        $productVoucher = $productBuyNow->voucher()->get();
        $userAddresses = $order->user->userAddresses()->get();
        $title = 'Pesanan';
        return view(
            'user.order',
            compact(
                'title',
                'productBuyNow',
                'order',
                'user',
                'defaultUserAdress',
                'countBuyNow',
                'variationBuyNow',
                'productVoucher',
                'userAddresses',
                'totalPriceBuyNow'
            )
        );
    }
    private function generateOrderNumber()
    {
        $prefix = 'ECM-';
        $date = date('YmdHis');
        $randomNumber = rand(10000, 99999);
        return $prefix . $date . '-' . $randomNumber;
    }

    public function afterPayment(Request $request)
    {
        try {
            $order = Order::where('order_number', $request->order_id)->first();
            $user = $order->user()->first();
            $serverKey = config('midtrans.serverKey');
            $hashed = base64_encode($serverKey . ':');
            $response = Http::withHeaders([
                'Accept' => 'application/json',
                'Authorization' => 'Basic ' . $hashed
            ])
            ->get('https://api.sandbox.midtrans.com/v2/' . $request->order_id . '/status');
            $response = $response->json();
            switch ($response['transaction_status']) {
                case 'settlement':
                case 'success':
                case 'capture':
                    $order->update(['order_status' => 'paid']);
                    if ($order->product_id) {
                        $varOptionIds = $order->pickedVariationOption->pluck('id');
                        $mergeVarOption = MergeVariationOption::whereIn('variation_option_1_id', $varOptionIds)
                            ->whereIn('variation_option_2_id', $varOptionIds)
                            ->first();
                        $mergeVarOption->update([
                            'merge_stock' => $mergeVarOption->merge_stock - $order->qty
                        ]);
                    }
                    $message = '<strong class="ms-4"><h6>Pembayaran berhasil!🎉 </h6></strong>' .
                        'Total Pembayaran : <strong>Rp ' . number_format($response['gross_amount'], 2, ',', '.') . '</strong><br>' .
                        'Metode Pembayaran : <strong>' . $response['acquirer'] . '</strong><br>' .
                        'Tanggal Transaksi : <strong>' . Carbon::parse($response['transaction_time'])->format('d-m-Y') . '</strong><br>' .
                        '<strong>Terima kasih telah berbelanja dengan kami!</strong>
                        <hr>';
                    $message = htmlspecialchars_decode($message);
                    $notif = Notification::create([
                        'content' => $message
                    ]);
                    $user->notification()->attach($notif->id, ['id' => Str::uuid(36), 'is_read' => false, 'notification_id' => $notif->id, 'user_id' => $user->id]);
                    Log::info($message);
                    event(new PaymentNotifEvent($user->id, $message));
                    if ($request->payFrom == 'profile') {
                        return redirect()->route('user-profile');
                    } else {
                        return redirect()->route('user-home');
                    }
                case 'pending':
                    $order->update(['order_status' => 'pending']);
                    $message = 'Mohon segera lakukan pembayaran untuk pesanan Anda.
                        Pesanan Anda saat ini dalam status "Pending Pembayaran".
                        Kami akan memberitahu Anda segera setelah pembayaran Anda berhasil diproses.
                        Terima kasih atas kerjasama Anda!';
                    Log::info($message);
                    event(new PaymentNotifEvent($user->id, $message));
                    return response()->json($response);
                case 'expire':
                    $order->update(['order_status' => 'failed']);
                    $message = 'Maaf, pembayaran Anda untuk pesanan telah kadaluarsa.
                        Pesanan Anda saat ini dalam status "Pembayaran Kadaluarsa".
                        Silakan membuat pesanan baru jika Anda masih tertarik dengan produk kami.
                        Terima kasih atas perhatiannya.';
                    Log::info($message);
                    $notif = Notification::create([
                        'content' => $message
                    ]);
                    $user->notification()->attach($notif->id, ['id' => Str::uuid(36), 'is_read' => false, 'notification_id' => $notif->id, 'user_id' => $user->id]);
                    event(new PaymentNotifEvent($user->id, $message));
                    return response()->json($response);
            }
        } catch (Exception $e) {
            Log::error($e->getMessage());
        }
    }
    public function profile()
    {
        $user = User::with(
            'userAddresses',
            'order',
            'order.product',
            'order.product.pickedVariationOption',
            'notification'
        )->findOrFail($this->user->id);
        $title = 'Profil';
        return view('user.profile', compact('user', 'title'));
    }
}
