@extends('ADMIN.partial.main')
@section('content')
    <section class="section">
        <div class="section-header">
            <div class="section-header-back">
                <a href="{{ url('/admin/list-variation-option') }}"><i class="fas fa-arrow-left"></i></a>
            </div>
            <h1>EDIT VARIATION OPTION</h1>
        </div>
    </section>

    <div class="card">
        <div class="card-header">
            <h4>Edit Variation Option</h4>
        </div>
        <div class="card-body col">
            <form action="{{ url('/admin/update-variation-option/' . $variationOption->id) }}" method="post"
                enctype="multipart/form-data">
                @csrf
                @method('PUT')
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
                    @error('product_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="variation_id">Nama Variasi</label>
                    <select name="variation_id" class="form-control" id="variation_id">
                        <option value="" selected disabled>Pilih Variasi</option>
                        @foreach ($variations as $variation)
                            <option value="{{ $variation->id }}"
                                {{ $variationOption->variation_id == $variation->id ? 'selected' : '' }}>
                                {{ $variation->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="name">Nama Variasi Opsi</label>
                    <input type="text" name="name" class="form-control  @error('name') is-invalid @enderror"
                        id="name" value="{{ old('name', $variationOption->name) }}">
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group" id="product_image_container">
                    <label for="product_image_id">Gambar Produk</label>
                    <select name="product_image_id" class="form-control" id="product_image_id">
                        <option value="" selected disabled>Pilih Gambar Produk</option>
                        @if ($variationOption->productImage && $variationOption->productImage->product)
                            @foreach ($variationOption->productImage->product->productImages as $image)
                                <option value="{{ $image->id }}"
                                    {{ $variationOption->product_image_id == $image->id ? 'selected' : '' }}>
                                    {{ basename($image->filepath_image) }}
                                </option>
                            @endforeach
                        @endif
                    </select>
                </div>
                @if ($variationOption->productImage)
                    <div id="selected_product_image_container" class="form-group">
                        <label for="selected_product_image">Preview Gambar Produk</label><br>
                        <img id="selected_product_image"
                            src="{{ Storage::url($variationOption->productImage->filepath_image) }}" alt="Gambar Produk"
                            style="max-width: 200px;">
                    </div>
                @endif
                <div class="form-group">
                    <label for="price">Tambahan Harga</label>
                    <input type="number" name="price" class="form-control  @error('price') is-invalid @enderror"
                        id="price" value="{{ old('price', $variationOption->price) }}">
                    @error('price')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="stock">Stock</label>
                    <input type="number" name="stock" class="form-control  @error('stock') is-invalid @enderror"
                        id="stock" value="{{ old('stock', $variationOption->stock) }}">
                    @error('stock')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="weight">Weight</label>
                    <input type="number" name="weight" class="form-control  @error('weight') is-invalid @enderror"
                        id="weight" value="{{ old('weight', $variationOption->weight) }}">
                    @error('weight')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="dimensions" class="form-label">Dimensi Produk (cm)</label>
                    <div class="input-group">
                        @php
                            $dimensions = explode('x', $variationOption->dimensions);
                        @endphp
                        <input type="text" class="form-control" id="length" name="length" placeholder="Panjang"
                            value="{{ old('length', $dimensions[0] ?? '') }}">
                        <span class="input-group-text">x</span>
                        <input type="text" class="form-control" id="width" name="width" placeholder="Lebar"
                            value="{{ old('width', $dimensions[1] ?? '') }}">
                        <span class="input-group-text">x</span>
                        <input type="text" class="form-control" id="height" name="height" placeholder="Tinggi"
                            value="{{ old('height', $dimensions[2] ?? '') }}">
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Update</button>
            </form>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
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
                        const imageUrl = `/storage/${image.filepath_image}`;
                        const filename = getImageFilename(image.filepath_image);
                        $productImageSelect.append(
                            `<option value="${image.id}" data-image-url="${imageUrl}" ${selectedImageId == image.id ? 'selected' : ''}>${filename}</option>`
                        );
                    });
                    if (selectedImageId) {
                        const selectedImageUrl = $productImageSelect.find(':selected').data('image-url');
                        $selectedProductImage.attr('src', selectedImageUrl);
                    }
                })
                .fail(function() {
                    $productImageSelect.empty().append(
                        '<option value="" selected disabled>Error loading images</option>');
                });
        }

        function getImageFilename(filepath) {
            return filepath.split('/').pop();
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
