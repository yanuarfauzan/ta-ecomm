<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Str;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use App\Rules\ImageResolution;
use App\Models\ProductAssessment;
use Illuminate\Support\Facades\Storage;

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
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'SKU' => 'required|string|max:255|unique:product,SKU',
            'stock' => 'required|integer',
            'price' => 'required|integer',
            'discount' => 'required|numeric|min:0|max:100',
            'desc' => 'nullable|string',
            'weight' => 'required|numeric',
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

        $dimensions = $validatedData['length'] . 'x' . $validatedData['width'] . 'x' . $validatedData['height'];

        // Simpan produk
        $product = new Product();
        $product->name = $validatedData['name'];
        $product->SKU = $validatedData['SKU'];
        $product->stock = $validatedData['stock'];
        $product->price = $validatedData['price'];
        $product->desc = $validatedData['desc'];
        $product->discount = $validatedData['discount'];
        $product->weight = $validatedData['weight'];
        $product->dimensions = $dimensions;

        $product->save();

        // Simpan gambar
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                // Simpan gambar ke folder yang ditentukan
                $imagePath = $image->store('public/product-images');

                // Buat record baru untuk gambar produk
                $productImage = new ProductImage();
                $productImage->id = (string) Str::uuid();
                $productImage->product_id = $product->id;
                $productImage->filepath_image = Storage::url($imagePath);
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
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'SKU' => 'required|string|max:255|unique:product,SKU,' . $id,
            'stock' => 'required|integer',
            'price' => 'required|integer',
            'discount' => 'required|numeric|min:0|max:100',
            'desc' => 'nullable|string',
            'weight' => 'required|numeric',
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

        $dimensions = $validatedData['length'] . 'x' . $validatedData['width'] . 'x' . $validatedData['height'];

        $product = Product::findOrFail($id);

        $product->name = $validatedData['name'];
        $product->SKU = $validatedData['SKU'];
        $product->stock = $validatedData['stock'];
        $product->price = $validatedData['price'];
        $product->desc = $validatedData['desc'];
        $product->discount = $validatedData['discount'];
        $product->weight = $validatedData['weight'];
        $product->dimensions = $dimensions;

        $product->save();

        if ($request->hasFile('images')) {
            ProductImage::where('product_id', $product->id)->delete();

            foreach ($request->file('images') as $image) {
                $imagePath = $image->store('public/product-images');

                $productImage = new ProductImage();
                $productImage->id = (string) Str::uuid();
                $productImage->product_id = $product->id;
                $productImage->filepath_image = Storage::url($imagePath);
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

        // Delete associated product images
        $productImages = ProductImage::where('product_id', $product->id)->get();
        foreach ($productImages as $productImage) {
            // Delete the image file from storage
            Storage::delete(str_replace('/storage/', 'public/', $productImage->filepath_image));
            // Delete the image record from the database
            $productImage->delete();
        }

        // Delete the product
        $product->delete();
        return redirect()->to('/admin/list-product')->with('delete', 'Produk Telah Dihapus');
    }
}
