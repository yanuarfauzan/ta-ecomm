<?php

namespace App\Livewire;

use App\Models\VariationOption;
use Livewire\Component;

class Order extends Component
{
    public $usersCarts;
    public $user;
    public $count;
    public $defaultUserAdress;
    public $totalPrice;
    public $totalDiscount;
    public $snapToken;
    public $order;
    public $previousCostValue;
    public $productBuyNow;
    public $variationBuyNow;
    public $listeners = ['addCostValueToTotalPrice'];
    public function mount($usersCarts, $productBuyNow, $user, $defaultUserAdress, $order, $countBuyNow, $variationBuyNow)
    {
        $tempVarBuyNow = [];
        collect($variationBuyNow)->each(function ($var) use (&$tempVarBuyNow) {
            $tempVarBuyNow[] = explode('_', $var)[1];
        });
        $variationBuyNow = VariationOption::whereIn('id', $tempVarBuyNow)->with('productImage')->get();
        $this->variationBuyNow = $variationBuyNow;
        $this->productBuyNow = $productBuyNow;
        $explodedOrder = explode('-', $order->order_number);
        $explodedOrder[1] = date('YmdHis');
        $order->update([
            'order_number' => implode('-', $explodedOrder)
        ]);
        $this->order = $order;
        $this->usersCarts = $usersCarts;
        $this->user = $user;
        $this->defaultUserAdress = $defaultUserAdress;
        $this->count = $countBuyNow;
        count($productBuyNow->toArray()) > 0 ? $this->totalPrice = $productBuyNow->price : $this->totalPrice = $usersCarts->sum('total_price');
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
