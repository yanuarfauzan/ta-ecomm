<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Variation;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use App\Models\VariationOption;
use Illuminate\Contracts\Support\ValidatedData;

class VariationOptionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $variationOptions = VariationOption::with('variation', 'productImage')->get();
        return view('ADMIN.variation-option.list', compact('variationOptions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $variations = Variation::all();
        $products = Product::all();
        $variationOption = new VariationOption(); // Create a new empty VariationOption object
        return view('ADMIN.variation-option.create', compact('variations', 'products', 'variationOption'));
    }

    public function getImagesByProduct($productId)
    {
        // dd('sini2');
        $images = ProductImage::where('product_id', $productId)->get(['id', 'filepath_image']);
        return response()->json($images);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'variation_id' => 'required|exists:variation,id',
            'product_image_id' => 'required|exists:product_image,id',
            'name' => 'required|string|max:255',
            'stock' => 'required|integer',
            'price' => 'required|numeric',
            'weight' => 'required|numeric',
        ]);

        $dimensions = $request->input('length') . 'x' . $request->input('width') . 'x' . $request->input('height');

        $variationOption = new VariationOption();
        $variationOption->variation_id = $request->variation_id;
        $variationOption->product_image_id = $request->product_image_id;
        $variationOption->name = $request->name;
        $variationOption->stock = $request->stock;
        $variationOption->price = $request->price;
        $variationOption->weight = $request->weight;
        $variationOption->dimensions = $dimensions;
        $variationOption->save();

        return redirect('/admin/list-variation-option')->with('success', 'Variasi Opsi Berhasil Dibuat');
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $variationOption = VariationOption::findOrFail($id);
        $variations = Variation::all();
        $products = Product::all();

        return view('ADMIN.variation-option.edit', compact('variationOption', 'variations', 'products'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'variation_id' => 'required|exists:variation,id',
            'product_image_id' => 'required|exists:product_image,id',
            'name' => 'required|string|max:255',
            'stock' => 'required|integer',
            'price' => 'required|numeric',
            'weight' => 'required|numeric',
        ]);

        $dimensions = $request->input('length') . 'x' . $request->input('width') . 'x' . $request->input('height');

        $variationOption = VariationOption::findOrFail($id);
        $variationOption->variation_id = $request->variation_id;
        $variationOption->product_image_id = $request->product_image_id;
        $variationOption->name = $request->name;
        $variationOption->stock = $request->stock;
        $variationOption->price = $request->price;
        $variationOption->weight = $request->weight;
        $variationOption->dimensions = $dimensions;
        $variationOption->save();

        return redirect('/admin/list-variation-option')->with('success', 'Variasi Opsi Berhasil Diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $variationOption = VariationOption::findOrFail($id);

        $variationOption->delete();

        return redirect('/admin/list-variation-option')->with('delete', 'Variasi Opsi Berhasil Dihapus');
    }
}
