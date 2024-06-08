@extends('ADMIN.partial.main')
@section('content')
    <section class="section">
        <div class="section-header">
            <div class="section-header-back">
                <a href="{{ url('/admin/list-merge-varOption') }}"><i class="fas fa-arrow-left"></i></a>
            </div>
            <h1>EDIT MERGE VARIATION OPTION</h1>
        </div>
    </section>

    <div class="card">
        <div class="card-header">
            <h4>Edit Merge Variation Option</h4>
        </div>
        <div class="card-body col">
            <form action="{{ url('/admin/update-merge-varOption/' . $mergeVariationOption->id) }}" method="post">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="product_id">Product</label>
                    <select name="product_id" id="product_id" class="form-control" required>
                        <option value="" disabled>Select Product</option>
                        @foreach ($products as $product)
                            <option value="{{ $product->id }}"
                                {{ $mergeVariationOption->product_id == $product->id ? 'selected' : '' }}>
                                {{ $product->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="variation_option_1_id">Variation Option 1</label>
                    <select name="variation_option_1_id" id="variation_option_1_id" class="form-control" required>
                        @foreach ($variationOptions1 as $option)
                            <option value="{{ $option->id }}" @if ($mergeVariationOption->variation_option_1_id == $option->id) selected @endif>
                                {{ $option->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="variation_option_2_id">Variation Option 2</label>
                    <select name="variation_option_2_id" id="variation_option_2_id" class="form-control" required>
                        @foreach ($variationOptions2 as $option)
                            <option value="{{ $option->id }}" @if ($mergeVariationOption->variation_option_2_id == $option->id) selected @endif>
                                {{ $option->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="merge_stock">Merge Stock</label>
                    <input type="number" name="merge_stock" class="form-control @error('merge_stock') is-invalid @enderror"
                        value="{{ old('merge_stock', $mergeVariationOption->merge_stock) }}" required>
                    @error('merge_stock')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary">Update</button>
            </form>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#product_id').change(function() {
                const productId = $(this).val();
                getVariationOptions(productId);
            });

            const initialProductId = "{{ $mergeVariationOption->product_id }}";
            if (initialProductId) {
                getVariationOptions(initialProductId);
            }

            function getVariationOptions(productId) {
                $('#variation_option_1_id').empty();
                $('#variation_option_2_id').empty();

                if (productId) {
                    $.getJSON(`/admin/getVarOption/${productId}`, function(data) {
                        $.each(data, function(key, option) {
                            $('#variation_option_1_id').append('<option value="' + key + '">' +
                                option + '</option>');
                            $('#variation_option_2_id').append('<option value="' + key + '">' +
                                option + '</option>');
                        });

                        const variationOption1 = "{{ $mergeVariationOption->variation_option_1_id }}";
                        const variationOption2 = "{{ $mergeVariationOption->variation_option_2_id }}";
                        $('#variation_option_1_id').val(variationOption1);
                        $('#variation_option_2_id').val(variationOption2);
                    });
                }
            }
        });
    </script>
@endsection
