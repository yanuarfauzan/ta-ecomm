@extends('ADMIN.partial.main')
@section('content')
    <section class="section text-center">
        <div class="section-header">
            <h1>CATEGORY</h1>
            <div class="section-header-button">
                <a href="/admin/create-category" class="btn btn-success">Add New</a>
            </div>
        </div>
    </section>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    @if (session('delete'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('delete') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <div class="card mx-auto">
        <div class="card-header text-center">
            <h4>List Category</h4>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered text-center">
                    <thead>
                        <tr>
                            <th scope="col">No.</th>
                            <th scope="col">Nama Kategori</th>
                            <th scope="col">Nama Kategori</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $no = 1;
                        @endphp
                        @foreach ($category as $cat)
                            <tr>
                                <td>{{ $no++ }}</td>
                                <td>{{ $cat->name }}</td>
                                <td>
                                    <img src="{{ asset($cat->icon) }}" alt="{{ $cat->name }}" style="max-height: 50px;">
                                </td>
                                <td>
                                    <div class="d-flex justify-content-center">
                                        <a href="/admin/edit-category/{{ $cat->id }}"
                                            class="btn btn-md bg-primary text-light btn-rounded mr-2">
                                            <i class="fa-solid fas fa-pen"></i>
                                        </a>
                                        <form action="/admin/delete-category/{{ $cat->id }}" method="POST">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" class="btn btn-md bg-danger text-light btn-rounded">
                                                <i class="fa-solid fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
