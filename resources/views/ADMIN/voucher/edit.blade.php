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
                <div class="form-group">
                    <label for="voucher_code">Kode Voucher</label>
                    <input type="text" class="form-control" id="voucher_code" name="voucher_code" value="{{ $voucher->voucher_code }}" required>
                </div>
                <div class="mb-3">
                    <label for="name" class="form-label">Nama Voucher</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ $voucher->name }}">
                </div>
                <div class="mb-3">
                    <label for="voucher_icon">Icon Voucher</label>
                    @if ($voucher->voucher_icon)
                        <div class="mb-2">
                            <img src="{{ asset($voucher->voucher_icon) }}" alt="Voucher Icon" style="max-width: 100px;">
                        </div>
                    @endif
                    <input type="file" class="form-control-file" id="voucher_icon" name="voucher_icon">
                </div>
                <div class="form-group">
                    <label for="desc">Deskripsi</label>
                    <input type="text" class="form-control" id="desc" name="desc" value="{{ $voucher->desc }}" required>
                </div>
                <div class="form-group">
                    <label for="requirement">Requirement</label>
                    <input type="text" class="form-control" id="requirement" name="requirement" value="{{ $voucher->requirement }}" required>
                </div>
                <div class="form-group">
                    <label for="discount_value">Jumlah Diskon (%)</label>
                    <input type="number" step="0.01" class="form-control" id="discount_value" name="discount_value" value="{{ $voucher->discount_value }}" required>
                </div>
                <div class="form-group">
                    <label for="expired_at">Tenggat Voucher</label>
                    <input type="date" class="form-control" id="expired_at" name="expired_at" value="{{ $voucher->expired_at }}" required>
                </div>
                <div class="form-group">
                    <label for="is_active">Status</label>
                    <input type="date" class="form-control" id="is_active" name="is_active" value="{{ $voucher->is_active }}" required>
                </div>
                <button type="submit" class="btn btn-primary">Update</button>
            </form>
        </div>
    </div>
@endsection
