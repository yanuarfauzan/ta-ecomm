@extends('ADMIN.partial.main')
@section('content')
    <section class="section">
        <div class="section-header">
            <div class="section-header-back">
                <a href="{{ url('/admin/list-merge-varOption') }}"><i class="fas fa-arrow-left"></i></a>
            </div>
            <h1>EDIT GABUNGAN SUB VARIASI</h1>
        </div>
    </section>

    <div class="card">
        <div class="card-header">
            <h4>Edit Gabungan Sub Variasi</h4>
        </div>
        <div class="card-body col">
            <form action="{{ url('/admin/update-merge-varOption/' . $mergeVariationOption->id) }}" method="post">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="product_id">Produk</label>
                    <select name="product_id" id="product_id" class="form-control" required>
                        <option value="" disabled>Pilih Produk</option>
                        @foreach ($products as $product)
                            <option value="{{ $product->id }}"
                                {{ $mergeVariationOption->product_id == $product->id ? 'selected' : '' }}>
                                {{ $product->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="variation_option_1_id" id="label_varOp_1">Sub Variasi 1</label>
                    <select name="variation_option_1_id" id="variation_option_1_id" class="form-control" >
                    </select>
                </div>
                <div class="form-group">
                    <label for="variation_option_2_id" id="label_varOp_2">Sub Variasi 2</label>
                    <select name="variation_option_2_id" id="variation_option_2_id" class="form-control" >
                    </select>
                </div>

                <div class="form-group">
                    <label for="merge_stock">Stok</label>
                    <input type="number" name="merge_stock" class="form-control @error('merge_stock') is-invalid @enderror"
                        value="{{ old('merge_stock', $mergeVariationOption->merge_stock) }}" required>
                    @error('merge_stock')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </form>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#product_id').change(function() {
                const productId = $(this).val();

                $('#variation_option_1_id').empty();
                $('#variation_option_2_id').empty();

                if (productId) {
                    $.getJSON(`/admin/getVarOption/${productId}`, function(data) {
                        console.log(data);
                        if (data[0]) {
                            $('#label_varOp_1').html(data[0].name);
                            $.each(data[0].variation_option, function(key, option) {
                                const isSelected = '{{ $mergeVariationOption->variation_option_1_id }}' == option.id ? 'selected' : '';
                                $('#variation_option_1_id').append('<option value="' + option.id + '" ' + isSelected + '>' + option.name + '</option>');
                            });
                        }

                        if (data[1]) {
                            $('#label_varOp_2').html(data[1].name);
                            $.each(data[1].variation_option, function(key, option) {
                                const isSelected = '{{ $mergeVariationOption->variation_option_2_id }}' == option.id ? 'selected' : '';
                                $('#variation_option_2_id').append('<option value="' + option.id + '" ' + isSelected + '>' + option.name + '</option>');
                            });
                        }
                    }).fail(function(jqXHR, textStatus, errorThrown) {
                        console.error('AJAX call failed:', textStatus, errorThrown);
                    });
                }
            });

            // Trigger change event if there is a selected option
            if ($('#product_id').val()) {
                $('#product_id').trigger('change');
            }
        });
    </script>
@endsection
