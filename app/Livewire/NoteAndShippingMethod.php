<?php

namespace App\Livewire;

use App\Models\User;
use App\Models\Voucher;
use Livewire\Component;
use App\Models\Shipping;
use App\Models\ProvinciesAndCities;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;


class NoteAndShippingMethod extends Component
{
    public $user;
    public $product;
    public $costs;
    public $note;
    public $courier;
    public $costValue;
    public $order;
    public $productVoucher;
    public $totalWeight;
    public $voucherApplied;
    public $pickedUserAddress;
    public $service;
    public $isVoucherApplied = false;
    public $listeners = ['changeAddressForCost'];
    public function mount($product, $order, $userCarts, $productVoucher)
    {
        $totalWeight = 0;
        if ($userCarts != []) {
            collect($userCarts)->each(function ($cart) use (&$totalWeight) {
                $totalWeight += $cart->hasProduct->first()->weight;
            });
            $this->totalWeight = $totalWeight;
        } else {
            $this->totalWeight = $product->weight;
        }
        $this->note = $order->note;
        $this->order = $order;
        $this->product = $product;
        $this->productVoucher = $productVoucher;
        $this->user = auth()->user();
        $shipping = $this->order->shipping()->first();
        if ($shipping) {
            $courier = $shipping->provider_code;
            $this->service = $shipping->service;
            $this->showCost($courier);
            $this->service = '';
        } else {
            $this->showCost('jne');
        }
    }

    public function changeAddressForCost($pickedUserAddress)
    {
        $this->pickedUserAddress = $pickedUserAddress;
        $this->showCost('jne');
    }
    public function useVoucher($type, $discountValue, $voucherId)
    {
        $this->voucherApplied = Voucher::findOrFail($voucherId);
        $this->isVoucherApplied = true;
        $this->dispatch('addVoucherToTotalPrice', type: $type, discountValue: $discountValue);
    }
    public function showCost($courier)
    {
        $service = $this->service;
        if ($service == '') {
            switch ($courier) {
                case 'jne':
                    $service = 'OKE';
                    break;
                case 'pos':
                    $service = 'Pos Reguler';
                    break;
                case 'tiki':
                    $service = 'ECO';
                    break;
            }
    }
        $this->courier = $courier;

        $operatorAddress = User::where('role', 'operator')->first()->userAddresses()->where('is_default', true)->first();
        $userAddress = $this->user->userAddresses;
        if ($this->pickedUserAddress) {
            $userAddress = $this->pickedUserAddress;
        } else {
            $userAddress = $userAddress->where('is_default', true)->first()->toArray();
        }
        $cityOriginId = ProvinciesAndCities::where('city_name', $operatorAddress->city)->first()->city_id;
        $cityDestinationId = ProvinciesAndCities::where('city_name', $userAddress['city'])->first()->city_id;
        if ($cityOriginId && $cityDestinationId) {
            $costs = Http::withHeaders([
                'key' => env('API_KEY_RAJAONGKIR')
            ])->post(env('API_BASE_URL_RAJA_ONGKIR') . '/cost', [
                        'origin' => $cityOriginId,
                        'destination' => $cityDestinationId,
                        'weight' => $this->totalWeight,
                        'courier' => $courier
                    ]);

            $costResults = $costs->json()['rajaongkir']['results'][0];
            foreach ($costResults['costs'] as &$cost) {
                if ($cost['service'] == $service) {
                    $cost['is_picked'] = true;
                    $this->costValue = $cost['cost'][0]['value'];

                    $orderShipping = $this->order->shipping()->first();
                    if (!$orderShipping) {
                        $shipping = Shipping::create(
                            [
                                'provider_code' => $costResults['code'],
                                'provider_name' => $costResults['name'],
                                'service' => $cost['service'],
                                'desc' => $cost['description'],
                                'cost' => $cost['cost'][0]['value'],
                                'etd' => $cost['cost'][0]['etd']
                            ]
                        );
                        $this->order->update([
                            'shipping_id' => $shipping->id
                        ]);
                    }
                }
            }
            $this->costs = $costResults;
            // dd($this->costs);
            $this->dispatch('addCostValueToTotalPrice', costValue: $this->costValue);
        } else {
            $this->costs = null;
        }
    }

    public function addCostValueToTotalPrice($service)
    {
        $costValue = 0;
        foreach ($this->costs['costs'] as &$cost) {
            if ($cost['service'] == $service) {
                $cost['is_picked'] = true;
                $costValue = $cost['cost'][0]['value'];
                if ($this->order->shipping()->first()) {
                    $this->order->shipping()->update(
                        [
                            'provider_code' => $this->costs['code'],
                            'provider_name' => $this->costs['name'],
                            'service' => $cost['service'],
                            'desc' => $cost['description'],
                            'cost' => $cost['cost'][0]['value'],
                            'etd' => $cost['cost'][0]['etd']
                        ]
                    );
                } else {
                    $this->order->shipping()->create(
                        [
                            'provider_code' => $this->costs['code'],
                            'provider_name' => $this->costs['name'],
                            'service' => $cost['service'],
                            'desc' => $cost['description'],
                            'cost' => $cost['cost'][0]['value'],
                            'etd' => $cost['cost'][0]['etd']
                        ]
                    );
                }
            }
        }
        $this->dispatch('addCostValueToTotalPrice', costValue: $costValue);
    }

    public function render()
    {
        return view('livewire.note-and-shipping-method');
    }
}
