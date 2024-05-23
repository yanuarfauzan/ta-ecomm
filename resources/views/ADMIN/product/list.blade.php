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
                        <h5 class="modal-title" id="productDetailModalLabel{{ $produk->id }}">{{ $produk->name }}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <img id="modalProductImage" src="{{ asset($produk->product_image) }}"
                                    alt="{{ $produk->name }}" class="img-fluid">
                            </div>
                            <div class="col-md-6">
                                <h4 id="modalProductName"></h4>
                                {{-- <p><strong>Nama Produk:</strong> <span id="modalProductName">{{ $produk->name }}</span></p> --}}
                                <p><strong>Kode Produk:</strong> <span id="modalProductSKU"></span>{{ $produk->SKU }}</p>
                                <p><strong>Stock:</strong> <span id="modalProductStock"></span>{{ $produk->stock }}</p>
                                <p><strong>Price:</strong> Rp <span id="modalProductPrice"></span>{{ $produk->price }}</p>
                                <p><strong>Description:</strong> <span id="modalProductDesc"></span>{{ $produk->desc }}</p>
                                <p><strong>Discount:</strong> <span id="modalProductDiscount"></span>{{ $produk->discount }}%</p>
                                <p><strong>Weight:</strong> <span id="modalProductWeight"></span>{{ $produk->weight }} Kg</p>
                                <p><strong>Dimensions:</strong> <span id="modalProductDimensions"></span>{{ $produk->dimensions }} cm</p>
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
@endsection
