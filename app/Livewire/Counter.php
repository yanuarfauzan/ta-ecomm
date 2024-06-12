<?php

namespace App\Livewire;

use App\Models\Cart;
use App\Models\Product;
use Livewire\Component;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;
use App\Traits\PreventDuplicateEvents;

class Counter extends Component
{
    use PreventDuplicateEvents;

    public $user;
    public $userCart;
    public $product;
    public $count;
    public $price;
    public $userCartId;
    public $receivedEventIds = [];
    public $listeners = ['changeTotalPrice'];
    public function mount($userCart, $product, $user)
    {
        $this->price = $product->price_after_additional ?? $product->price;
        $this->userCart = $userCart;
        $this->product = $product;
        $this->count = $this->userCart->qty;
        $this->user = $user;
        $this->userCart->update([
            'total_price' => $this->price 
        ]);
        if (isset($this->product->discount)) {
            $discountProduct = $this->price * $this->product->discount / 100;
            $this->userCart->update([
                'total_price_after_discount' => ($this->price - $discountProduct) * $this->userCart->qty,
                'total_discount' => $discountProduct * $this->userCart->qty
            ]);
        }
    }
    public function changeTotalPrice($fixPrice, $userCart, $eventId)
    {   
        if ($this->isDuplicateEvent($eventId)) return;
        Log::info('changeTotalPrice called with:', ['fixPrice' => $fixPrice, 'userCart' => $userCart]);

        $userCart = Cart::findOrFail($userCart['id']);
        $userCart->update([
            'total_price' => $fixPrice * $this->count
        ]);
        $this->userCart = $userCart;
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
            'total_price' => $this->price * $newQty,
        ]);
        $discountProduct = null;
        if (isset($this->product->discount)) {
            $discountProduct = $this->price * $this->product->discount / 100;
            $this->userCart->update([
                'total_price_after_discount' => ($this->price - $discountProduct) * $this->userCart->qty,
                'total_discount' => $discountProduct * $this->userCart->qty
            ]);
        }
    
        $this->dispatch('increaseQtyProduct', userCartId: $this->userCart->id, productPrice: $this->price, discountProduct: $discountProduct);
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
                'total_price' => $this->price * $newQty,
            ]);
            $discountProduct = null;
            if(isset($this->product->discount)) {
                $discountProduct = $this->price * $this->product->discount / 100;
                $this->userCart->update([
                    'total_price_after_discount' => ($this->price - $discountProduct) * $this->userCart->qty,
                    'total_discount' => $discountProduct * $this->userCart->qty
                ]);
            }
            $this->dispatch('decreaseQtyProduct', userCartId: $this->userCart->id, productPrice: $this->price, discountProduct: $discountProduct);
        }
    }
    public function deleteCartProduct($userCartId)
    {   
        $this->dispatch('deleteUserCart', userCartId: $userCartId);
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
    public function render()
    {
        return view('livewire.counter');
    }
    
}
