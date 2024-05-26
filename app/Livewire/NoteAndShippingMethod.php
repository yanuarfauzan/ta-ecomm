<?php

namespace App\Livewire;

use App\Models\ProvinciesAndCities;
use App\Models\User;
use Livewire\Component;
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
    public $totalWeight;
    public function mount($product, $order, $userCarts)
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
        $this->user = auth()->user();
        $this->showCost('jne');
        $this->dispatch('addCostValueToTotalPrice', costValue: $this->costValue);
    }
    
    public function showCost($courier)
    {
        $service = '';
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

        $this->courier = $courier;

        $operatorAddress = User::where('role', 'operator')->first()->userAddresses()->where('is_default', true)->first();
        $userAddress = $this->user->userAddresses->where('is_default', true)->first();
        $cityOriginId = ProvinciesAndCities::where('city_name', $operatorAddress->city)->first()->city_id;
        $cityDestinationId = ProvinciesAndCities::where('city_name', $userAddress->city)->first()->city_id;
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
                }
            }
            $costResults['product_id'] = $this->product->id;
            $this->costs = $costResults;
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
            }
        }
        $this->dispatch('addCostValueToTotalPrice', costValue: $costValue);
    }

    public function render()
    {
        return view('livewire.note-and-shipping-method');
    }
}
