<?php

namespace App\Livewire;

use App\Models\Product;
use Livewire\Component;
use App\Models\Category;

class Home extends Component
{

    public $categories;
    public $products;
    public function mount()
    {
        // $take = $request->loadMoreProduct == true ? 16 : 16;
        // $startIndex = $request->input('startIndex', 0);
        // $this->products = Product::skip($startIndex)->take($take)->get();
        $this->categories = Category::all();
        $this->products = Product::take(16)->get();
    }
    public function render()
    {
        return view('livewire.home')
        ->extends('partial.user.main')
        ->section('container')
        ->layoutData(['categories' => $this->categories, 'products' => $this->products]);
    }
}
