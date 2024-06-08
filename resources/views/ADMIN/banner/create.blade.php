@extends('ADMIN.partial.main')
@section('content')
    <section class="section">
        <div class="section-header">
            <div class="section-header-back">
                <a href="{{ url('/admin/list-banner') }}"><i class="fas fa-arrow-left"></i></a>
            </div>
            <h1>BANNER HOME</h1>
        </div>

        <div class="section-body">
        </div>
    </section>
    <div class="card">
        <div class="card-header">
            <h4>INPUT BANNER HOME</h4>
        </div>
        <div class="card-body col">
            <form action="{{ url('/admin/store-banner') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="banner_image">Banner Image</label>
                    <input type="file" class="form-control-file @error('banner_image') is-invalid @enderror"
                        id="banner_image" name="banner_image" value="{{ old('banner_image') }}">
                    @error('banner_image')
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
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
@endsection
