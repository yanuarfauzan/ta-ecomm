@extends('ADMIN.partial.main')
@section('content')
    <section class="section">
        <div class="section-header">
            <div class="section-header-back">
                <a href="{{ url('/admin/list-merge-varOption') }}"><i class="fas fa-arrow-left"></i></a>
            </div>
            <h1>MERGE VARIATION OPTION</h1>
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
            <h4>INPUT MERGE VARIATION OPTION</h4>
        </div>
        <div class="card-body col">
            <form action="{{ url('/admin/store-merge-varOption') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="product_id">Pilih produk</label>
                    <select name="product_id" id="product_id" class="form-control" >
                        <option value="" selected disabled>Pilih Produk</option>
                        @foreach ($products as $product)
                            <option value="{{ $product->id }}">{{ $product->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="variation_option_1_id" id="label_varOp_1">Variasi Opsi 1</label>
                    <select name="variation_option_1_id" id="variation_option_1_id" class="form-control" >
                    </select>
                </div>
                <div class="form-group">
                    <label for="variation_option_2_id" id="label_varOp_2">Variasi Opsi 2</label>
                    <select name="variation_option_2_id" id="variation_option_2_id" class="form-control" >
                    </select>
                </div>
                <div class="form-group">
                    <label for="merge_stock">Stok</label>
                    <input type="number" name="merge_stock" class="form-control @error('merge_stock') is-invalid @enderror"
                        value="{{ old('merge_stock') }}">
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
                                $('#variation_option_1_id').append('<option value="' +
                                    option.id + '">' + option.name + '</option>');
                            });
                        }

                        if (data[1]) {
                            $('#label_varOp_2').html(data[1].name);
                            $.each(data[1].variation_option, function(key, option) {
                                $('#variation_option_2_id').append('<option value="' +
                                    option.id + '">' + option.name + '</option>');
                            });
                        }
                    }).fail(function(jqXHR, textStatus, errorThrown) {
                        console.error('AJAX call failed:', textStatus, errorThrown);
                    });
                }
            });
        });
    </script>
@endsection
