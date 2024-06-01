@extends('ADMIN.partial.main')
@section('content')
    <section class="section text-center">
        <div class="section-header">
            <h1>VOUCHER</h1>
            <div class="section-header-button">
                <a href="/admin/create-voucher" class="btn btn-success">Add New</a>
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
            <h4>List Voucher</h4>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered text-center">
                    <thead>
                        <tr>
                            <th scope="col">No.</th>
                            <th scope="col">Kode Voucher</th>
                            <th scope="col">Nama Voucher</th>
                            <th scope="col">Deskripsi</th>
                            <th scope="col">Requirement</th>
                            <th scope="col">Diskon</th>
                            <th scope="col">Tenggat Voucher</th>
                            <th scope="col">Status</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $no = 1;
                        @endphp
                        @foreach ($voucher as $v)
                            <tr>
                                <td>{{ $no++ }}</td>
                                <td>{{ $v->voucher_code }}</td>
                                <td>{{ $v->name }}</td>
                                <td>{{ $v->desc }}</td>
                                <td>{{ $v->requirement }}</td>
                                <td>{{ $v->discount_value }}</td>
                                <td>{{ $v->expired_at }}</td>
                                <td class="{{ $v->is_active ? 'text-success' : 'text-danger' }}">
                                    {{ $v->is_active ? 'Aktif' : 'Expired' }}
                                </td>
                                <td>
                                    <div class="d-flex justify-content-center">
                                        <a href="/admin/edit-voucher/{{ $v->id }}"
                                            class="btn btn-md bg-primary text-light btn-rounded mr-2">
                                            <i class="fa-solid fas fa-pen"></i>
                                        </a>
                                        <form action="/admin/delete-voucher/{{ $v->id }}" method="POST">
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
