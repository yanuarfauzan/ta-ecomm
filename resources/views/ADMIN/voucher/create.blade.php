@extends('ADMIN.partial.main')
@section('content')
    <section class="section">
        <div class="section-header">
            <div class="section-header-back">
                <a href="{{ url('/admin/list-voucher') }}"><i class="fas fa-arrow-left"></i></a>
            </div>
            <h1>KUPON</h1>
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
            <h4>ISI DATA KUPON</h4>
        </div>
        <div class="card-body col">
            <form action="{{ url('/admin/store-voucher') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">Nama kupon</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                        name="name" value="{{ old('name') }}">
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="type" class="form-label">Tipe kupon</label>
                    <select class="form-control @error('type') is-invalid @enderror" id="type" name="type" required>
                        <option>Pilih Tipe</option>
                        <option value="free ongkir" {{ old('type') == 'free ongkir' ? 'selected' : '' }}>Free Ongkir</option>
                        <option value="discount" {{ old('type') == 'discount' ? 'selected' : '' }}>Diskon</option>
                    </select>
                    @error('type')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="voucher_icon" class="form-label">Gambar kupon</label>
                    <input type="file" class="form-control-file @error('voucher_icon') is-invalid @enderror"
                        id="voucher_icon" name="voucher_icon">
                    @error('voucher_icon')
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
                    <label for="discount_value" class="form-label">Jumlah Diskon</label>
                    <input type="number" class="form-control @error('discount_value') is-invalid @enderror"
                        id="discount_value" name="discount_value" value="{{ old('discount_value') }}">
                    @error('discount_value')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="min_value" class="form-label">Nilai Minimal</label>
                    <input type="number" class="form-control @error('min_value') is-invalid @enderror"
                        id="min_value" name="min_value" value="{{ old('min_value') }}">
                    @error('min_value')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="expired_at" class="form-label">Tenggat kupon</label>
                    <input type="date" class="form-control @error('expired_at') is-invalid @enderror" id="expired_at"
                        name="expired_at" value="{{ old('expired_at') }}">
                    @error('expired_at')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <input type="hidden" name="is_active" value="1">
                <button type="submit" class="btn btn-primary">Simpan</button>
            </form>
        </div>
    </div>
@endsection
