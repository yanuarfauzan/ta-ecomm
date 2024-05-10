<?php

namespace App\Livewire;

use Livewire\Component;

class DetailProductVariation extends Component
{
    public $product;
    public $firstVarOption;
    public function mount($product, $firstVarOption)
    {
        $this->product = $product;
        $this->firstVarOption = explode('_', $firstVarOption)[0];
    }
    public function chooseVarOptions($choosedVarOptions)
    {
        $this->dispatch('showChoosedVarOptions', choosedVarOptions: $choosedVarOptions);
    }
    public function render()
    {
        return view('livewire.detail-product-variation');
    }
}
