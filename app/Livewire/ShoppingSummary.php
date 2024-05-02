<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Log;

class ShoppingSummary extends Component
{
    protected $listeners = ['displayTotalPrice' => 'showTotal'];
    public $totalPrice = 0;

    public function mount($totalPrice)
    {
        $this->totalPrice = $totalPrice;
    }

    public function render()
    {
        return view('livewire.shopping-sumarry');
    }
}