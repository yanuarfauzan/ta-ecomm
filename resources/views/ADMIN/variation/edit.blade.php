@extends('ADMIN.partial.main')
@section('content')
    <section class="section">
        <div class="section-header">
            <div class="section-header-back">
                <a href="{{ url('/admin/list-variation') }}"><i class="fas fa-arrow-left"></i></a>
            </div>
            <h1>EDIT VARIATION</h1>
        </div>
    </section>

    <div class="card">
        <div class="card-header">
            <h4>Edit Variation</h4>
        </div>
        <div class="card-body col">
            <form action="{{ url('/admin/update-variation/' . $variations->id) }}" method="post"
                enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="name" class="form-label">Nama Variasi</label>
                    <input type="text" class="form-control @error('address') is-invalid @enderror" id="name"
                        name="name" value="{{ $variations->name }}">
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary">Update</button>
            </form>
        </div>
    </div>
@endsection
