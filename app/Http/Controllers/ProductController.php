<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductVoucher;
use App\Models\Voucher;
use App\Models\Category;
use App\Models\Variation;
use Illuminate\Support\Str;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use App\Rules\ImageResolution;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $product = Product::orderBy('name')->paginate(10);
        $title = 'Produk';
        return view('ADMIN.product.list', compact('product', 'title'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        $variations = Variation::all();
        $vouchers = Voucher::all();
        $title = 'Tambah Produk';
        return view('ADMIN.product.create', compact('categories', 'variations', 'vouchers', 'title'));
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
                new ImageResolution(720, 720)
            ],
            'category_id' => 'required',
            'variation1' => 'required',
            'variation2' => 'required',
            'voucher_id_1' => 'nullable',
            'voucher_id_2' => 'nullable'
        ]);
        if ($validatedData->fails()) {
            return back()->withErrors($validatedData->errors())->withInput();
        }
        $validatedData = $validatedData->validated();
        $prefix = 'EPRD';
        $uniqueNumber = $this->generateUniqueSKU();
        $sku = $prefix . $uniqueNumber;
        $dimensions = $validatedData['length'] . 'x' . $validatedData['width'] . 'x' . $validatedData['height'];

        $priceAfterDiscount = null;
        if ($validatedData['discount']) {
            $priceAfterDiscount = $validatedData['price'] - $validatedData['price'] * ($validatedData['discount'] / 100);
        }
        $product = Product::create([
            'name' => $validatedData['name'],
            'SKU' => $sku,
            'price_after_dsicount' => $priceAfterDiscount,
            'stock' => $validatedData['stock'],
            'price' => $validatedData['price'],
            'desc' => $validatedData['desc'],
            'discount' => $validatedData['discount'],
            'weight' => $validatedData['weight'],
            'dimensions' => $dimensions
        ]);

        $variation1 = Variation::create([
            'name' => $validatedData['variation1']
        ]);
        $product->variation()->attach($variation1, ['id' => Str::uuid(36), 'category_id' => $validatedData['category_id']]);
        $variation2 = Variation::create([
            'name' => $validatedData['variation2']
        ]);
        $product->variation()->attach($variation2, ['id' => Str::uuid(36), 'category_id' => $validatedData['category_id']]);

        if ($validatedData['voucher_id_1']) {
            $product->voucher()->attach($validatedData['voucher_id_1'], ['id' => Str::uuid(36)]);
        }
        if ($validatedData['voucher_id_2']) {
            $product->voucher()->attach($validatedData['voucher_id_2'], ['id' => Str::uuid(36)]);
        }

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
        $product = Product::with('hasCategory')->findOrFail($id);
        $categories = Category::all();
        $variations = Variation::all();
        $vouchers = Voucher::all();
        $title = 'Edit Produk';
        return view('ADMIN.product.edit', compact('product', 'categories', 'variations', 'vouchers', 'title'));
    }

    /** 
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
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
                'image',
                'mimes:jpeg,png,jpg,gif',
                'max:5120',
                new ImageResolution(720, 720)
            ],
            'category_id' => 'required',
            'variation1' => 'required',
            'variation2' => 'required',
            'voucher_id_1' => 'nullable',
            'voucher_id_2' => 'nullable',
        ]);
        if ($validatedData->fails()) {
            return back()->withErrors($validatedData->errors())->withInput();
        }
        $validatedData = $validatedData->validated();
        $product = Product::findOrFail($id);

        $dimensions = $validatedData['length'] . 'x' . $validatedData['width'] . 'x' . $validatedData['height'];
        $priceAfterDiscount = null;
        if ($validatedData['discount']) {
            $priceAfterDiscount = $validatedData['price'] - $validatedData['price'] * ($validatedData['discount'] / 100);
        }
        $product->update([
            'name' => $validatedData['name'],
            'stock' => $validatedData['stock'],
            'price' => $validatedData['price'],
            'price_after_dsicount' => $priceAfterDiscount,
            'desc' => $validatedData['desc'],
            'discount' => $validatedData['discount'],
            'weight' => $validatedData['weight'],
            'dimensions' => $dimensions
        ]);
        $variation1 = $product->variation[0];
        $variation2 = $product->variation[1];

        $variation1->update(['name' => $validatedData['variation1']]);
        $variation2->update(['name' => $validatedData['variation2']]);

        $product->variation()->detach($variation1->id);
        $product->variation()->detach($variation2->id);

        $product->variation()->attach($variation1->id, [
            'id' => (string) Str::uuid(),
            'category_id' => $validatedData['category_id']
        ]);

        $product->variation()->attach($variation2->id, [
            'id' => (string) Str::uuid(),
            'category_id' => $validatedData['category_id']
        ]);
        $voucher1 = ProductVoucher::where('id', explode('_', $validatedData['voucher_id_1'])[0])->first();
        $voucher2 = ProductVoucher::where('id', explode('_', $validatedData['voucher_id_2'])[0])->first();
        if ($validatedData['voucher_id_1'] != null) {
            if ($voucher1) {
                $voucher1->delete();
                $product->voucher()->attach(explode('_', $validatedData['voucher_id_1'])[1], ['id' => Str::uuid(36)]);
            } else {
                $product->voucher()->attach($validatedData['voucher_id_1'], ['id' => Str::uuid(36)]);
            }
        }
        if ($validatedData['voucher_id_2'] != null) {
            if ($voucher2) {
                $voucher2->delete();
                $product->voucher()->attach(explode('_', $validatedData['voucher_id_2'])[1], ['id' => Str::uuid(36)]);
            } else {
                $product->voucher()->attach($validatedData['voucher_id_2'], ['id' => Str::uuid(36)]);
            }
        }

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
        $prefix = '#EPRD-';
        $uniqueCode = $prefix . strtoupper(Str::random(8));

        while (Product::where('SKU', $uniqueCode)->exists()) {
            $uniqueCode = $prefix . strtoupper(Str::random(8));
        }

        return $uniqueCode;
    }
    public function getVariations($id)
    {
        $variations = Product::findOrFail($id)->variation;
        Log::error($variations);
        return response()->json($variations);
    }

}
