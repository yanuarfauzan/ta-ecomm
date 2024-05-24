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
                <div class="form-group">
                    <label for="SKU">Kode Produk</label>
                    <input type="text" class="form-control" id="SKU" name="SKU" value="{{ $product->SKU }}" required>
                </div>
                <div class="mb-3">
                    <label for="name" class="form-label">Nama Produk</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ $product->name }}">
                </div>
                <div class="form-group">
                    <label for="stock">Stock</label>
                    <input type="number" class="form-control" id="stock" name="stock" value="{{ $product->stock }}" required>
                </div>
                <div class="mb-3">
                    <label for="product_image">Gambar Produk</label>
                    @if ($product->product_image)
                        <div class="mb-2">
                            <img src="{{ asset($product->product_image) }}" alt="Product Image" style="max-width: 100px;">
                        </div>
                    @endif
                    <input type="file" class="form-control-file" id="product_image" name="product_image">
                </div>
                <div class="form-group">
                    <label for="price">Harga Produk</label>
                    <input type="number" class="form-control" id="price" name="price" value="{{ $product->price }}" required>
                </div>
                <div class="form-group">
                    <label for="desc">Deskripsi</label>
                    <textarea class="form-control" id="desc" name="desc" rows="3" required>{{ $product->desc }}</textarea>
                </div>
                <div class="form-group">
                    <label for="discount">Diskon (%)</label>
                    <input type="number" step="0.01" class="form-control" id="discount" name="discount" value="{{ $product->discount }}" required>
                </div>
                <div class="form-group">
                    <label for="weight">Berat Produk (Kg):</label>
                    <input type="number" step="0.01" class="form-control" id="weight" name="weight" value="{{ $product->weight }}" required>
                </div>
                <div class="form-group">
                    <label for="dimensions">Dimensi Produk (cm):</label>
                    <input type="text" class="form-control" id="dimensions" name="dimensions" value="{{ $product->dimensions }}" required>
                </div>
                <button type="submit" class="btn btn-primary">Update</button>
            </form>
        </div>
    </div>
@endsection
