<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\VariationOption;
use Illuminate\Support\Facades\DB;
use App\Models\ProvinciesAndCities;
use Illuminate\Support\Facades\Log;
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
        $categories = Category::all();
        $take = $request->loadMoreProduct == true ? 16 : 16;
        $startIndex = $request->input('startIndex', 0);
        $products = Product::with('hasImages')->skip($startIndex)->take($take)->get();
        if ($request->loadMoreProduct == true) {
            return response()->json(['message' => 'load more products success', 'data' => $products, 'startIndex' => $startIndex + $take], 200);
        }
        return view('user.home', compact('products', 'categories', 'startIndex'));
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
        $usersCarts = $user?->cart()->with('hasProduct', 'hasProduct.pickedVariation', 'hasProduct.pickedVariationOption', 'hasProduct.variation', 'hasProduct.variation.variationOption')->get();
        return view('user.cart', compact('usersCarts', 'user'));
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
            if (!isset ($variation) || !isset ($variationOption)) {
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
        $defaultUserAddress = $user->userAddresses->where('is_default', true)->first();

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
            $product->variation()->first()->variationOption()->first()->productImage()->first()->filepath_image
        ];
        $dataForCart = [
            $product->variation()->first()->id,
            $product->variation()->first()->variationOption()->first()->id,
            $product->variation()->first()->variationOption()->first()->productImage()->first()->filepath_image
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

            // Average rating calculation with 2 decimal places
            $acumulatedRating = round($product->productAssessment()->avg('rating'), 1);
            // Percentage of positive reviews to total reviews with 2 decimal places
            $acumulatedInPercentRating = round(($positiveReviews / $totalReviews) * 100);

            $totalRating = $product->productAssessment()->sum('rating');
        }

        $costs = $this->getCostValueShipping($product, $defaultUserAddress);
        $costResults = $costs->json()['rajaongkir']['results'][0];
        $defaultCost = $costs->json()['rajaongkir']['results'][0]['costs'][0];

        return view(
            'user.detail-product',
            compact(
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
            $query->whereIn('id', $cartProductIds);
        })->get();
        if (!count($existOrders) == 0) {
            $order = $existOrders->first();
        } else {
            $order = Order::create([
                'user_id' => $user->id,
                'order_number' => $this->generateOrderNumber(),
                'order_date' => date('Ymd'),
                'order_status' => 'pending'
            ]);
            $usersCarts->each(function ($cart) use ($order) {
                DB::table('cart_product')
                    ->where('product_id', $cart->hasProduct->first()->id)
                    ->update(['order_id' => $order->id]);
            });
            $totalAllPrice = $usersCarts->pluck('total_price')->sum();
            $order->update([
                'total_price' => $totalAllPrice,
            ]);
        }
        
        $productVoucher = $usersCarts->map(function ($userCart) {
            $product = $userCart->hasProduct->first();
            if ($product && $product->voucher()->exists()) {
                return $product->voucher()->get();
            }
            return collect();  // Return empty collection if no voucher exists
        })->filter()->flatten();
        return view('user.order', compact('usersCarts', 'user', 'defaultUserAdress', 'order', 'productVoucher'));
    }
    public function buyNow(Request $request)
    {
        $user = $this->user;
        $variationBuyNow = $request->variation;
        $countBuyNow = $request->qty;
        $defaultUserAdress = $this->user->userAddresses->where('is_default', true)->first();
        $productBuyNow = Product::findOrFail($request->productId);
        $order = $user->order()->create([
            'product_id' => $request->productId,
            'order_number' => $this->generateOrderNumber(),
            'order_date' => date('Ymd'),
            'total_price' => isset($productBuyNow->discount) ? $productBuyNow->price_after_discount : $productBuyNow->price,
            'order_status' => 'pending'
        ]);

        return view('user.order', compact('productBuyNow', 'order', 'user', 'defaultUserAdress', 'countBuyNow', 'variationBuyNow'));

    }
    private function generateOrderNumber()
    {
        $prefix = 'ECM-';
        $date = date('YmdHis');
        $randomNumber = rand(10000, 99999);
        return $prefix . $date . '-' . $randomNumber;
    }
    public function callBackPaymentGateway(Request $request)
    {
        Log::info('Callback Duitku received:', $request->all());
    }
}
