<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Str;

class Counter extends Component
{

    public $user;
    public $userCart;
    public $product;
    public $count;
    public $userCartId;
    public function mount($userCart, $product, $user)
    {
        $this->userCart = $userCart;
        $this->product = $product;
        $this->count = $this->userCart->qty;
        $this->user = $user;
    }
    public function render()
    {
        return view('livewire.counter');
    }

    public function increase()
    {
        $this->count = $this->userCart->qty + 1;

        // Perbarui nilai qty
        $newQty = $this->userCart->qty + 1;
        $this->userCart->update([
            'qty' => $newQty
        ]);
        
        $this->userCart->update([
            'total_price' => $this->product->price * $newQty,
        ]);
        $discountProduct = null;
        if (isset($this->product->discount)) {
            $discountProduct = $this->product->price * $this->product->discount / 100;
            $this->userCart->update([
                'total_price_after_discount' => ($this->product->price - $discountProduct) * $this->userCart->qty,
                'total_discount' => $discountProduct * $this->userCart->qty
            ]);
        }
        
        $this->dispatch('increaseQtyProduct', userCartId: $this->userCart->id, productPrice: $this->product->price, discountProduct: $discountProduct);
    }

    public function decrease()
    {
        if ($this->userCart->qty > 1) {
            $this->count = $this->userCart->qty - 1;
    
            $newQty = $this->userCart->qty - 1;
            $this->userCart->update([
                'qty' => $newQty
            ]);
            
            
            $this->userCart->update([
                'total_price' => $this->product->price * $newQty,
            ]);
            $discountProduct = null;
            if(isset($this->product->discount)) {
                $discountProduct = $this->product->price * $this->product->discount / 100;
                $this->userCart->update([
                    'total_price_after_discount' => ($this->product->price - $discountProduct) * $this->userCart->qty,
                    'total_discount' => $discountProduct * $this->userCart->qty
                ]);
            }
            $this->dispatch('decreaseQtyProduct', userCartId: $this->userCart->id, productPrice: $this->product->price, discountProduct: $discountProduct);
        }
    }

    public function deleteCartProduct()
    {   
        $this->userCart->delete();
    }

    public function addCartProductToFav()
    {
        $favouriteProduct = $this->userCart->user->favouriteProduct();
        $isProductFav = $favouriteProduct->where('product_id', $this->product->id)->exists();
        if (!$isProductFav) {
            $favouriteProduct->attach($this->product->id, ['id' => Str::uuid(36)]);
        } else {
            $favouriteProduct->detach($this->product->id);
        }

        $this->userCartId = $this->userCart->id;
    }
    
}
