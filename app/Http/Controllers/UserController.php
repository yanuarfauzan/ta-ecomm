<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\VariationOption;
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
        $products = Product::skip($startIndex)->take($take)->get();
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
    public function showCart()
    {
        $user = User::where('id', '9bb843a9-7943-488a-bbf2-cadfce85c475')->first();
        $usersCarts = $user->cart()->with('hasProduct', 'hasProduct.pickedVariation', 'hasProduct.pickedVariationOption', 'hasProduct.variation', 'hasProduct.variation.variationOption')->get();
        // FIXME: referensi dari cart
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
    public function addProductToCart(AddProductToCartRequest $request, $productId)
    {
        $user = $this->user;
        $product = Product::findOrFail($productId);
        $cartProduct = $this->isCartExist($productId);
        if ($user) {
            $cartProductId = Str::uuid(36);
            if ($cartProduct?->all() == null) {
                $cart = $user->cart()->create([
                    'qty' => $request->qty,
                    'total_price' => $product->price * $request->qty
                ]);
                $cart->hasProduct()->attach($productId, ['id' => $cartProductId]);
                $cartProduct = $cart->hasProduct()->wherePivot('id', $cartProductId)->first();
                collect($request->variation)->each(function ($variationItem) use ($cartProduct) {
                    $cartProduct->pickedVariation()->attach([
                        $variationItem['variation_id'] => ['variation_option_id' => $variationItem['variation_option_id'], 'id' => Str::uuid(36)]
                    ]);
                });
                return response()->json(['message' => 'Berhasil menambahkan produk ke keranjang']);
            } else {
                $cartProductId = Str::uuid(36);
                if ($this->isVariationDifferent($cartProduct, $request->all())) {
                    $cart = $user->cart()->create([
                        'qty' => $request->qty,
                        'total_price' => $product->price * $request->qty
                    ]);
                    $cart->hasProduct()->attach($productId, ['id' => $cartProductId]);
                    $cartProduct = $cart->hasProduct()->wherePivot('id', $cartProductId)->first();
                    collect($request->variation)->each(function ($variationItem) use ($cartProduct) {
                        $cartProduct->pickedVariation()->attach([
                            $variationItem['variation_id'] => ['variation_option_id' => $variationItem['variation_option_id'], 'id' => Str::uuid(36)]
                        ]);
                    });
                    return response()->json(['message' => 'Berhasil menambahkan produk dengan variasi berbeda ke keranjang']);
                } else {
                    $cartProduct = $cartProduct->cart()->first();
                    $cartProduct->update([
                        'qty' => $cartProduct->qty + $request->qty,
                        'total_price' => $product->price * $request->qty
                    ]);
                    return response()->json(['message' => 'Produk sudah dimasukkan ke keranjang, jumlah ditambahkan']);
                }
            }
        } else {
            return response()->json(['message' => 'Anda harus login terlebih dahulu']);
        }
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
}
