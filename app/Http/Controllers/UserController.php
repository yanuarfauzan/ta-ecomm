<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
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
    public function addProductToCart(AddProductToCartRequest $request, $productId)
    {
        if ($this->user) {
            $user = $this->user;

            $cart = $user->cart()->create([
                'qty' => $request->qty,
            ]);
            $cartProductId = Str::uuid(36);
            $cart->hasProduct()->attach($productId, ['id' => $cartProductId]);
            $cartProduct = $cart->hasProduct()->wherePivot('id', $cartProductId)->first();
            collect($request->variation)->each(function ($variationItem) use ($cartProduct) {
                $cartProduct->pickedVariation()->attach($variationItem['variation_id'], ['variation_option_id' => $variationItem['variation_option_id'], 'id' => Str::uuid(36)]);
            });
            return response()->json(['message' => 'Berhasil menambahkan produk ke keranjang']);
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
