<?php

namespace App\Livewire;

use Livewire\Component;

class DetailProductVariation extends Component
{
    public $product;
    public function mount($product)
    {
        $this->product = $product;
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
