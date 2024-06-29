<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\Variation;
use Illuminate\Support\Str;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use App\Models\VariationOption;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class VariationOptionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $variationOptions = VariationOption::with('variation', 'productImage')->paginate(10);
        $title = 'Sub Variasi';
        return view('ADMIN.variation-option.list', compact('variationOptions', 'title'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $products = Product::all();
        $variations = Variation::all();
        $categories = Category::all();
        $variationOption = new VariationOption(); // Create a new empty VariationOption object
        $title = 'Tambah Sub Variasi';
        return view('ADMIN.variation-option.create', compact('variations', 'products', 'variationOption', 'categories', 'title'));
    }

    public function getImagesByProduct($productId)
    {
        try {
            $images = ProductImage::where('product_id', $productId)->get(['id', 'filepath_image']);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
        }
        return response()->json($images);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = Validator::make($request->all(), [
            'variation_id' => 'required|exists:variation,id',
            'product_id' => 'required|exists:product,id',
            'product_image_id' => 'nullable|exists:product_image,id',
            'name' => 'required|string|max:255',
            'stock' => 'required|integer',
            'price' => 'nullable|numeric',
            'weight' => 'required|numeric',
            'length' => 'required',
            'width' => 'required',
            'height' => 'required',
        ]);

        if ($validatedData->fails()) {
            return back()->withErrors($validatedData->errors())->withInput();
        }
        $validatedData = $validatedData->validated();

        $dimensions = $validatedData['length'] . 'x' . $validatedData['width'] . 'x' . $validatedData['height'];

        Product::findOrFail($validatedData['product_id'])->variation
            ->where('id', $validatedData['variation_id'])->first()
            ->variationOption()->create([
                    'product_image_id' => $validatedData['product_image_id'] ?? null,
                    'name' => $validatedData['name'],
                    'stock' => $validatedData['stock'],
                    'price' => $validatedData['price'],
                    'weight' => $validatedData['weight'],
                    'dimensions' => $dimensions
                ]);
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
        $variationOption = VariationOption::with('product')->findOrFail($id);
        $variations = Variation::all();
        $products = Product::all();
        $categories = Category::all();
        $title = 'Edit Sub Variasi';
        return view('ADMIN.variation-option.edit', compact('variationOption', 'variations', 'products', 'categories', 'title'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validatedData = Validator::make($request->all(), [
            'variation_id' => 'required',
            'product_id' => 'required|exists:product,id',
            'product_image_id' => 'nullable|exists:product_image,id',
            'name' => 'required|string|max:255',
            'stock' => 'required|integer',
            'price' => 'nullable|numeric',
            'weight' => 'required|numeric',
            'length' => 'required',
            'width' => 'required',
            'height' => 'required'
        ]);

        if ($validatedData->fails()) {
            return back()->withErrors($validatedData->errors())->withInput();
        }

        $validatedData = $validatedData->validated();
        $dimensions = $request->input('length') . 'x' . $request->input('width') . 'x' . $request->input('height');
        $variationOption = VariationOption::findOrFail($id);
        $variationOption->update([
            'variation_id' => $validatedData['variation_id'],
            'product_image_id' => $validatedData['product_image_id'] ?? null,
            'name' => $validatedData['name'],
            'stock' => $validatedData['stock'],
            'price' => $validatedData['price'],
            'weight' => $validatedData['weight'],
            'dimensions' => $dimensions,
        ]);

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
