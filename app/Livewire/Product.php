<?php

namespace App\Livewire;

use App\Models\Cart;
use Livewire\Component;
use App\Models\Product as ModelProduct;

class Product extends Component
{
    public $user;
    public $usersCarts;
    public $checkedProducts = [];
    public $totalPrice;
    public $totalDiscount;
    public $relatedProducts;
    public $showRelatedProducts = false;
    public $userCartId = null;
    public $categoryIds;
    protected $listeners = ['toggleChecked', 'toggleAllChecked', 'toggleAllUnCheck', 'decreaseQtyProduct', 'increaseQtyProduct', 'showSearchedProducts'];

    public function mount($usersCarts, $user)
    {
        $this->totalPrice = 0;
        $this->totalDiscount = 0;
        $this->usersCarts = $usersCarts;
        $this->user = $user;
    }
    public function showSearchedProducts($searchQuery)
    {
        $userCarts = Cart::with('hasProduct', 'hasProduct.pickedVariation', 'hasProduct.pickedVariationOption', 'hasProduct.variation', 'hasProduct.variation.variationOption')
        ->whereHas('hasProduct', function ($query) use ($searchQuery) {
            $query->where('name', 'like', '%' . $searchQuery . '%');
        })
        ->get();
        $this->usersCarts = $userCarts;
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
    public function toggleRelatedProducts($userCartId)
    {

        if ($this->userCartId === $userCartId) {
            $this->showRelatedProducts = !$this->showRelatedProducts;
        } else {
            $this->showRelatedProducts = true;
            $this->userCartId = $userCartId;
        }
        if ($this->showRelatedProducts) {
            $this->getRelatedProducts($this->userCartId);
        } else {
            $this->relatedProducts = [];
        }
    }

    public function getRelatedProducts($userCartId)
    {
        $product = $this->usersCarts->where('id', $userCartId)->first()->hasProduct->first();
        $categoryIds = $product->hasCategory->pluck('id');
        $this->categoryIds = $categoryIds;
        $relatedProducts = ModelProduct::whereHas('hasCategory', function ($query) use ($categoryIds) {
            $query->whereIn('category_id', $categoryIds);
        })->where('id', '!=', $product->id)->take(4)->get();
        $this->relatedProducts = $relatedProducts;
    }
    public function searchCartProduct()
    {

    }
    public function render()
    {
        return view('livewire.product');
    }
}
