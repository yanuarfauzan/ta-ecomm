@extends('ADMIN.partial.main')
@section('content')
    <section class="section">
        <div class="section-header">
            <div class="section-header-back">
                <a href="{{ url('/admin/list-banner') }}"><i class="fas fa-arrow-left"></i></a>
            </div>
            <h1>EDIT BANNER HOME</h1>
        </div>
    </section>

    <div class="card">
        <div class="card-header">
            <h4>Edit Banner Home</h4>
        </div>
        <div class="card-body col">
            <form action="{{ url('/admin/update-banner/' . $bannerHome->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="banner_home">Banner Image</label>
                    @if ($bannerHome->banner_image)
                        <div class="mb-2">
                            <img src="{{ Storage::url($bannerHome->banner_image) }}" alt="Banner Home"
                                style="max-width: 100px;">
                        </div>
                    @endif
                    <input type="file" class="form-control-file @error('banner_image') is-invalid @enderror"
                        id="banner_image" name="banner_image">
                    @error('banner_image')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="desc" class="form-label">Deskripsi</label>
                    <input type="text" class="form-control @error('desc') is-invalid @enderror" id="desc"
                        name="desc" value="{{ $bannerHome->desc }}">
                    @error('desc')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary">Update</button>
            </form>
        </div>
    </div>
@endsection
