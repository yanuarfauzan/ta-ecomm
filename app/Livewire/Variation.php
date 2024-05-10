<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Log;

class Variation extends Component
{
    public $index;
    public $product; 
    public $usersCarts; 
    protected $listeners = ['updateVariationAndVarOptionId'];
    public $selectedVariations = [];
    public function mount($index, $product, $usersCarts)
    {
        $this->index = $index;
        $this->product = $product;
        $this->usersCarts = $usersCarts;
    }
    public function updateVariationAndVarOptionId($selectedVariations)
    {
        $this->selectedVariations = $selectedVariations;
    }
    public function confirm()   
    {
        collect($this->selectedVariations)->each(function ($item) {
            $this->product->pickedVariation()->wherePivot('variation_id', $item['variationId'])->updateExistingPivot($item['variationId'], [
                'variation_option_id' => $item['varOptionId']
            ]);
        });
    }   
    public function render()
    {
        return view('livewire.variation');
    }
}
