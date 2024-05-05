<?php

namespace App\Livewire;

use App\Models\Cart;
use Livewire\Component;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class SearchCartProduct extends Component
{
    public $searchQuery;
    public function processFormSearch()
    {
        $this->dispatch('showSearchedProducts', searchQuery: $this->searchQuery);
    }
    public function render()
    {
        return view('livewire.search-cart-product');
    }
}
