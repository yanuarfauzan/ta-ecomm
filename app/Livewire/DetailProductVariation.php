<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\VariationOption;
use Illuminate\Support\Facades\Log;
use App\Models\MergeVariationOption;
use App\Models\ProductCategoryVariationDetail;

class DetailProductVariation extends Component
{
    public $product;
    public $firstVarOption;
    public $price;
    public $lastIndex;
    public $variationHasChoosen = [];
    public $additionalPriceHasAdded = [];
    public $additionalStockHasAdded = [];
    public $additionalPrice;
    public $stock = 0;
    public $choosedVarOptions;
    public $choosedVarOptionStock;
    public function mount($product, $firstVarOption, $firstVarOptionInit)
    {
        $this->product = $product;
        $this->price = $product->price;
        $this->firstVarOption = explode('_', $firstVarOption)[0];
        $varOptionInitId = explode('_', $firstVarOptionInit)[1];
        $this->stock = VariationOption::findOrFail($varOptionInitId)->stock;
        $this->chooseVarOptions($firstVarOptionInit, 0);
        $this->dispatch('showChoosedVarOptions', choosedVarOptions: $this->choosedVarOptions, price: $this->price);
    }
    public function chooseVarOptions($choosedVarOptions, $index)
    {
        $this->choosedVarOptions = $choosedVarOptions;
        $exploded = explode('_', $choosedVarOptions);
        $additionalData = $this->product->variation()->findOrFail($exploded[0])
            ->variationOption()
            ->get()
            ->where('id', explode('_', $choosedVarOptions)[1]
            )->first();
        
        $additionalPrice = $additionalData->price ?? 0;
        $additionalStock = $additionalData->stock ?? 0;
        if ($index == 0) {
            if ($this->variationHasChoosen[$index] ?? null == $exploded[0]) {
                $this->price -= $this->additionalPriceHasAdded[$index];
                $this->stock -= $this->additionalStockHasAdded[$index];
            }
            $this->price += $additionalPrice;
            $this->variationHasChoosen[$index] = $exploded[0];
            $this->additionalPriceHasAdded[$index] = $additionalPrice;
            $this->additionalStockHasAdded[$index] = $additionalStock;
            $this->lastIndex = $index;
            $this->product->update([
                'price_after_additional' => $this->price
            ]);
            $this->dispatch('showChoosedVarOptions', choosedVarOptions: $choosedVarOptions, price: $this->price, stock: $this->stock);
        } else {
            if ($this->variationHasChoosen[$index] ?? null == $exploded[0]) {
                $this->price -= $this->additionalPriceHasAdded[$index];
                $this->stock -= $this->additionalStockHasAdded[$index];
            }
            $this->price += $additionalPrice;
            $this->variationHasChoosen[$index] = $exploded[0];
            $this->additionalPriceHasAdded[$index] = $additionalPrice;
            $this->additionalStockHasAdded[$index] = $additionalStock;
            $this->lastIndex = $index;
            $this->product->update([
                'price_after_additional' => $this->price
            ]);
            $this->dispatch('showChoosedVarOptions', choosedVarOptions: $choosedVarOptions, price: $this->price, stock: $this->stock);
        }
        Log::info($choosedVarOptions);
    }
    public function render()
    {
        return view('livewire.detail-product-variation');
    }
}
