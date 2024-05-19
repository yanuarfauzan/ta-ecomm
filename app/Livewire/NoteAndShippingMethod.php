<?php

namespace App\Livewire;

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
    public function mount($product, $order)
    {
        $this->order = $order;
        $this->product = $product;
        $this->user = auth()->user();
        $this->showCost('jne');
        $this->dispatch('addCostValueToTotalPrice', costValue: $this->costValue);
    }
    public function updated($propertyName)
    {
        $this->order->update([
            $propertyName => $this->note 
        ]);        
    }
    public function showCost($courier)
    {
        $service = '';
        switch ($courier) {
            case 'jne':
                $service = 'OKE';
                $costValue = '17000';
                break;
            case 'pos':
                $service = 'Pos Reguler';
                $costValue = '17000';
                break;
            case 'tiki':
                $service = 'ECO';
                $costValue = '16000';
                break;
        }

        $this->courier = $courier;
        $operatorAddressCacheKey = 'operator_default_address';
        $operatorAddress = cache()->remember($operatorAddressCacheKey, now()->addHours(1), function () {
            return User::where('role', 'operator')
                ->first()
                ->userAddresses()
                ->where('is_default', true)
                ->first();
        });
        $userAddress = $this->user->userAddresses->where('is_default', true)->first();

        $cityCacheKey = 'rajaongkir_cities';

        $cityResults = cache()->remember($cityCacheKey, now()->addHours(24), function () {
            $response = Http::withHeaders([
                'key' => env('API_KEY_RAJAONGKIR')
            ])->get(env('API_BASE_URL_RAJA_ONGKIR') . '/city');
            return $response->json()['rajaongkir']['results'];
        });

        $cityOriginId = null;
        $cityDestinationId = null;

        $cityLookup = collect($cityResults)->pluck('city_id', 'city_name');
        $cityOriginId = $cityLookup[$operatorAddress->city] ?? null;
        $cityDestinationId = $cityLookup[$userAddress->city] ?? null;
        if ($cityOriginId && $cityDestinationId) {
            $costs = Http::withHeaders([
                'key' => env('API_KEY_RAJAONGKIR')
            ])->post(env('API_BASE_URL_RAJA_ONGKIR') . '/cost', [
                        'origin' => $cityOriginId,
                        'destination' => $cityDestinationId,
                        'weight' => 1000,
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
            $this->dispatch('addCostValueToTotalPrice', costValue: $costValue);
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
