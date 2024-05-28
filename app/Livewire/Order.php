<?php

namespace App\Livewire;

use App\Models\VariationOption;
use Livewire\Component;

class Order extends Component
{
    public $usersCarts;
    public $user;
    public $count = 1;
    public $defaultUserAdress;
    public $subTotal;
    public $totalPrice;
    public $snapToken;
    public $order;
    public $previousCostValue;
    public $productBuyNow;
    public $variationBuyNow;
    public $costValue;
    public $note;
    public $productVoucher;
    public $prevVoucherValue;
    public $voucherValue;
    public $listeners = ['addCostValueToTotalPrice', 'addVoucherToTotalPrice'];
    public function mount($usersCarts, $productBuyNow, $user, $defaultUserAdress, $order, $countBuyNow, $variationBuyNow, $productVoucher)
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
        $this->productBuyNow = $productBuyNow;
        $this->productVoucher = $productVoucher;

        $productPriceBuyNow = isset($productBuyNow) && isset($productBuyNow->discount) ? $productBuyNow->price_after_dsicount : $productBuyNow['price'] ?? 0;
        $productBuyNow != [] ? $this->subTotal = $countBuyNow * $productPriceBuyNow : $this->subTotal = $usersCarts->sum('total_price');
    }
    public function updatedNote($propertyName)
    {
        $this->order->update([
            $propertyName => $this->note
        ]);
    }
    public function addVoucherToTotalPrice($type, $discountValue)
    {
        if ($type == 'free ongkir' && $discountValue == null) {
            $this->voucherValue = $this->costValue;
            if (isset($this->prevVoucherValue)) {
                $this->totalPrice += $this->prevVoucherValue;
            }
            $this->totalPrice = $this->totalPrice - $this->voucherValue;
            $this->prevVoucherValue = $this->costValue;
            $this->generateSnapTokenForPayment();
        } else {
            $this->voucherValue = $discountValue;
            if (isset($this->prevVoucherValue)) {
                $this->totalPrice += $this->prevVoucherValue;
            }
            $this->totalPrice = $this->totalPrice - $this->voucherValue;
            $this->prevVoucherValue = $discountValue;
            $this->generateSnapTokenForPayment();
        }

    }
    public function addCostValueToTotalPrice($costValue)
    {
        $this->costValue = $costValue;
        $this->totalPrice -= $this->previousCostValue;
        $this->totalPrice = $this->subTotal + $this->costValue;
        $this->previousCostValue = $costValue;
        $this->generateSnapTokenForPayment();
    }
    public function generateSnapTokenForPayment()
    {
        $params['transaction_details'] = [
            'order_id' => $this->order->order_number,
            'gross_amount' => $this->totalPrice
        ];

        \Midtrans\Config::$serverKey = config('midtrans.serverKey');
        \Midtrans\Config::$isProduction = false;
        \Midtrans\Config::$isSanitized = true;
        \Midtrans\Config::$is3ds = true;

        $this->snapToken = \Midtrans\Snap::getSnapToken($params);
        $this->dispatch('snapTokenGenerated', ['snapToken' => $this->snapToken]);
    }
    public function render()
    {
        return view('livewire.order');
    }
}
