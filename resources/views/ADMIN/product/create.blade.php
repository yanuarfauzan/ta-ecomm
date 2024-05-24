@extends('ADMIN.partial.main')
@section('content')
    <section class="section">
        <div class="section-header">
            <div class="section-header-back">
                <a href="{{ url('/admin/list-product') }}"><i class="fas fa-arrow-left"></i></a>
            </div>
            <h1>PRODUCT</h1>
        </div>

        <div class="section-body">
        </div>
    </section>

    @if (session('icon'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('icon') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    <div class="card">
        <div class="card-header">
            <h4>INPUT PRODUCT</h4>
        </div>
        <div class="card-body col">
            <form action="{{ url('/admin/store-product') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="SKU" class="form-label">Kode Produk</label>
                    <input type="text" class="form-control" id="SKU" name="SKU" required>
                </div>
                <div class="mb-3">
                    <label for="name" class="form-label">Nama Produk</label>
                    <input type="text" class="form-control" id="name" name="name" required>
                </div>
                <div class="mb-3">
                    <label for="stock" class="form-label">Stock</label>
                    <input type="number" class="form-control" id="stock" name="stock" required>
                </div>
                <div class="mb-3">
                    <label for="product_image">Gambar Produk</label>
                    <input type="file" class="form-control-file" id="product_image" name="product_image">
                </div>
                <div class="mb-3">
                    <label for="price" class="form-label">Harga Produk</label>
                    <input type="number" class="form-control" id="price" name="price" required>
                </div>
                <div class="mb-3">
                    <label for="desc" class="form-label">Deskripsi</label>
                    <input type="text" class="form-control" id="desc" name="desc" required>
                </div>
                <div class="mb-3">
                    <label for="discount" class="form-label">Diskon (%)</label>
                    <input type="number" step="0.01" class="form-control" id="discount" name="discount" required>
                </div>
                <div class="mb-3">
                    <label for="weight" class="form-label">Berat Produk (Kg)</label>
                    <input type="number" step="0.01" class="form-control" id="weight" name="weight" required>
                </div>
                <div class="mb-3">
                    <label for="dimensions" class="form-label">Dimensi Produk (cm)</label>
                    <input type="text" class="form-control" id="dimensions" name="dimensions" required>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
@endsection
