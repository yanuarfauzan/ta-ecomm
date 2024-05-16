<?php

namespace App\Livewire;

use App\Models\Product;
use Livewire\Component;
use Illuminate\Support\Str;
use App\Models\VariationOption;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;

class AmountsAndNotes extends Component
{
    public $product;

    public $user;
    public $count = 1;
    public $totalPrice;
    public $choosedVarOptions = [];
    public $choosedVarOptionsForCart = [];
    protected $listeners = ['showChoosedVarOptions'];
    public function mount($product, $firstVarOption, $user, $firstVarOptionForCart)
    {
        $this->product = $product;
        $this->totalPrice = $product->price;
        $this->choosedVarOptions[] = $firstVarOption;
        $this->choosedVarOptionsForCart[] = $firstVarOptionForCart;
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
        $allDifferent = true; // Start assuming all are different

        collect($request['variation'])->each(function ($variationItem, $index) use (&$allDifferent, $cartProduct) {
            $variation = $cartProduct->pickedVariation()->where('variation_id', $variationItem['variation_id'])
                ->where('variation_option_id', $variationItem['variation_option_id'])->first();

            if ($variation) {
                $allDifferent = false; // If any variation matches, set to false
            }
        });

        return $allDifferent;
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
        $user = $this->user;
        $product = Product::findOrFail($this->product->id);
        $cartProduct = $this->isCartExist($this->product->id);
        if ($user) {
            $cartProductId = Str::uuid(36);
            if ($cartProduct?->all() == null) {
                $cart = $user->cart()->create([
                    'qty' => $results['qty'],
                    'total_price' => $product->price * $results['qty']
                ]);
                $cart->hasProduct()->attach($this->product->id, ['id' => $cartProductId]);
                collect($results['variation'])->each(function ($variationItem) use ($cart, $product) {
                    $cart->pickedVariation()->create([
                        'product_id' => $product->id,
                        'variation_id' => $variationItem['variation_id'],
                        'variation_option_id' => $variationItem['variation_option_id'],
                    ]);
                });
                return response()->json(['message' => 'Berhasil menambahkan produk ke keranjang']);
            } else {
                $cartProductId = Str::uuid(36);
                if ($this->isVariationDifferent($cartProduct, $results)) {
                    $cart = $user->cart()->create([
                        'qty' => $results['qty'],
                        'total_price' => $product->price * $results['qty']
                    ]);
                    $cart->hasProduct()->attach($this->product->id, ['id' => $cartProductId]);
                    collect($results['variation'])->each(function ($variationItem) use ($cart, $product) {
                        $cart->pickedVariation()->create([
                            'product_id' => $product->id,
                            'variation_id' => $variationItem['variation_id'],
                            'variation_option_id' => $variationItem['variation_option_id'],
                        ]);
                    });
                    return response()->json(['message' => 'Berhasil menambahkan produk dengan variasi berbeda ke keranjang']);
                } else {
                    $cartProduct = $cartProduct->cart()->first();
                    $cartProduct->update([
                        'qty' => $cartProduct->qty + $results['qty'],
                        'total_price' => $product->price * $results['qty']
                    ]);
                    return response()->json(['message' => 'Produk sudah dimasukkan ke keranjang, jumlah ditambahkan']);
                }
            }
        } else {
            return response()->json(['message' => 'Anda harus login terlebih dahulu']);
        }

    }
    public function showChoosedVarOptions($choosedVarOptions)
    {
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
    }
    public function increase()
    {
        $this->count++;
        $this->totalPrice += $this->product->price;
    }
    public function decrease()
    {
        if ($this->count > 1) {
            $this->count--;
            $this->totalPrice -= $this->product->price;
        }
    }
    public function render()
    {
        return view('livewire.amounts-and-notes');
    }
}
