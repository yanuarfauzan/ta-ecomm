<?php

namespace App\Livewire;

use App\Models\Product;
use Livewire\Component;
use Illuminate\Support\Str;
use App\Models\Cart as ModelCart;
use App\Traits\PreventDuplicateEvents;
use App\Models\Product as ModelProduct;

class Cart extends Component
{

    use PreventDuplicateEvents;

    public $user;
    public $usersCarts;
    public $checkedProducts = [];
    public $totalPrice;
    public $totalDiscount;
    public $relatedProducts;
    public $showRelatedProducts = false;
    public $userCartId = null;
    public $categoryIds;
    public $count;
    public $stock;
    public $discountExist = false;
    protected $listeners = ['changeAdditionalPrice', 'toggleChecked', 'toggleAllChecked', 'toggleAllUnCheck', 'decreaseQtyProduct', 'increaseQtyProduct', 'showSearchedProducts', 'deleteUserCart'];

    public function mount($usersCarts, $user)
    {
        $this->totalPrice = 0;
        $this->count = 1;
        $this->totalDiscount = 0;
        $this->usersCarts = $usersCarts;
        $this->discountExist = $this->usersCarts->contains(function ($cart) {
            return $cart->hasProduct()->whereNotNull('discount')->exists();
        });
        $this->user = $user;
    }
    public function changeAdditionalPrice($product, $userCart, $totalAdditionalPrice, $eventId, $stock)
    {
        $this->stock = $stock;
        $this->count = $userCart['qty'];
        $priceAfterAdditional = $product['price'] + $totalAdditionalPrice;
        if ($this->isDuplicateEvent($eventId))
            return;
        $fixPrice = $priceAfterAdditional;
        $product = Product::findOrFail($product['id'])->update([
            'price_after_additional' => $fixPrice,
        ]);
        $this->dispatch('changeTotalPrice', userCart: $userCart, fixPrice: $fixPrice, eventId: Str::uuid(36));
    }
    public function showSearchedProducts($searchQuery)
    {
        if (!$searchQuery == null) {
            $userCarts = ModelCart::with('hasProduct', 'hasProduct.pickedVariation', 'hasProduct.pickedVariationOption', 'hasProduct.variation', 'hasProduct.variation.variationOption')
                ->whereHas('hasProduct', function ($query) use ($searchQuery) {
                    $query->where('name', 'like', '%' . $searchQuery . '%');
                })
                ->get();
            $this->usersCarts = $userCarts;
        } else {
            $userCarts = ModelCart::with('hasProduct', 'hasProduct.pickedVariation', 'hasProduct.pickedVariationOption', 'hasProduct.variation', 'hasProduct.variation.variationOption')
                ->get();
            $this->usersCarts = $userCarts;
        }
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
    public function deleteUserCart($userCartId)
    {
        ModelCart::where('id', $userCartId)->first()->delete();
        $this->usersCarts = ModelCart::all();
    }
    public function render()
    {
        return view('livewire.cart');
    }
}
