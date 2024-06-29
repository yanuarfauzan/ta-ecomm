@extends('ADMIN.partial.main')
@section('content')
    <section class="section">
        <div class="section-header">
            <div class="section-header-back">
                <a href="{{ url('/admin/list-product') }}"><i class="fas fa-arrow-left"></i></a>
            </div>
            <h1>PRODUK</h1>
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
            <h4>ISI DATA PRODUK</h4>
        </div>
        <div class="card-body col">
            <form action="{{ url('/admin/store-product') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">Nama Produk</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                        name="name" value="{{ old('name') }}">
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="variation_id">Pilih Kategori</label>
                    <select name="category_id" class="form-control" id="category_id">
                        <option value="" selected disabled>Pilih Kategori</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
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
                            name="variation1" value="{{ old('variation1') }}">
                        @error('variation1')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group w-25 me-4" style="margin-left: 20px;">
                        <label for="variation_id">Pilih Variasi Kedua</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                            name="variation2" value="{{ old('variation2') }}">
                        @error('variation2')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="mb-3">
                    <label for="stock" class="form-label">Stock</label>
                    <input type="number" class="form-control @error('stocl') is-invalid @enderror" id="stock"
                        name="stock" value="{{ old('stock') }}">
                    @error('stock')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="product_image">Gambar Produk</label>
                    <input type="file" class="form-control-file @error('images.*') is-invalid @enderror"
                        id="product_image" name="images[]" multiple value="{{ old('images.*') }}">
                    @error('images.*')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <span>Nama file harus sesuai dengan gambar produk.</span>
                </div>
                <div class="mb-3">
                    <label for="price" class="form-label">Harga Produk</label>
                    <input type="number" class="form-control @error('price') is-invalid @enderror" id="price"
                        name="price" value="{{ old('price') }}">
                    @error('price')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="desc" class="form-label">Deskripsi</label>
                    <input type="text" class="form-control @error('desc') is-invalid @enderror" id="desc"
                        name="desc" value="{{ old('desc') }}">
                    @error('desc')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="discount" class="form-label">Diskon (%)</label>
                    <input type="number" step="0.01" class="form-control @error('discount') is-invalid @enderror"
                        id="discount" name="discount" value="{{ old('discount') }}">
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
                                <option value="{{ $voucher->id }}">{{ $voucher->name }}</option>
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
                                <option value="{{ $voucher->id }}">{{ $voucher->name }}</option>
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
                        id="weight" name="weight" value="{{ old('weight') }}">
                    @error('weight')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="dimensions" class="form-label">Dimensi Produk (cm)</label>
                    <div class="input-group @error('dimensions') is-invalid @enderror">
                        <input type="text" class="form-control" id="length" name="length" placeholder="Panjang"
                            value="{{ old('length') }}" required>
                        <span class="input-group-text">x</span>
                        <input type="text" class="form-control" id="width" name="width" placeholder="Lebar"
                            value="{{ old('width') }}" required>
                        <span class="input-group-text">x</span>
                        <input type="text" class="form-control" id="height" name="height" placeholder="Tinggi"
                            value="{{ old('height') }}" required>
                        @error('dimension')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </form>
        </div>
    </div>
@endsection
