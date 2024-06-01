@extends('ADMIN.partial.main')
@section('content')
    <section class="section">
        <div class="section-header">
            <div class="section-header-back">
                <a href="{{ url('/admin/list-voucher') }}"><i class="fas fa-arrow-left"></i></a>
            </div>
            <h1>VOUCHER</h1>
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
            <h4>INPUT VOUCHER</h4>
        </div>
        <div class="card-body col">
            <form action="{{ url('/admin/store-voucher') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="voucher_code" class="form-label">Kode voucher</label>
                    <input type="text" class="form-control @error('voucher_code') is-invalid @enderror" id="voucher_code"
                        name="voucher_code" required>
                    @error('voucher_code')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="name" class="form-label">Nama voucher</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                        name="name" required>
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="voucher_icon" class="form-label">Voucher Icon</label>
                    <input type="file" class="form-control @error('voucher_icon') is-invalid @enderror" id="voucher_icon"
                        name="voucher_icon">
                    @error('voucher_icon')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="desc" class="form-label">Deskripsi</label>
                    <input type="text" class="form-control @error('desc') is-invalid @enderror" id="desc"
                        name="desc">
                    @error('desc')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="requirement" class="form-label">Requirement</label>
                    <input type="text" class="form-control @error('requirement') is-invalid @enderror" id="requirement"
                        name="requirement">
                    @error('requirement')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="discount_value" class="form-label">Jumlah Diskon (%)</label>
                    <input type="number" class="form-control @error('discount_value') is-invalid @enderror"
                        id="discount_value" name="discount_value" required>
                    @error('discount_value')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="expired_at" class="form-label">Tenggat Voucher</label>
                    <input type="date" class="form-control @error('expired_at') is-invalid @enderror" id="expired_at"
                        name="expired_at" required>
                    @error('expired_at')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="is_active" class="form-label">Status</label>
                    <select class="form-control @error('is_active') is-invalid @enderror" id="is_active" name="is_active"
                        required>
                        <option value="1">Aktif</option>
                        <option value="0">Expired</option>
                    </select>
                    @error('is_active')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const typeSelect = document.getElementById('type');
            const discountValueDiv = document.getElementById('discount_value_div');

            typeSelect.addEventListener('change', function() {
                if (typeSelect.value === 'discount') {
                    discountValueDiv.style.display = 'block';
                } else {
                    discountValueDiv.style.display = 'none';
                }
            });

            // Initial check
            if (typeSelect.value !== 'discount') {
                discountValueDiv.style.display = 'none';
            }
        });
    </script>
@endsection
