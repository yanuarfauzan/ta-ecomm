@extends('ADMIN.partial.main')
@section('content')
    <section class="section">
        <div class="section-header">
            <div class="section-header-back">
                <a href="{{ url('/admin/list-variation-option') }}"><i class="fas fa-arrow-left"></i></a>
            </div>
            <h1>SUB VARIASI</h1>
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
            <h4>ISI DATA SUB VARIASI</h4>
        </div>
        <div class="card-body col">
            <form action="{{ url('/admin/store-variation-option') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="product_id">Pilih Produk</label>
                    <select name="product_id" class="form-control" id="product_id">
                        <option value="" selected disabled>Pilih Produk</option>
                        @foreach ($products as $product)
                            <option value="{{ $product->id }}"
                                {{ $variationOption->productImage && $variationOption->productImage->product_id == $product->id ? 'selected' : '' }}>
                                {{ $product->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="variation_id">Pilih Variasi</label>
                    <select name="variation_id" class="form-control" id="variation_id">
                        <option value="" selected disabled>Pilih Variasi</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="name">Nama Sub Variasi</label>
                    <input type="text" name="name" class="form-control  @error('name') is-invalid @enderror"
                        id="name">
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group" id="product_image_container">
                    <label for="product_image_id">Gambar Produk</label>
                    <select name="product_image_id" class="form-control" id="product_image_id">
                        <option value="" selected disabled>Pilih Gambar Produk</option>
                    </select>
                </div>
                <div id="selected_product_image_container" class="form-group">
                    <label for="selected_product_image">Pratinjau Gambar Produk</label><br>
                    <img id="selected_product_image"
                        src="{{ $variationOption->productImage ? Storage::url($variationOption->productImage->filepath_image) : '' }}"
                        alt="Gambar Produk" style="max-width: 200px;">
                </div>
                <div class="form-group">
                    <label for="price">Tambahan Harga</label>
                    <input type="number" name="price" class="form-control  @error('price') is-invalid @enderror"
                        id="price">
                    @error('price')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="stock">Stok</label>
                    <input type="number" name="stock" class="form-control  @error('stock') is-invalid @enderror"
                        id="stock">
                    @error('stock')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="weight">Berat</label>
                    <input type="number" name="weight" class="form-control  @error('weight') is-invalid @enderror"
                        id="weight">
                    @error('weight')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="dimensions" class="form-label">Dimensi Produk (cm)</label>
                    <div class="input-group">
                        <input type="text" class="form-control" id="length" name="length" placeholder="Panjang">
                        <span class="input-group-text">x</span>
                        <input type="text" class="form-control" id="width" name="width" placeholder="Lebar">
                        <span class="input-group-text">x</span>
                        <input type="text" class="form-control" id="height" name="height" placeholder="Tinggi">
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </form>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>

$(document).ready(function() {
            $('#product_id').change(function() {
                var productId = $(this).val();
                if (productId) {
                    $.ajax({
                        url: '/admin/product/' + productId + '/variations',
                        type: 'GET',
                        dataType: 'json',
                        success: function(data) {
                            $('#variation_id').empty();
                            $('#variation_id').append('<option value="" selected disabled>Pilih Variasi</option>');
                            $.each(data, function(key, variation) {
                                $('#variation_id').append('<option value="' + variation.id + '">' + variation.name + '</option>');
                            });
                        }
                    });
                } else {
                    $('#variation_id').empty();
                    $('#variation_id').append('<option value="" selected disabled>Pilih Variasi</option>');
                }
            });
        });

        $(document).ready(function() {
            const initialProductId =
                "{{ $variationOption->productImage ? $variationOption->productImage->product_id : '' }}";
            const initialProductImageId = "{{ $variationOption->product_image_id }}";

            if (initialProductId) {
                loadProductImages(initialProductId, initialProductImageId);
            }

            $('#product_id').change(function() {
                const productId = $(this).val();
                loadProductImages(productId);
            });

            $('#product_image_id').change(function() {
                const imageUrl = $(this).find(':selected').data('image-url');
                $('#selected_product_image').attr('src', imageUrl);
            });
        });

        function loadProductImages(productId, selectedImageId = null) {
            const $productImageSelect = $('#product_image_id');
            const $selectedProductImage = $('#selected_product_image');

            $productImageSelect.empty().append(
                '<option value="" selected disabled>Loading...</option>');

            $.getJSON(`/admin/products/${productId}/images`)
                .done(function(images) {
                    $productImageSelect.empty().append(
                        '<option value="" selected disabled>Pilih Gambar Produk</option>');
                    images.forEach(function(image) {
                        const filename = getImageFilename(image.filepath_image);    
                        const imageUrl = `/storage/${image.filepath_image}`;
                        $productImageSelect.append(
                            `<option value="${image.id}" data-image-url="${imageUrl}" ${selectedImageId == image.id ? 'selected' : ''}>${filename}</option>`
                        );
                    });
                    if (selectedImageId) {
                        const selectedImageUrl = $productImageSelect.find(':selected').data('image-url');
                        $selectedProductImage.attr('src', selectedImageUrl);
                    }
                })
                .fail(function(xhr, status, error) {
                    console.log(xhr.responseJSON);
                    $productImageSelect.empty().append(
                        '<option value="" selected disabled>Error loading images</option>');
                });
        }

        function getImageFilename(filepath) {
            return filepath.split('/').pop(); // Ambil bagian terakhir dari path sebagai nama file
        }
    </script>

    <style>
        .custom-select {
            position: relative;
            display: inline-block;
            width: 100%;
        }

        .custom-select select {
            display: none;
        }

        .custom-select select option {
            padding: 10px;
            background-size: cover;
        }
    </style>
@endsection
