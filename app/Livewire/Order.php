<?php

namespace App\Livewire;

use Livewire\Component;

class Order extends Component
{
    public $usersCarts;
    public $user;
    public $defaultUserAdress;
    public $totalPrice;
    public $totalDiscount;
    public $snapToken;
    public $order;
    public $previousCostValue;
    public $listeners = ['addCostValueToTotalPrice'];
    public function mount($usersCarts, $user, $defaultUserAdress, $order)
    {
        $this->usersCarts = $usersCarts;
        $this->user = $user;
        $this->order = $order;
        $this->defaultUserAdress = $defaultUserAdress;
        $this->totalPrice = $usersCarts->sum('total_price');
        $this->totalDiscount = $usersCarts->sum('total_discount');
        $this->addCostValueToTotalPrice(17000);
    }
    public function addCostValueToTotalPrice($costValue)
    {
        $this->totalPrice -= $this->previousCostValue;
        $this->totalPrice += $costValue;
        $this->previousCostValue = $costValue;
        $params['transaction_details'] = [
            'order_id' => $this->order->order_number,
            'gross_amount' => $this->totalPrice
        ];

        // Set your Merchant Server Key
        \Midtrans\Config::$serverKey = config('midtrans.serverKey');
        // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        \Midtrans\Config::$isProduction = false;
        // Set sanitization on (default)
        \Midtrans\Config::$isSanitized = true;
        // Set 3DS transaction for credit card to true
        \Midtrans\Config::$is3ds = true;


        $this->snapToken = \Midtrans\Snap::getSnapToken($params);
        $this->dispatch('snapTokenGenerated', ['snapToken' => $this->snapToken]);
    }
    public function render()
    {
        return view('livewire.order');
    }
}
