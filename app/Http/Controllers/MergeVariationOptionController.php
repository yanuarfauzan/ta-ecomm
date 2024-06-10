<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\VariationOption;
use Illuminate\Support\Facades\Log;
use App\Models\MergeVariationOption;
use Illuminate\Support\Facades\Validator;

class MergeVariationOptionController extends Controller
{
    public function index()
    {
        $mergeVariationOptions = MergeVariationOption::paginate(10);
        return view('ADMIN.merge_varOption.list', compact('mergeVariationOptions'));
    }

    public function create(Request $request)
    {
        $products = Product::all();

        return view('ADMIN.merge_varOption.create', compact('products'));
    }

    public function store(Request $request)
    {
        $validatedMerge = Validator::make($request->all(), [
            'product_id' => 'required|exists:product,id',
            'variation_option_1_id' => 'required|exists:variation_option,id',
            'variation_option_2_id' => 'required|exists:variation_option,id',
            'merge_stock' => 'required|integer|min:0',
        ]);

        if($validatedMerge->fails()) {
            return back()->withErrors($validatedMerge->errors())->withInput();
        }

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
        $product = Product::with('variation.variationOption')->findOrFail($productId)->variation;
        return response()->json($product);

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
        $validatedMerge = Validator::make($request->all(), [
            'product_id' => 'required|exists:product,id',
            'variation_option_1_id' => 'required|exists:variation_option,id',
            'variation_option_2_id' => 'required|exists:variation_option,id',
            'merge_stock' => 'required|integer|min:0',
        ]);

        if($validatedMerge->fails()) {
            return back()->withErrors($validatedMerge->errors())->withInput();
        }

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
