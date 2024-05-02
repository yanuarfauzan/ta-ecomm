<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Log;

class Product extends Component
{
    public $usersCarts;
    public $checkedProducts = [];
    public $totalPrice;
    public $totalDiscount;
    protected $listeners = ['toggleChecked', 'toggleAllChecked', 'toggleAllUnCheck', 'decreaseQtyProduct', 'increaseQtyProduct'];

    public function mount($usersCarts)
    {
        $this->totalPrice = 0;
        $this->totalDiscount = 0;
        $this->usersCarts = $usersCarts;
    }
    public function decreaseQtyProduct($userCartId, $productPrice, $discountProduct)
    {
        if (in_array($userCartId, $this->checkedProducts)) {
            $this->totalPrice -= $productPrice;
            if (isset($discountProduct)) {
                $this->totalDiscount -= $discountProduct;
            }
        }
    }
    public function increaseQtyProduct($userCartId, $productPrice, $discountProduct)
    {
        if (in_array($userCartId, $this->checkedProducts)) {
            $this->totalPrice += $productPrice;
            if (isset($discountProduct)) {
                $this->totalDiscount += $discountProduct;
            }
        }
    }
    public function toggleAllChecked()
    {
        $this->totalPrice = 0;
        $this->totalDiscount = 0;
        foreach ($this->usersCarts as $userCart) {
            $this->checkedProducts[] = $userCart['id'];
            $this->totalPrice += $userCart['total_price'];
            if (isset($userCart->hasProduct->first()->discount)) {
                $this->totalDiscount += $userCart['total_discount'];
            }
        }
    }
    public function toggleAllUnCheck()
    {
        $this->totalPrice = 0;
        $this->totalDiscount = 0;
        array_splice($this->checkedProducts, 0);
    }
    public function toggleChecked($userCartId)
    {
        if (in_array($userCartId, $this->checkedProducts)) {
            $this->checkedProducts = array_diff($this->checkedProducts, [$userCartId]);
            $this->calculateTotalPrice(); // Perbarui total harga setelah menghapus produk yang dicentang
        } else {
            $this->checkedProducts[] = $userCartId;
            $this->calculateTotalPrice(); // Perbarui total harga setelah menambahkan produk yang dicentang
        }

        $this->calculateTotalPrice();
    }
    public function calculateTotalPrice()
    {
        $this->totalPrice = 0;
        $this->totalDiscount = 0;
    
        foreach ($this->usersCarts as $userCart) {
            if (in_array($userCart['id'], $this->checkedProducts)) {
                $this->totalPrice += $userCart['total_price'];
                if (isset($userCart->hasProduct->first()->discount)) {
                    $this->totalDiscount += $userCart['total_discount'];
                }
            }
        }
    }
    public function render()
    {
        return view('livewire.product');
    }
}
