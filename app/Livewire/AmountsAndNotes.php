<?php

namespace App\Livewire;

use App\Models\Product;
use Livewire\Component;
use Illuminate\Support\Str;
use App\Models\VariationOption;
use Illuminate\Support\Facades\Log;
use App\Models\MergeVariationOption;


class AmountsAndNotes extends Component
{
    public $product;
    public $user;
    public $count = 1;
    public $totalPrice;
    public $price;
    public $stock;
    public $choosedVarOptions = [];
    public $choosedVarOptionsForCart = [];
    protected $listeners = ['showChoosedVarOptions'];
    public function mount($product, $firstVarOption, $user, $firstVarOptionForCart)
    {
        $this->stock = MergeVariationOption::where('variation_option_1_id', explode('_', $firstVarOptionForCart)[1])->first()?->merge_stock;
        $this->totalPrice = $product->price + VariationOption::findOrFail(explode('_', $firstVarOptionForCart)[1])->price;
        $this->product = $product;
        $this->cartProductId = $product->cart();
        $this->choosedVarOptions[] = $firstVarOption;
        $this->choosedVarOptionsForCart[] = $firstVarOptionForCart;
        $this->count = 1;
    }
    public function isCartExist($productId)
    {
        $userCart = $this->user->cart()->whereHas('hasProduct', function ($query) use ($productId) {
            $query->where('product_id', $productId);
        })->first();
        return $userCart;
    }
    public function isVariationDifferent($cartProduct, $request)
    {
        $existingVariations = $cartProduct->pickedVariation()->get(['variation_id', 'variation_option_id'])->toArray();

        if (count($existingVariations) != count($request['variation'])) {
            return true;
        }

        $requestedVariations = collect($request['variation'])->map(function ($variation) {
            return [
                'variation_id' => $variation['variation_id'],
                'variation_option_id' => $variation['variation_option_id']
            ];
        })->toArray();

        foreach ($requestedVariations as $requestedVariation) {
            $found = false;

            foreach ($existingVariations as $existingVariation) {
                if (
                    $existingVariation['variation_id'] == $requestedVariation['variation_id'] &&
                    $existingVariation['variation_option_id'] == $requestedVariation['variation_option_id']
                ) {
                    $found = true;
                    break;
                }
            }

            if (!$found) {
                return true;
            }
        }

        return false;
    }

    public function addToCart()
    {
        $results = ['variation' => []];
        $results['qty'] = $this->count;
        collect($this->choosedVarOptionsForCart)->each(function ($varOption) use (&$results) {
            $explodedVarOption = explode('_', $varOption);
            $data = [
                'variation_id' => $explodedVarOption[0],
                'variation_option_id' => (int) $explodedVarOption[1] // Konversi ke integer
            ];
            $results['variation'][] = $data;
        });
            $product = Product::findOrFail($this->product->id);
            $cartProduct = $this->isCartExist($this->product->id);
            $cartProductId = Str::uuid(36);
            if ($cartProduct?->all() == null) {
                $cart = $this->user->cart()->create([
                    'qty' => $results['qty'],
                    'total_price' => $this->price * $results['qty']
                ]);
                $cart->hasProduct()->attach($this->product->id, ['id' => $cartProductId]);
                collect($results['variation'])->each(function ($variationItem) use ($cart, $product) {
                    $cart->pickedVariation()->create([
                        'product_id' => $product->id,
                        'variation_id' => $variationItem['variation_id'],
                        'variation_option_id' => $variationItem['variation_option_id'],
                    ]);
                });
                $this->dispatch('openModalSuccessAddToCart',
                ['message' => 'Berhasil menambahkan produk ke keranjang']);
            } else {
                $cartProductId = Str::uuid(36);
                if ($this->isVariationDifferent($cartProduct, $results)) {
                    $cart = $this->user->cart()->create([
                        'qty' => $results['qty'],
                        'total_price' => $this->price * $results['qty']
                    ]);
                    $cart->hasProduct()->attach($this->product->id, ['id' => $cartProductId]);
                    collect($results['variation'])->each(function ($variationItem) use ($cart, $product) {
                        $cart->pickedVariation()->create([
                            'product_id' => $product->id,
                            'variation_id' => $variationItem['variation_id'],
                            'variation_option_id' => $variationItem['variation_option_id'],
                        ]);
                    });
                    $this->dispatch('openModalSuccessAddToCart',
                    ['message' => 'Berhasil menambahkan produk dengan variasi berbeda ke keranjang']);
                } else {
                    $cartProduct->update([
                        'qty' => $cartProduct->qty + $results['qty'],
                        'total_price' => $this->price * ($cartProduct->qty + $results['qty'])
                    ]);
                    $this->dispatch('openModalSuccessAddToCart',['message' => 'Produk sudah dimasukkan ke keranjang, jumlah ditambahkan']);
                }
            }
    }
    public function showChoosedVarOptions($choosedVarOptions, $price)
    {
        $this->price = $price;
        $this->totalPrice = $price;
        $explodedChoosedVarOption = explode('_', $choosedVarOptions);
        $varianFound = false;
        $varOptionName = VariationOption::findOrFail($explodedChoosedVarOption[1])->name;
        $explodedChoosedVarOption[1] = $varOptionName;
        $changedChoosedVarOptions = implode('_', $explodedChoosedVarOption);
        for ($i = 0; $i < count($this->choosedVarOptions); $i++) {
            $explodedVarOption = explode('_', $this->choosedVarOptions[$i]);
            if ($explodedVarOption[0] == $explodedChoosedVarOption[0]) {
                $this->choosedVarOptionsForCart[$i] = $choosedVarOptions;
                $this->choosedVarOptions[$i] = $changedChoosedVarOptions;
                $varianFound = true;
            }
        }
        if (!$varianFound) {
            $this->choosedVarOptionsForCart[] = $choosedVarOptions;
            $this->choosedVarOptions[] = $changedChoosedVarOptions;
        }

        if (count($this->choosedVarOptions) > 2) {
            $this->choosedVarOptions = array_slice($this->choosedVarOptions, 0, 2);
        }
        if (count($this->choosedVarOptionsForCart) == 1) {
            $this->stock = MergeVariationOption::where('variation_option_1_id', explode('_', $this->choosedVarOptionsForCart[0])[1])->get()->sum('merge_stock');
        } else if (count($this->choosedVarOptionsForCart) == 2) {
            $this->stock = MergeVariationOption::where('variation_option_1_id', explode('_', $this->choosedVarOptionsForCart[0])[1])->where('variation_option_2_id', explode('_', $this->choosedVarOptionsForCart[1])[1])->get()->sum('merge_stock');
        }
        Log::info($this->choosedVarOptionsForCart);
    }
    public function increase()
    {
        $this->count++;
        $this->totalPrice += $this->price;
    }
    public function decrease()
    {
        if ($this->count > 1) {
            $this->count--;
            $this->totalPrice -= $this->price;
        }
    }
    public function render()
    {
        return view('livewire.amounts-and-notes');
    }
}
