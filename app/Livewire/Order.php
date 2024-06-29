<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\VariationOption;
use App\Models\ProvinciesAndCities;
use Illuminate\Support\Facades\Auth;

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
    public $userAddresses;
    public $provincies;
    public $cities;
    public $isAddressChanged = false;
    public $recipient_name;
    public $address;
    public $province;
    public $city;
    public $postal_code;
    public $detail;
    protected $rules = [
        'address' => 'required',
        'province' => 'required',
        'city' => 'required',
        'postal_code' => 'required',
        'detail' => 'required',
        'recipient_name' => 'required',
    ];

    protected $messages = [
        'address.required' => 'Alamat tidak boleh kosong',
        'postal_code.required' => 'Kode pos tidak boleh kosong',
        'province.required' => 'Provinsi tidak boleh kosong',
        'city.required' => 'Kota tidak boleh kosong',
        'detail.required' => 'Detail alamat tidak boleh kosong',
        'vrecipient_name.required' => 'Nama penerima tidak boleh kosong',
    ];
    public $listeners = ['addCostValueToTotalPrice', 'addVoucherToTotalPrice'];
    public function mount($usersCarts, 
    $productBuyNow, 
    $user, 
    $defaultUserAdress, 
    $order, 
    $countBuyNow, 
    $variationBuyNow, 
    $productVoucher, 
    $userAddresses, 
    $subTotal)
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
        $this->userAddresses = $userAddresses;
        $this->note = $this->order->note;
        $this->order->update([
            'address_id' => $defaultUserAdress->id
        ]);
        $this->provincies = collect(ProvinciesAndCities::pluck('province')->unique());
        $this->cities = collect(ProvinciesAndCities::pluck('city_name')->unique());


        if ($productBuyNow != []) {
            $this->subTotal = $subTotal;
        } else {
            $this->subTotal = $usersCarts->sum(function ($cart) {
                return isset($cart->total_price_after_discount) ? 
                $cart->total_price_after_discount : $cart->total_price;
            });
        }

        $this->totalPrice = $this->subTotal + $this->costValue;
        $this->order->total_price = $this->totalPrice;
        if (!$this->order->snap_token) {
            $this->generateSnapTokenForPayment();
        } else {
            $this->snapToken = $this->order->snap_token;
        }
    }
    public function changeAddress($addressId)
    {
        $this->order->update([
            'address_id' => $addressId
        ]);
        $pickedUserAddress = $this->userAddresses->where('id', $addressId)->first();
        $this->isAddressChanged = true;
        $this->defaultUserAdress = $pickedUserAddress;
        $this->dispatch('changeAddressForCost', pickedUserAddress: $pickedUserAddress);
    }
    public function editAddress($addressId)
    {
        $editAddress = $this->userAddresses->where('id', $addressId)->first();
        $this->address = $editAddress->address;
        $this->recipient_name = $editAddress->recipient_name;
        $this->province = $editAddress->province;
        $this->city = $editAddress->city;
        $this->postal_code = $editAddress->postal_code;
        $this->detail = $editAddress->detail;

    }
    public function updateAddress($addressId)
    {
        $validatedData = $this->validate();
        $updateAddress = $this->userAddresses->where('id', $addressId)->first();
        $updateAddress->update($validatedData);
        $this->defaultUserAdress = $this->userAddresses->where('is_default', true)->first();
        $this->reset(['address', 'recipient_name', 'province', 'city', 'postal_code', 'detail']);
    }
    public function updatedNote()
    {
        $this->order->update([
            'note' => $this->note
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
            $this->order->total_price = $this->totalPrice;
            $this->prevVoucherValue = $this->costValue;
        } else {
            $this->voucherValue = $discountValue;
            if (isset($this->prevVoucherValue)) {
                $this->totalPrice += $this->prevVoucherValue;
            }
            $this->totalPrice = $this->totalPrice - $this->voucherValue;
            $this->order->total_price = $this->totalPrice;
            $this->prevVoucherValue = $discountValue;
        }
        $this->generateSnapTokenForPayment();

    }
    public function addCostValueToTotalPrice($costValue)
    {
        $this->costValue = $costValue;
        $this->totalPrice -= $this->previousCostValue;
        $this->totalPrice = $this->subTotal + $this->costValue;
        $this->order->total_price = $this->totalPrice;
        $this->previousCostValue = $costValue;
        $this->generateSnapTokenForPayment();
    }
    public function generateSnapTokenForPayment()
    {
        $params['transaction_details'] = [
            'order_id' => $this->order->order_number,
            'gross_amount' => $this->totalPrice
        ];

        $params['customer_details'] = [
            'first_name' => Auth::user()->username,
            'email' => Auth::user()->email
        ];

        \Midtrans\Config::$serverKey = config('midtrans.serverKey');
        \Midtrans\Config::$isProduction = false;
        \Midtrans\Config::$isSanitized = true;
        \Midtrans\Config::$is3ds = true;

        $this->snapToken = \Midtrans\Snap::getSnapToken($params);
        $this->order->update([
            'snap_token' => $this->snapToken
        ]);
    
        $this->dispatch('snapTokenGenerated', ['snapToken' => $this->snapToken]);
    }
    public function render()
    {
        return view('livewire.order');
    }
}
