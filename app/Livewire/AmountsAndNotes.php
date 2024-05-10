<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\VariationOption;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;

class AmountsAndNotes extends Component
{
    public $product;
    public $count = 1;
    public $totalPrice;
    public $choosedVarOptions = [];
    public $choosedVarOptionsForCart = [];
    protected $listeners = ['showChoosedVarOptions'];
    public function mount($product)
    {
        $this->product = $product;
        $this->totalPrice = $product->price;

    }
    public function addToCart()
    {
        $results = ['variation' => []];
        $results['qty'] = $this->count;
        collect($this->choosedVarOptionsForCart)->each(function ($varOption) use (&$results) {
            $explodedVarOption = explode('_', $varOption);
            $data = [
                'variation_id' => $explodedVarOption[0],
                'variation_option_id' => (int) $explodedVarOption[1] // Konversi ke integer
            ];
            $results['variation'][] = $data;
        });
        $queryString = http_build_query($results);
        
        $addToCartUrl = route('user-add-product-to-cart', ['productId' => $this->product->id]) . '?' .$queryString;
        Http::get($addToCartUrl);
        
    }
    public function showChoosedVarOptions($choosedVarOptions)
    {
        $explodedChoosedVarOption = explode('_', $choosedVarOptions);
        $varianFound = false;
        $varOptionName = VariationOption::findOrFail($explodedChoosedVarOption[1])->name;
        $explodedChoosedVarOption[1] = $varOptionName;
        $changedChoosedVarOptions = implode('_', $explodedChoosedVarOption);

        for ($i = 0; $i < count($this->choosedVarOptions); $i++) {
            $explodedVarOption = explode('_', $this->choosedVarOptions[$i]);
            if ($explodedVarOption[0] == $explodedChoosedVarOption[0]) {
                $this->choosedVarOptionsForCart[$i] = $choosedVarOptions;
                $this->choosedVarOptions[$i] = $changedChoosedVarOptions;
                $varianFound = true;
            }
        }
        if (!$varianFound) {
            $this->choosedVarOptionsForCart[] = $choosedVarOptions;
            $this->choosedVarOptions[] = $changedChoosedVarOptions;
        }

        if (count($this->choosedVarOptions) > 2) {
            $this->choosedVarOptions = array_slice($this->choosedVarOptions, 0, 2);
        }
    }
    public function increase()
    {
        $this->count++;
        $this->totalPrice += $this->product->price;
    }
    public function decrease()
    {
        if ($this->count > 1) {
            $this->count--;
            $this->totalPrice -= $this->product->price;
        }
    }
    public function render()
    {
        return view('livewire.amounts-and-notes');
    }
}
