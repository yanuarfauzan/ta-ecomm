<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\Variation;
use Illuminate\Support\Str;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use App\Models\VariationOption;
use Illuminate\Support\Facades\Validator;

class VariationOptionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $variationOptions = VariationOption::with('variation', 'productImage')->paginate(10);
        return view('ADMIN.variation-option.list', compact('variationOptions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $variations = Variation::all();
        $products = Product::all();
        $categories = Category::all();
        $variationOption = new VariationOption(); // Create a new empty VariationOption object
        return view('ADMIN.variation-option.create', compact('variations', 'products', 'variationOption', 'categories'));
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
        $validatedData = Validator::make($request->all(), [
            'variation_id' => 'required|exists:variation,id',
            'product_id' => 'required|exists:product,id',
            'category_id' => 'required|exists:category,id',
            'product_image_id' => 'required|exists:product_image,id',
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

        $variationOption = VariationOption::create([
            'variation_id' => $validatedData['variation_id'],
            'product_image_id' => $validatedData['product_image_id'],
            'name' => $validatedData['name'],
            'stock' => $validatedData['stock'],
            'price' => $validatedData['price'],
            'weight' => $validatedData['weight'],
            'dimensions' => $dimensions
        ]);

        $product = Product::findOrFail($request->product_id);
        $product->hasCategory()->syncWithoutDetaching([
            $validatedData['category_id'] => ['variation_id' => $validatedData['variation_id'], 'id' => Str::uuid(36)]
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
        return view('ADMIN.variation-option.edit', compact('variationOption', 'variations', 'products', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validatedData = Validator::make($request->all(), [
            'variation_id' => 'required',
            'product_id' => 'required|exists:product,id',
            'category_id' => 'required|exists:category,id',
            'product_image_id' => 'required|exists:product_image,id',
            'name' => 'required|string|max:255',
            'stock' => 'required|integer',
            'price' => 'required|numeric',
            'weight' => 'required|numeric',
            'length' => 'required',
            'width' => 'required',
            'height' => 'required'
        ]);

        if ($validatedData->fails()){
            return back()->withErrors($validatedData->errors())->withInput();
        }

        $validatedData = $validatedData->validated();
        $dimensions = $request->input('length') . 'x' . $request->input('width') . 'x' . $request->input('height');
        $variationOption = VariationOption::findOrFail($id);
        $variationOption->update([
            'variation_id' => explode('_', $validatedData['variation_id'])[1],
            'product_image_id' => $validatedData['product_image_id'],
            'name' => $validatedData['name'],
            'stock' => $validatedData['stock'],
            'price' => $validatedData['price'],
            'weight' => $validatedData['weight'],
            'dimensions' => $dimensions,
        ]);
        $product = Product::findOrFail($validatedData['product_id']);
        $product->hasCategory()
            ->wherePivot('variation_id', explode('_',$validatedData['variation_id'])[0])
            ->detach();

        $product->hasCategory()->attach([
            $validatedData['category_id'] => ['variation_id' => explode('_', $validatedData['variation_id'])[1], 'id' => Str::uuid(36)]
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
