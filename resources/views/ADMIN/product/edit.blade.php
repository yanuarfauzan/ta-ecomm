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
                    <label for="SKU" class="form-label">Kode Produk</label>
                    <input type="text" class="form-control @error('SKU') is-invalid @enderror" id="SKU"
                        name="SKU" value="{{ $product->SKU }}" required>
                    @error('SKU')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="name" class="form-label">Nama Produk</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                        name="name" value="{{ $product->name }}" required>
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="stock" class="form-label">Stock</label>
                    <input type="number" class="form-control @error('stock') is-invalid @enderror" id="stock"
                        name="stock" value="{{ $product->stock }}" required>
                    @error('stock')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="images">Gambar Produk</label>
                    <input type="file" class="form-control-file @error('images.*') is-invalid @enderror" id="images"
                        name="images[]" multiple>
                    @error('images.*')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="price" class="form-label">Harga Produk</label>
                    <input type="number" class="form-control @error('price') is-invalid @enderror" id="price"
                        name="price" value="{{ $product->price }}" required>
                    @error('price')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="desc" class="form-label">Deskripsi</label>
                    <input type="text" class="form-control @error('desc') is-invalid @enderror" id="desc"
                        name="desc" value="{{ $product->desc }}" required>
                    @error('desc')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="discount" class="form-label">Diskon (%)</label>
                    <input type="number" step="0.01" class="form-control @error('discount') is-invalid @enderror"
                        id="discount" name="discount" value="{{ $product->discount }}" required>
                    @error('discount')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="weight" class="form-label">Berat Produk (Kg)</label>
                    <input type="number" step="0.01" class="form-control @error('weight') is-invalid @enderror"
                        id="weight" name="weight" value="{{ $product->weight }}" required>
                    @error('weight')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="dimensions" class="form-label">Dimensi Produk (cm)</label>
                    <div class="input-group">
                        @php
                            $dimensionsArray = explode('x', $product->dimensions);
                            $length = $dimensionsArray[0] ?? '';
                            $width = $dimensionsArray[1] ?? '';
                            $height = $dimensionsArray[2] ?? '';
                        @endphp
                        <input type="text" class="form-control @error('dimensions') is-invalid @enderror" id="length"
                            name="length" value="{{ $length }}" required>
                        <span class="input-group-text">x</span>
                        <input type="text" class="form-control" id="width" name="width"
                            value="{{ $width }}" required>
                        <span class="input-group-text">x</span>
                        <input type="text" class="form-control" id="height" name="height"
                            value="{{ $height }}" required>
                        @error('dimensions')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Update</button>
            </form>
        </div>
    </div>
@endsection
