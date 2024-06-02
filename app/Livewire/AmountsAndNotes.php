<?php

namespace App\Livewire;

use App\Models\Product;
use Livewire\Component;
use Illuminate\Support\Str;
use App\Models\VariationOption;


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
        $this->stock = VariationOption::findOrFail(explode('_', $firstVarOptionForCart)[1])->stock;
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
                return response()->json(['message' => 'Berhasil menambahkan produk ke keranjang']);
            } else {
                $cartProductId = Str::uuid(36);
                if ($this->isVariationDifferent($cartProduct, $results)) {
                    $cart = $user->cart()->create([
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
                    return response()->json(['message' => 'Berhasil menambahkan produk dengan variasi berbeda ke keranjang']);
                } else {
                    $cartProduct->update([
                        'qty' => $cartProduct->qty + $results['qty'],
                        'total_price' => $this->price * ($cartProduct->qty + $results['qty'])
                    ]);
                    return response()->json(['message' => 'Produk sudah dimasukkan ke keranjang, jumlah ditambahkan']);
                }
            }
        } else {
            return response()->json(['message' => 'Anda harus login terlebih dahulu']);
        }

    }
    public function showChoosedVarOptions($choosedVarOptions, $price)
    {
        $countVariation = count($this->product->variation);
        $this->price = $price;
        $this->totalPrice = $price;
        $exploded = explode('_', $choosedVarOptions);
        $varOptionId = VariationOption::findOrFail($exploded[1])->id;
        $varOptionName = VariationOption::findOrFail($exploded[1])->name;
        $this->stock = VariationOption::findOrFail($exploded[1])->stock;

        $foundIndex = null;
        for ($i = 0; $i < count($this->choosedVarOptions); $i++) {
            if ($exploded[0] === explode('_', $this->choosedVarOptions[$i])[0]) {
                $foundIndex = $i;
                break;
            }
        }

        $this->choosedVarOptionsForCart[] = implode('_', [$exploded[0], $varOptionId, $exploded[2]]);

        if ($foundIndex !== null) {
            $this->choosedVarOptions[$foundIndex] = implode('_', [$exploded[0], $varOptionName, $exploded[2]]);
        } else {
            $this->choosedVarOptions[] = implode('_', [$exploded[0], $varOptionName, $exploded[2]]);
        }
        $this->choosedVarOptions = array_slice($this->choosedVarOptions, 0, $countVariation);
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
