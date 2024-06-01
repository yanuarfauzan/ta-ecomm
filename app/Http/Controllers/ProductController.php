<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Str;
use App\Models\ProductImage;
use Illuminate\Http\Request;
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
            'images.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:5120',
        ]);

        // Hitung price_after_discount (diskon dalam persentase)
        $price_after_discount = $validatedData['price'] * ((100 - $validatedData['discount']) / 100);

        $dimensions = $validatedData['length'] . 'x' . $validatedData['width'] . 'x' . $validatedData['height'];

        // Simpan produk
        $product = new Product();
        $product->name = $validatedData['name'];
        $product->SKU = $validatedData['SKU'];
        $product->stock = $validatedData['stock'];
        $product->price = $validatedData['price'];
        $product->price_after_discount = $price_after_discount;
        $product->desc = $validatedData['desc'];
        $product->discount = $validatedData['discount'];
        $product->weight = $validatedData['weight'];
        $product->dimensions = $dimensions;

        // Simpan produk ke database
        $product->save();

        // Hitung dan simpan rating
        $averageRating = ProductAssessment::where('product_id', $product->id)->avg('rating');
        $product->rate = $averageRating ?? 0;
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
            'images.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Hitung price_after_discount (diskon dalam persentase)
        $price_after_discount = $validatedData['price'] * ((100 - $validatedData['discount']) / 100);

        // Gabungkan dimensi menjadi satu string
        $dimensions = $validatedData['length'] . 'x' . $validatedData['width'] . 'x' . $validatedData['height'];

        // Cari produk berdasarkan ID
        $product = Product::findOrFail($id);

        // Perbarui data produk
        $product->name = $validatedData['name'];
        $product->SKU = $validatedData['SKU'];
        $product->stock = $validatedData['stock'];
        $product->price = $validatedData['price'];
        $product->price_after_discount = $price_after_discount;
        $product->desc = $validatedData['desc'];
        $product->discount = $validatedData['discount'];
        $product->weight = $validatedData['weight'];
        $product->dimensions = $dimensions;

        // Simpan perubahan produk ke database
        $product->save();

        // Hitung dan simpan rating
        $averageRating = ProductAssessment::where('product_id', $product->id)->avg('rating');
        $product->rate = $averageRating ?? 0;
        $product->save();

        // Simpan gambar baru jika ada
        if ($request->hasFile('images')) {
            // Hapus gambar lama
            ProductImage::where('product_id', $product->id)->delete();

            // Simpan gambar baru
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

        return redirect('/admin/list-product')->with('success', 'Produk Berhasil Diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->to('/admin/list-product')->with('delete', 'Produk Telah Dihapus');
    }
}
