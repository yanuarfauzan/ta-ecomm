@extends('ADMIN.partial.main')
@section('content')
    <section class="section text-center">
        <div class="section-header">
            <h1>SUB VARIASI</h1>
            <div class="section-header-button">
                <a href="/admin/create-variation-option" class="btn btn-success">Tambah</a>
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
            <h4>Daftar Sub Variasi</h4>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered text-center">
                    <thead>
                        <tr>
                            <th scope="col">No.</th>
                            <th scope="col">Nama Variasi Opsi</th>
                            <th scope="col">Nama Variasi</th>
                            <th scope="col">Nama Produk</th>
                            <th scope="col">Detail</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $no = 1;
                        @endphp
                        @foreach ($variationOptions as $varOp)
                            <tr>
                                <td>{{ $no++ }}</td>
                                <td>{{ $varOp->name }}</td>
                                <td>{{ optional($varOp->variation)->name }}</td>
                                <td>
                                    @if ($varOp->productImage && $varOp->productImage->product)
                                        {{ $varOp->productImage->product->name }}
                                    @endif
                                </td>
                                <td>
                                    <button type="button" class="btn btn-info btn-rounded product-detail-btn"
                                        data-toggle="modal" data-target="#productDetailModal{{ $varOp->id }}">
                                        Detail
                                    </button>
                                </td>
                                <td>
                                    <div class="d-flex justify-content-center">
                                        <a href="/admin/edit-variation-option/{{ $varOp->id }}"
                                            class="btn btn-md bg-primary text-light btn-rounded mr-2">
                                            <i class="fa-solid fas fa-pen"></i>
                                        </a>
                                        <form action="/admin/delete-variation-option/{{ $varOp->id }}" method="POST">
                                            @csrf
                                            @method('DELETE')
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
                        @if ($variationOptions->onFirstPage())
                            <li class="page-item disabled">
                                <span class="page-link"><i class="fas fa-chevron-left"></i></span>
                            </li>
                        @else
                            <li class="page-item">
                                <a class="page-link" href="{{ $variationOptions->previousPageUrl() }}"><i
                                        class="fas fa-chevron-left"></i></a>
                            </li>
                        @endif

                        @for ($i = 1; $i <= $variationOptions->lastPage(); $i++)
                            <li class="page-item {{ $i == $variationOptions->currentPage() ? 'active' : '' }}">
                                <a class="page-link" href="{{ $variationOptions->url($i) }}">{{ $i }}</a>
                            </li>
                        @endfor

                        @if ($variationOptions->hasMorePages())
                            <li class="page-item">
                                <a class="page-link" href="{{ $variationOptions->nextPageUrl() }}"><i
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

    @foreach ($variationOptions as $varOp)
        <div class="modal fade" id="productDetailModal{{ $varOp->id }}" tabindex="-1" role="dialog"
            aria-labelledby="productDetailModalLabel{{ $varOp->id }}" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title text-primary" id="productDetailModalLabel{{ $varOp->id }}">
                            {{ $varOp->name }}</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                @if ($varOp->productImage)
                                    <img id="modalProductImage" src="{{ Storage::url($varOp->productImage->filepath_image) }}"
                                        alt="{{ $varOp->name }}" class="img-fluid">
                                @else
                                    <p>Gambar tidak tersedia</p>
                                @endif
                            </div>
                            <div class="col-md-6">
                                <p><strong>Nama Variasi Opsi:</strong> {{ $varOp->name }}</p>
                                <p><strong>Harga:</strong> Rp {{ number_format($varOp->price, 0, ',', '.') }}</p>
                                <p><strong>Berat:</strong> {{ $varOp->weight }}</p>
                                <p><strong>Dimensi:</strong> {{ $varOp->dimensions }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

    {{-- <style>
        .main-image img {
            width: 100%;
            height: auto;
            object-fit: contain;
        }

        .thumbnail-images {
            display: flex;
            gap: 10px;
            overflow-x: auto;
        }

        .thumbnail-images img {
            cursor: pointer;
            width: 80px;
            height: 80px;
            object-fit: cover;
        }

        .modal-body .row {
            display: flex;
        }

        .modal-body .row .col-md-6 {
            flex: 0 0 50%;
        }

        .original-price {
            text-decoration: line-through;
            margin-right: 3px;
            color: red;
        }
    </style>  --}}
@endsection
