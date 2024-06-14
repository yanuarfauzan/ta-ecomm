<?php

namespace App\Livewire;

use App\Models\MergeVariationOption;
use Livewire\Component;
use Illuminate\Support\Str;
use App\Models\VariationOption;
use Illuminate\Support\Facades\Log;
use App\Traits\PreventDuplicateEvents;

class Variation extends Component
{
    use PreventDuplicateEvents;

    public $index;
    public $product;
    public $usersCarts;
    public $userCart;
    public $stock;
    protected $listeners = ['updateVariationAndVarOptionId'];
    public $selectedVariations = [];
    public function mount($index, $product, $usersCarts, $userCart)
    {
        $this->index = $index;
        $this->product = $product;
        $this->usersCarts = $usersCarts;
        $this->userCart = $userCart;
        $initSelectedVariations[0] = [
            'variationId' => $this->userCart->pickedVariation[0]->variation_id,
            'varOptionId' => $this->userCart->pickedVariation[0]->variationOption->id
        ];
        $initSelectedVariations[1] = [
            'variationId' => $this->userCart->pickedVariation[1]->variation_id,
            'varOptionId' => $this->userCart->pickedVariation[1]->variationOption->id
        ];
        $this->updateVariationAndVarOptionId($initSelectedVariations);
        $this->confirm();
    }
    public function updateVariationAndVarOptionId($selectedVariations)
    {
        $this->selectedVariations = $selectedVariations;
    }
    public function confirm()
    {
        $varOptionIds = collect($this->selectedVariations)->pluck('varOptionId');
        $mergeVarOptionId = MergeVariationOption::whereIn('variation_option_1_id', $varOptionIds)->whereIn('variation_option_2_id', $varOptionIds)->first()->id;
        $totalAdditionalPrice = VariationOption::whereIn('id', $varOptionIds)->get()->sum('price');
        $this->stock = VariationOption::whereIn('id', $varOptionIds)->get()->sum('stock');
        $this->dispatch('changeAdditionalPrice', product: $this->product, userCart: $this->product->cart()->first(), totalAdditionalPrice: $totalAdditionalPrice, eventId: Str::uuid(36), mergeVarOptionId: $mergeVarOptionId);
        collect($this->selectedVariations)->each(function ($item) {
            $pickedVariation = $this->userCart->pickedVariation->where('variation_id', $item['variationId'])->first();

            // if ($pickedVariation) {
            //     if ($pickedVariation->variation_option_id == $item['varOptionId']) {
            //         $this->dispatch('updateQtyIfVariationOptionSame', qty: $this->product->cart()->first()->qty);
            //     } else {
            $pickedVariation->update([
                'variation_option_id' => $item['varOptionId']
            ]);
            //         }
            //     }
        });
    }
    public function render()
    {
        return view('livewire.variation');
    }
}
