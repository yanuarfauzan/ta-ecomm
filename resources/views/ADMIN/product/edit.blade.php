@extends('ADMIN.partial.main')
@section('content')
    <section class="section">
        <div class="section-header">
            <div class="section-header-back">
                <a href="{{ url('/admin/list-product') }}"><i class="fas fa-arrow-left"></i></a>
            </div>
            <h1>EDIT PRODUCT</h1>
        </div>
    </section>

    <div class="card">
        <div class="card-header">
            <h4>Edit Product</h4>
        </div>
        <div class="card-body col">
            <form action="{{ url('/admin/update-product/' . $product->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="name" class="form-label">Nama Produk</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                        name="name" value="{{ old('nam', $product->name) }}" >
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="variation_id">Pilih Kategori</label>
                    <select name="category_id" class="form-control" id="category_id">
                        <option value="" selected disabled>Pilih Kategori</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}" {{ $product->hasCategory[0]->id == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                        @endforeach
                    </select>
                    @error('category_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="d-flex justify-content-center align-items-center w-100">
                    <div class="form-group w-25 me-4" style="margin-right: 20px;">
                        <label for="variation_id">Pilih Variasi Pertama</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                        name="variation1" value="{{old('variation1', $product->variation[0]->name ?? null) }}">
                        @error('variation1')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group w-25 me-4" style="margin-right: 20px;">
                        <label for="variation_id">Pilih Variasi Kedua</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                        name="variation2" value="{{ old('variation2', $product->variation[1]->name ?? null) }}">
                        @error('variation2')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="mb-3">
                    <label for="stock" class="form-label">Stock</label>
                    <input type="number" class="form-control @error('stock') is-invalid @enderror" id="stock"
                        name="stock" value="{{ old('stock', $product->stock) }}" >
                    @error('stock')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="images">Gambar Produk</label>
                    <input type="file" class="form-control-file @error('images.*') is-invalid @enderror" id="images"
                        name="images[]" multiple value="{{ old('images.*') }}">
                    @error('images.*')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="price" class="form-label">Harga Produk</label>
                    <input type="number" class="form-control @error('price') is-invalid @enderror" id="price"
                        name="price" value="{{ old('price', $product->price) }}" >
                    @error('price')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="desc" class="form-label">Deskripsi</label>
                    <input type="text" class="form-control @error('desc') is-invalid @enderror" id="desc"
                        name="desc" value="{{ old('desc', $product->desc) }}" >
                    @error('desc')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="discount" class="form-label">Diskon (%)</label>
                    <input type="number" step="0.01" class="form-control @error('discount') is-invalid @enderror"
                        id="discount" name="discount" value="{{ old('discount', $product->discount) }}" >
                    @error('discount')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="d-flex justify-content-center align-items-center w-100">
                    <div class="form-group" class="w-25" style="margin-right: 20px;">
                        <label for="voucher_id_1">Pilih Voucher Pertama</label>
                        <select name="voucher_id_1" class="form-control" id="voucher_id_1">
                            <option value="" selected disabled>Pilih Voucher</option>
                            @foreach ($vouchers as $voucher)
                                <option value="{{ isset($product->voucher[0]->pivot->id) ? $product->voucher[0]->pivot->id . '_' . $voucher->id : $voucher->id }}" {{ isset($product->voucher[0]->id) && $product->voucher[0]->id == $voucher->id ? 'selected' : '' }}>{{ $voucher->name }}</option>
                            @endforeach
                        </select>
                        @error('category_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group" class="w-25" style="margin-right: 20px;">
                        <label for="voucher_id_2">Pilih Voucher Kedua</label>
                        <select name="voucher_id_2" class="form-control" id="voucher_id_2">
                            <option value="" selected disabled>Pilih Voucher</option>
                            @foreach ($vouchers as $voucher)
                            <option value="{{ isset($product->voucher[1]->pivot->id) ? $product->voucher[1]->pivot->id . '_' . $voucher->id : $voucher->id }}" {{ isset($product->voucher[1]->id) && $product->voucher[1]->id == $voucher->id ? 'selected' : '' }}>{{ $voucher->name }}</option>

                            @endforeach
                        </select>
                        @error('category_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="mb-3">
                    <label for="weight" class="form-label">Berat Produk (Kg)</label>
                    <input type="number" step="0.01" class="form-control @error('weight') is-invalid @enderror"
                        id="weight" name="weight" value="{{ old('weight', $product->weight) }}" >
                    @error('weight')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="dimensions" class="form-label">Dimensi Produk (cm)</label>
                    <div class="input-group ">
                        @php
                            $dimensionsArray = explode('x', $product->dimensions);
                            $length = $dimensionsArray[0] ?? '';
                            $width = $dimensionsArray[1] ?? '';
                            $height = $dimensionsArray[2] ?? '';
                        @endphp
                        <input type="number" class="form-control @error('length') is-invalid @enderror" id="length"
                            name="length" value="{{ old('length', $length) }}" required>
                            @error('length')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        <span class="input-group-text">x</span>
                        <input type="number" class="form-control @error('width') is-invalid @enderror" id="width" name="width"
                            value="{{ old('width', $width) }}" required>
                            @error('width')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        <span class="input-group-text">x</span>
                        <input type="number" class="form-control @error('height') is-invalid @enderror" id="height" name="height"
                            value="{{ old('height', $height) }}" required>
                        @error('height')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Update</button>
            </form>
        </div>
    </div>
@endsection
