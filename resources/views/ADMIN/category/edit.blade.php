@extends('ADMIN.partial.main')
@section('content')
    <section class="section">
        <div class="section-header">
            <div class="section-header-back">
                <a href="{{ url('/admin/list-category') }}"><i class="fas fa-arrow-left"></i></a>
            </div>
            <h1>EDIT CATEGORY</h1>
        </div>
    </section>

    <div class="card">
        <div class="card-header">
            <h4>Edit Category</h4>
        </div>
        <div class="card-body col">
            <form action="{{ url('/admin/update-category/' . $category->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="name" class="form-label">Nama Kategori</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $category->name) }}">
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="icon">Icon</label>
                    @if ($category->icon)
                        <div class="mb-2">
                            <img src="{{ Storage::url($category->icon) }}" alt="Category Icon" style="max-width: 100px;">
                        </div>
                    @endif
                    <input type="file" class="form-control-file @error('icon') is-invalid @enderror" id="icon"
                        name="icon" value="{{old('icon')}}">
                    @error('icon')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary">Update</button>
            </form>
        </div>
    </div>
@endsection
