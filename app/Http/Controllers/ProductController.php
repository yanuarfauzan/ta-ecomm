<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Str;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use App\Rules\ImageResolution;
use App\Models\ProductAssessment;
use Illuminate\Auth\Events\Validated;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $product = Product::all();
        return view('ADMIN.product.list', compact('product'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('ADMIN.product.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'stock' => 'nullable|integer',
            'price' => 'required|integer',
            'discount' => 'nullable|numeric|min:0|max:100',
            'desc' => 'nullable|string',
            'weight' => 'nullable|numeric',
            'length' => 'required|numeric',
            'width' => 'required|numeric',
            'height' => 'required|numeric',
            'images.*' => [
                'required',
                'image',
                'mimes:jpeg,png,jpg,gif',
                'max:5120',
                new ImageResolution(1080, 1080)
            ],
        ]);

        if ($validatedData->fails()) {
            return back()->withErrors($validatedData->errors())->withInput();
        }

        // $prefix = 'EPRD';
        // $uniqueNumber = $this->generateUniqueSKU();
        // $sku = $prefix . $uniqueNumber;
        $dimensions = $validatedData->validated()['length'] . 'x' . $validatedData->validated()['width'] . 'x' . $validatedData->validated()['height'];

        $product = new Product();
        $product->name = $validatedData->validated()['name'];
        $product->SKU = $this->generateUniqueSKU();
        $product->stock = $validatedData->validated()['stock'];
        $product->price = $validatedData->validated()['price'];
        $product->desc = $validatedData->validated()['desc'];
        $product->discount = $validatedData->validated()['discount'];
        $product->weight = $validatedData->validated()['weight'];
        $product->dimensions = $dimensions;

        $product->save();

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $originalName = $image->getClientOriginalName();
                $imagePath = $image->storeAs('public/product-images', $originalName);
                $imagePath = 'product-images/' . $originalName;

                $productImage = new ProductImage();
                $productImage->id = (string) Str::uuid();
                $productImage->product_id = $product->id;
                $productImage->filepath_image = $imagePath;
                $productImage->save();
            }
        }

        return redirect('/admin/list-product')->with('success', 'Produk Berhasil Dibuat');
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
        $product = Product::findOrFail($id);
        return view('ADMIN.product.edit', compact('product'));
    }

    /** 
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // dd($request->all());
        $validatedData = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'stock' => 'nullable|integer',
            'price' => 'required|integer',
            'discount' => 'nullable|numeric|min:0|max:100',
            'desc' => 'nullable|string',
            'weight' => 'nullable|numeric',
            'length' => 'required|numeric',
            'width' => 'required|numeric',
            'height' => 'required|numeric',
            'images.*' => [
                'image',
                'mimes:jpeg,png,jpg,gif',
                'max:5120',
                new ImageResolution(1080, 1080)
            ],
        ]);

        if ($validatedData->fails()) {
            return back()->withErrors($validatedData->errors())->withInput();
        }

        $product = Product::findOrFail($id);

        $dimensions = $validatedData->validated()['length'] . 'x' . $validatedData->validated()['width'] . 'x' . $validatedData->validated()['height'];

        $product->name = $validatedData->validated()['name'];
        $product->stock = $validatedData->validated()['stock'];
        $product->price = $validatedData->validated()['price'];
        $product->desc = $validatedData->validated()['desc'];
        $product->discount = $validatedData->validated()['discount'];
        $product->weight = $validatedData->validated()['weight'];
        $product->dimensions = $dimensions;

        $product->save();

        if ($request->hasFile('images')) {
            ProductImage::where('product_id', $product->id)->delete();

            foreach ($request->file('images') as $image) {
                $originalName = $image->getClientOriginalName();
                $imagePath = $image->storeAs('public/product-images', $originalName);
                $imagePath = 'product-images/' . $originalName;

                $productImage = new ProductImage();
                $productImage->id = (string) Str::uuid();
                $productImage->product_id = $product->id;
                $productImage->filepath_image = $imagePath;
                $productImage->save();
            }
        }

        return redirect('/admin/list-product')->with('success', 'Produk Berhasil Diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id);

        $productImages = ProductImage::where('product_id', $product->id)->get();
        foreach ($productImages as $productImage) {
            Storage::delete(str_replace('/storage/', 'public/', $productImage->filepath_image));
            $productImage->delete();
        }

        $product->delete();
        return redirect()->to('/admin/list-product')->with('delete', 'Produk Telah Dihapus');
    }

    private function generateUniqueSKU()
    {
        $prefix = 'EPRD-';
        $uniqueCode = $prefix . strtoupper(Str::random(8));

        while (Product::where('SKU', $uniqueCode)->exists()) {
            $uniqueCode = $prefix . strtoupper(Str::random(8));
        }

        return $uniqueCode;
    }
}
