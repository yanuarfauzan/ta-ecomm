<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

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
        $request->validate([
            'name' => 'required|string|max:255',
            'SKU' => 'required|string|max:255',
            'stock' => 'required',
            'product_image' => 'image|mimes:jpeg,png,jpg,gif|max:5120',
            'price' => 'required',
            'desc' => 'required|string|max:255',
            'discount' => 'required',
            'weight' => 'required',
            'dimensions' => 'required'
        ]);

        $productImage_path = null;

        if ($request->hasFile('product_image')) {
            $productImage = $request->file('product_image');
            $productImage_name = time() . '.' . $productImage->getClientOriginalExtension();
            $productImage->move(public_path('product_image'), $productImage_name);
            $productImage_path = 'product_image/' . $productImage_name;
        }

        Product::create([
            'name' => $request->name,
            'SKU' => $request->SKU,
            'stock' => $request->stock,
            'product_image' => $productImage_path,
            'price' => $request->price,
            'desc' => $request->desc,
            'discount' => $request->discount,
            'weight' => $request->weight,
            'dimensions' => $request->dimensions,
        ]);

        return redirect('/admin/list-product')->with('success', 'Category created successfully');
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
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required',
            'SKU' => 'required',
            'stock' => 'required',
            'product_image' => 'image|mimes:jpeg,png,jpg,gif|max:5120',
            'price' => 'required',
            'desc' => 'required',
            'discount' => 'required',
            'weight' => 'required',
            'dimensions' => 'required',
        ]);

        if ($request->hasFile('product_image')) {
            $productImage = $request->file('product_image');
            $productImage_name = time() . '.' . $productImage->getClientOriginalExtension();
            $productImage->move(public_path('product_image'), $productImage_name);
            $productImage_path = 'product_image/' . $productImage_name;

            $product->update([
                'name' => $request->name,
                'SKU' => $request->SKU,
                'stock' => $request->stock,
                'product_image' => $productImage_path,
                'price' => $request->price,
                'desc' => $request->desc,
                'discount' => $request->discount,
                'weight' => $request->weight,
                'dimensions' => $request->dimensions,
            ]);
        } else {
            $product->update([
                'name' => $request->name,
                'SKU' => $request->SKU,
                'stock' => $request->stock,
                'price' => $request->price,
                'desc' => $request->desc,
                'discount' => $request->discount,
                'weight' => $request->weight,
                'dimensions' => $request->dimensions,
            ]);
        }

        return redirect('/admin/list-product')->with('success', 'Category updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->to('/admin/list-product')->with('delete', 'Data Kategori Telah Dihapus');
    }
}
