@extends('ADMIN.partial.main')
@section('content')
    <section class="section text-center">
        <div class="section-header">
            <h1>KUPON</h1>
            <div class="section-header-button">
                <a href="/admin/create-voucher" class="btn btn-success">Tambah</a>
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
    @if (session('alert'))
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            {{ session('alert') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <div class="card mx-auto">
        <div class="card-header text-center">
            <h4>Daftar Kupon</h4>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered text-center">
                    <thead>
                        <tr>
                            <th scope="col">No.</th>
                            <th scope="col">Ikon</th>
                            <th scope="col">Kode Kupon</th>
                            <th scope="col">Tipe Kupon</th>
                            <th scope="col">Nama Kupon</th>
                            <th scope="col">Detail</th>
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
                                <td class="bg-secondary">
                                    @if ($v->voucher_icon)
                                        <img src="{{ Storage::url('public/voucher-icon/' . $v->voucher_icon) }}" alt="{{ $v->name }}"
                                            style="max-height: 100px;">
                                    @else
                                        Tidak ada foto
                                    @endif
                                </td>
                                <td>{{ $v->voucher_code }}</td>
                                <td>{{ $v->type }}</td>
                                <td>{{ $v->name }}</td>
                                <td>
                                    <button type="button" class="btn btn-info" data-toggle="modal"
                                        data-target="#addressModal{{ $v->id }}">
                                        Detail
                                    </button>
                                </td>
                                <td class="{{ $v->is_active ? 'text-success' : 'text-danger' }}">
                                    {{ $v->is_active ? 'Aktif' : 'Expired' }}
                                </td>
                                <td>
                                    <div class="d-flex justify-content-center">
                                        <form id="update-form-{{ $v->id }}"
                                            action="/admin/update-status-voucher/{{ $v->id }}" method="POST">
                                            @csrf
                                            <button type="submit" class="btn btn-md bg-warning text-light btn-rounded">
                                                <i class="fa-solid fas fa-times"></i>
                                            </button>
                                        </form>

                                        <a href="/admin/edit-voucher/{{ $v->id }}"
                                            class="btn btn-md bg-primary text-light btn-rounded mr-2 ml-2">
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
            <div class="card-footer text-right">
                <nav class="d-inline-block">
                    <ul class="pagination mb-0">
                        @if ($voucher->onFirstPage())
                            <li class="page-item disabled">
                                <span class="page-link"><i class="fas fa-chevron-left"></i></span>
                            </li>
                        @else
                            <li class="page-item">
                                <a class="page-link" href="{{ $voucher->previousPageUrl() }}"><i
                                        class="fas fa-chevron-left"></i></a>
                            </li>
                        @endif

                        @for ($i = 1; $i <= $voucher->lastPage(); $i++)
                            <li class="page-item {{ $i == $voucher->currentPage() ? 'active' : '' }}">
                                <a class="page-link" href="{{ $voucher->url($i) }}">{{ $i }}</a>
                            </li>
                        @endfor

                        @if ($voucher->hasMorePages())
                            <li class="page-item">
                                <a class="page-link" href="{{ $voucher->nextPageUrl() }}"><i
                                        class="fas fa-chevron-right"></i></a>
                            </li>
                        @else
                            <li class="page-item disabled">
                                <span class="page-link"><i class="fas fa-chevron-right"></i></span>
                            </li>
                        @endif
                    </ul>
                </nav>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $('form[id^="update-form-"]').submit(function(event) {
                event.preventDefault(); 

                var form = $(event.currentTarget); 
                var button = form.find('button[type="submit"]'); 

                console.log('Formulir:', form);

                $.ajax({
                    url: form.attr('action'),
                    type: 'POST',
                    data: form.serialize(),
                    success: function(response) {
                        button.prop('disabled', true); 
                        button.removeClass('bg-warning').addClass(
                        'bg-secondary'); 
                        console.log('Permintaan sukses:',
                        response); 
                    },
                    error: function(xhr) {
                        console.log(xhr.responseText); 
                    }
                });
            });
        });
    </script>

    @foreach ($voucher as $v)
        <div class="modal fade" id="addressModal{{ $v->id }}" tabindex="-1" role="dialog"
            aria-labelledby="addressModal{{ $v->id }}Label" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header text-center mx-auto justify-content-between">
                        <h5 class="modal-title" id="addressModal{{ $v->id }}Label">Detail Voucher</h5>
                    </div>
                    <div class="modal-body">
                        <p><strong>Jumlah Diskon:</strong> {{ $v->discount_value }}</p>
                        <p><strong>Nilai Minimal:</strong> Rp {{ number_format($v->min_value, 0, ',', '.') }}</p>
                        <p><strong>Deskripsi:</strong> {{ $v->desc }}</p>
                        <p><strong>Tenggat Voucher:</strong> {{ $v->expired_at }}</p>
                        <hr>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endsection
