<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\VariationOption;
use App\Models\MergeVariationOption;

class MergeVariationOptionController extends Controller
{
    public function index()
    {
        $mergeVariationOptions = MergeVariationOption::all();
        return view('ADMIN.merge_varOption.list', compact('mergeVariationOptions'));
    }

    public function create(Request $request)
    {
        $products = Product::all();

        return view('ADMIN.merge_varOption.create', compact('products'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:product,id',
            'variation_option_1_id' => 'required|exists:variation_option,id',
            'variation_option_2_id' => 'required|exists:variation_option,id',
            'merge_stock' => 'required|integer|min:0',
        ]);

        $mergeVariationOption = new MergeVariationOption();
        $mergeVariationOption->product_id = $request->product_id;
        $mergeVariationOption->variation_option_1_id = $request->variation_option_1_id;
        $mergeVariationOption->variation_option_2_id = $request->variation_option_2_id;
        $mergeVariationOption->merge_stock = $request->merge_stock;
        $mergeVariationOption->save();

        return redirect('/admin/list-merge-varOption')->with('success', 'Merge Variation Option Berhasil Dibuat.');
    }

    public function getVarOption(Request $request, $productId)
    {
        $product = Product::with('productImages.variationOptions')->find($productId);

        if ($product) {
            $variationOptions = [];
            foreach ($product->productImages as $productImage) {
                foreach ($productImage->variationOptions as $option) {
                    $variationOptions[$option->id] = $option->name;
                }
            }
            return response()->json($variationOptions);
        } else {
            return response()->json(['error' => 'Product not found'], 404);
        }
    }

    public function edit($id)
    {
        $mergeVariationOption = MergeVariationOption::findOrFail($id);
        $products = Product::all();
        $variationOptions1 = VariationOption::whereHas('productImage', function ($query) use ($mergeVariationOption) {
            $query->where('product_id', $mergeVariationOption->product_id);
        })->get();

        $variationOptions2 = VariationOption::whereHas('productImage', function ($query) use ($mergeVariationOption) {
            $query->where('product_id', $mergeVariationOption->product_id);
        })->get();

        return view('ADMIN.merge_varOption.edit', compact('mergeVariationOption', 'products', 'variationOptions1', 'variationOptions2'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'product_id' => 'required|exists:product,id',
            'variation_option_1_id' => 'required|exists:variation_option,id',
            'variation_option_2_id' => 'required|exists:variation_option,id',
            'merge_stock' => 'required|integer|min:0',
        ]);

        $mergeVariationOption = MergeVariationOption::findOrFail($id);
        $mergeVariationOption->product_id = $request->product_id;
        $mergeVariationOption->variation_option_1_id = $request->variation_option_1_id;
        $mergeVariationOption->variation_option_2_id = $request->variation_option_2_id;
        $mergeVariationOption->merge_stock = $request->merge_stock;
        $mergeVariationOption->save();

        return redirect('/admin/list-merge-varOption')->with('success', 'Merge Variation Option Berhasil Diperbarui.');
    }

    public function destroy($id)
    {
        $mergeVariationOption = MergeVariationOption::findOrFail($id);
        $mergeVariationOption->delete();

        return redirect('/admin/list-merge-varOption')->with('delete', 'Merge Variation Option Telah Dihapus.');
    }
}
