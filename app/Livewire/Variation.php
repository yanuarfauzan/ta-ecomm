<?php

namespace App\Livewire;

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
    protected $listeners = ['updateVariationAndVarOptionId'];
    public $selectedVariations = [];
    public function mount($index, $product, $usersCarts, $userCart)
    {
        $this->index = $index;
        $this->product = $product;
        $this->usersCarts = $usersCarts;
        $this->userCart = $userCart;
    }
    public function updateVariationAndVarOptionId($selectedVariations)
    {
        $this->selectedVariations = $selectedVariations;
    }
    public function confirm()
    {
        $varOptionIds = collect($this->selectedVariations)->pluck('varOptionId');
        $totalAdditionalPrice = VariationOption::whereIn('id', $varOptionIds)->get()->sum('price');
        $stock = VariationOption::whereIn('id', $varOptionIds)->get()->sum('stock');
        $this->dispatch('changeAdditionalPrice', product: $this->product, userCart: $this->product->cart()->first(), totalAdditionalPrice: $totalAdditionalPrice, eventId: Str::uuid(36), stock: $stock);
        collect($this->selectedVariations)->each(function ($item) {
            $this->userCart->pickedVariation->where('variation_id', $item['variationId'])->first()->update([
                'variation_option_id' => $item['varOptionId']
            ]);
        });
    }
    public function render()
    {
        return view('livewire.variation');
    }
}
