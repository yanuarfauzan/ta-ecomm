@extends('ADMIN.partial.main')
@section('content')
    <section class="section">
        <div class="section-header">
            <div class="section-header-back">
                <a href="{{ url('/admin/list-voucher') }}"><i class="fas fa-arrow-left"></i></a>
            </div>
            <h1>EDIT VOUCHER</h1>
        </div>
    </section>

    <div class="card">
        <div class="card-header">
            <h4>Edit Voucher</h4>
        </div>
        <div class="card-body col">
            <form action="{{ url('/admin/update-voucher/' . $voucher->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="name" class="form-label">Nama Voucher</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                        name="name" value="{{ old('name', $voucher->name) }}">
                    @error('name')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="type">Tipe Voucher</label>
                    <select class="form-control" id="type" name="type" required>
                        <option value="free ongkir" {{ $voucher->type === 'free ongkir' ? 'selected' : '' }}>Free Ongkir
                        </option>
                        <option value="discount" {{ $voucher->type === 'discount' ? 'selected' : '' }}>Diskon</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="voucher_icon">Icon Voucher</label>
                    @if ($voucher->voucher_icon)
                        <div class="mb-2">
                            <img src="{{ Storage::url($voucher->voucher_icon) }}" alt="Voucher Icon"
                                style="max-width: 100px;">
                        </div>
                    @endif
                    <input type="file" class="form-control-file @error('voucher_icon') is-invalid @enderror""
                        id="voucher_icon" name="voucher_icon">
                    @error('voucher_icon')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="desc">Deskripsi</label>
                    <input type="text" class="form-control @error('desc') is-invalid @enderror" id="desc"
                        name="desc" value="{{ old('desc', $voucher->desc) }}">
                    @error('desc')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="discount_value">Jumlah Diskon</label>
                    <input type="number" class="form-control @error('discount_value') is-invalid @enderror"
                        id="discount_value" name="discount_value" value="{{ old('discount_value', $voucher->discount_value) }}" required>
                    @error('discount_value')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="expired_at">Tenggat Voucher</label>
                    <input type="date" class="form-control" id="expired_at @error('expired_at') is-invalid @enderror"
                        name="expired_at" value="{{ old('expired_at', $voucher->expired_at) }}" required>
                    @error('expired_at')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="min_value">Nilai Minimal</label>
                    <input type="text" class="form-control" id="min_value @error('min_value') is-invalid @enderror"
                        name="min_value" value="{{ old('min_value', $voucher->min_value) }}" required>
                    @error('min_value')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary">Update</button>
            </form>
        </div>
    </div>
@endsection
