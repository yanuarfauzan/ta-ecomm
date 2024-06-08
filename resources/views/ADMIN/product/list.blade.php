@extends('ADMIN.partial.main')
@section('content')
    <section class="section text-center">
        <div class="section-header">
            <h1>PRODUCT</h1>
            <div class="section-header-button">
                <a href="/admin/create-product" class="btn btn-success">Add New</a>
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
            <h4>List Product</h4>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered text-center">
                    <thead>
                        <tr>
                            <th scope="col">No.</th>
                            <th scope="col">Kode Produk</th>
                            <th scope="col">Nama Produk</th>
                            <th scope="col">Detail</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $no = 1;
                        @endphp
                        @foreach ($product as $produk)
                            <tr>
                                <td>{{ $no++ }}</td>
                                <td>{{ $produk->SKU }}</td>
                                <td>{{ $produk->name }}</td>
                                <td>
                                    <button type="button" class="btn btn-info btn-rounded product-detail-btn"
                                        data-toggle="modal" data-target="#productDetailModal{{ $produk->id }}"
                                        data-name="{{ $produk->name }}" data-SKU="{{ $produk->SKU }}"
                                        data-stock="{{ $produk->stock }}" data-price="{{ $produk->price }}"
                                        data-desc="{{ $produk->desc }}" data-discount="{{ $produk->discount }}"
                                        data-weight="{{ $produk->weight }}" data-dimensions="{{ $produk->dimensions }}">
                                        Details
                                    </button>
                                </td>
                                <td>
                                    <div class="d-flex justify-content-center">
                                        <a href="/admin/edit-product/{{ $produk->id }}"
                                            class="btn btn-md bg-primary text-light btn-rounded mr-2">
                                            <i class="fa-solid fas fa-pen"></i>
                                        </a>
                                        <form action="/admin/delete-product/{{ $produk->id }}" method="POST">
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
    @foreach ($product as $produk)
        <div class="modal fade" id="productDetailModal{{ $produk->id }}" tabindex="-1" role="dialog"
            aria-labelledby="productDetailModalLabel{{ $produk->id }}" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title text-primary" id="productDetailModalLabel{{ $produk->id }}">{{ $produk->name }}</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="main-image">
                                    @if ($produk->hasImages && $produk->hasImages->isNotEmpty())
                                        <img id="mainProductImage{{ $produk->id }}"
                                            src="{{ Storage::url($produk->hasImages->first()->filepath_image) }}"
                                            alt="{{ $produk->name }}" class="img-fluid">
                                    @else
                                        <img id="mainProductImage{{ $produk->id }}"
                                            src="{{ asset('default-image.jpg') }}" alt="Default Image" class="img-fluid">
                                    @endif
                                </div>
                                <div class="thumbnail-images mt-3">
                                    @if ($produk->hasImages && $produk->hasImages->isNotEmpty())
                                        @foreach ($produk->hasImages as $image)
                                            <img src="{{ Storage::url($image->filepath_image) }}" alt="{{ $produk->name }}"
                                                class="img-thumbnail img-fluid small-image"
                                                onclick="document.getElementById('mainProductImage{{ $produk->id }}').src='{{ Storage::url($image->filepath_image) }}'">
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6">
                                <p><strong>Kode Produk:</strong> {{ $produk->SKU }}</p>
                                <p><strong>Harga:</strong> Rp {{ number_format($produk->price, 0, ',', '.') }}</p>
                                <p><strong>Diskon:</strong> {{ $produk->discount }}%</p>
                                <p><strong>Deskripsi:</strong> {{ $produk->desc }}</p>
                                <p><strong>Stock:</strong> {{ $produk->stock }}</p>
                                <p><strong>Berat:</strong> {{ $produk->weight }} Kg</p>
                                <p><strong>Dimensi:</strong> {{ $produk->dimensions }} cm</p>
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

    <style>
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

        /* .discount-price {
                color: green;
            } */
    </style>
@endsection
