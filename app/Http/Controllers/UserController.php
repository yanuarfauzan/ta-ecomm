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
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
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

        $product = Product::where('id', $productId)->with('variation', 'variation.variationOption', 'hasCategory', 'variation.variationOption.productImage')->first();

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
        return view('user.detail-product', compact('categories', 'product', 'firstVarOption', 'firstVarOptionForCart', 'products', 'user'));
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
        return view('user.order', compact('usersCarts', 'user', 'defaultUserAdress', 'order'));
    }
    public function buyNow(Request $request)
    {
        $user = $this->user;
        $variationBuyNow = $request->variation;
        $countBuyNow = $request->count;
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
