@extends('partial.user.main')
@section('container')
    <div class="d-flex flex-column gap-3 align-items-center">
        <div id="carouselExampleIndicators" class="carousel slide shadow-sm" style="width: 84%">
            <div class="carousel-inner">
                @foreach ($banners as $banner)
                <div class="carousel-item active">
                    <img src="{{ Storage::url($banner->banner_image) }}"
                        class="d-block w-100" style="height: 300px; object-fit: cover;" alt="...">
                </div>
                @endforeach
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators"
                data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators"
                data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
        <div class="container">
            <div class="row row-cols-4 ms-0">
                @foreach ($products as $index => $product)
                    <a href="{{ route('user-detail-product', ['productId' => $product->id]) }}"
                        style="text-decoration: none">
                        <div class="col mt-4">
                            <div class="card border-0 position-relative shadow-sm rounded-0" id="card-product"
                                style="width: 18rem; height: auto; cursor: pointer;">
                                <div style="overflow: hidden;">
                                    <img src="{{ Storage::url($product->hasImages->first()->filepath_image) }}"
                                        class="card-img-top rounded-0" alt="..." id="image-product">
                                </div>
                                @if ($product->stock == 0)
                                    <div class="rounded-circle bg-secondary text-white position-absolute d-flex align-items-center justify-content-center opacity-25"
                                        style="top: 40px; left: 45px; width:200px; height:200px; ">
                                        <div class="d-flex flex-column align-items-center gap-2">
                                            <img src="{{ asset('/icons-png/out-of-stock.png') }}" class=""
                                                style="width: 70px;" alt="">
                                            <span>
                                                <h4>Out Of Stock</h4>
                                            </span>
                                        </div>
                                    </div>
                                @endif
                                @if (isset($product->discount))
                                    <span class="text-dark bg-light position-absolute border border-secondary text-center"
                                        style="top: 262px; width: 70px;">Discount</span>
                                    <span
                                        class="text-dark bg-main-color position-absolute border border-secondary text-center"
                                        style="top: 262px; left: 70px; width: 40px;"><i
                                            class="text-white">{{ floor($product->discount) }}%</i></span>
                                @endif
                                <div class="card-body pb-2">
                                    <div class="d-flex justify-content-between">
                                        <strong>{{ $product->name }}</strong>
                                        <p>Stock {{ $product->stock }}</p>
                                    </div>
                                    @if (isset($product->discount))
                                        <div class="d-flex gap-2">
                                            <h5><strong>Rp
                                                    {{ number_format($product->price - $product->price * ($product->discount / 100), 2, ',', '.') }}</strong>
                                            </h5>
                                            <p class="text-decoration-line-through">
                                                <i>Rp {{ number_format($product->price, 2, ',', '.') }}</i>
                                            </p>
                                        </div>
                                    @else
                                        <div class="d-flex gap-2 mb-2">
                                            <h5><strong>Rp
                                                    {{ number_format($product->price, 2, ',', '.') }}</strong>
                                            </h5>
                                        </div>
                                    @endif
                                    <div class="d-flex align-items-center gap-2">
                                        <span>
                                            <i class="bi bi-star-fill" style="color: #ffd900"></i>
                                        </span>
                                        <span>
                                            {{ $product->rate }}
                                        </span>
                                        <div class="low-divider-black"></div>
                                        <span>
                                            {{-- TODO (menampilkan total jualproduk), produk relasi order --}}
                                            10 Terjual
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>

        <div class="container" id="more-product-container" style="display: none;">
            <div class="row row-cols-4 ms-0" id="more-product">
            </div>
        </div>
        <div class="container" id="loader-product" style="display: none;">
            <div class="row row-cols-4 ms-0">
                <div class="col mt-4">
                    <div class="card border-0 position-relative shadow"
                        style="width: 18rem; height: auto; cursor: pointer;">
                        <img src="https://dummyimage.com/600x550/E0E0E0/E0E0E0.png" class="card-img-top" alt="...">
                        <div class="card-body pb-2">
                            <div class="d-flex justify-content-between">
                                <div class="rounded" style="width: 150px; background-color: #E0E0E0; height: 20px"></div>
                                <div class="rounded" style="width: 50px; background-color: #E0E0E0; height: 20px"></div>
                            </div>
                            <div class="d-flex gap-2 mt-2">
                                <div class="me-2 rounded" style="width: 120px; background-color: #E0E0E0; height: 30px">
                                </div>
                                <div class="rounded" style="width: 50px; background-color: #E0E0E0; height: 30px"></div>

                            </div>
                            <div class="d-flex align-items-center gap-2 mt-2">
                                <div class="rounded" style="width: 50px; background-color: #E0E0E0; height: 20px"></div>

                                <div class="rounded" style="width: 70px; background-color: #E0E0E0; height: 20px"></div>

                                <div class="rounded" style="width: 100px; background-color: #E0E0E0; height: 20px"></div>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="col mt-4">
                    <div class="card border-0 position-relative shadow"
                        style="width: 18rem; height: auto; cursor: pointer;">
                        <img src="https://dummyimage.com/600x550/E0E0E0/E0E0E0.png" class="card-img-top" alt="...">
                        <div class="card-body pb-2">
                            <div class="d-flex justify-content-between">
                                <div class="rounded" style="width: 150px; background-color: #E0E0E0; height: 20px"></div>
                                <div class="rounded" style="width: 50px; background-color: #E0E0E0; height: 20px"></div>
                            </div>
                            <div class="d-flex gap-2 mt-2">
                                <div class="me-2 rounded" style="width: 120px; background-color: #E0E0E0; height: 30px">
                                </div>
                                <div class="rounded" style="width: 50px; background-color: #E0E0E0; height: 30px"></div>

                            </div>
                            <div class="d-flex align-items-center gap-2 mt-2">
                                <div class="rounded" style="width: 50px; background-color: #E0E0E0; height: 20px"></div>

                                <div class="rounded" style="width: 70px; background-color: #E0E0E0; height: 20px"></div>

                                <div class="rounded" style="width: 100px; background-color: #E0E0E0; height: 20px"></div>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="col mt-4">
                    <div class="card border-0 position-relative shadow"
                        style="width: 18rem; height: auto; cursor: pointer;">
                        <img src="https://dummyimage.com/600x550/E0E0E0/E0E0E0.png" class="card-img-top" alt="...">
                        <div class="card-body pb-2">
                            <div class="d-flex justify-content-between">
                                <div class="rounded" style="width: 150px; background-color: #E0E0E0; height: 20px"></div>
                                <div class="rounded" style="width: 50px; background-color: #E0E0E0; height: 20px"></div>
                            </div>
                            <div class="d-flex gap-2 mt-2">
                                <div class="me-2 rounded" style="width: 120px; background-color: #E0E0E0; height: 30px">
                                </div>
                                <div class="rounded" style="width: 50px; background-color: #E0E0E0; height: 30px"></div>

                            </div>
                            <div class="d-flex align-items-center gap-2 mt-2">
                                <div class="rounded" style="width: 50px; background-color: #E0E0E0; height: 20px"></div>

                                <div class="rounded" style="width: 70px; background-color: #E0E0E0; height: 20px"></div>

                                <div class="rounded" style="width: 100px; background-color: #E0E0E0; height: 20px"></div>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="col mt-4">
                    <div class="card border-0 position-relative shadow"
                        style="width: 18rem; height: auto; cursor: pointer;">
                        <img src="https://dummyimage.com/600x550/E0E0E0/E0E0E0.png" class="card-img-top" alt="...">
                        <div class="card-body pb-2">
                            <div class="d-flex justify-content-between">
                                <div class="rounded" style="width: 150px; background-color: #E0E0E0; height: 20px"></div>
                                <div class="rounded" style="width: 50px; background-color: #E0E0E0; height: 20px"></div>
                            </div>
                            <div class="d-flex gap-2 mt-2">
                                <div class="me-2 rounded" style="width: 120px; background-color: #E0E0E0; height: 30px">
                                </div>
                                <div class="rounded" style="width: 50px; background-color: #E0E0E0; height: 30px"></div>

                            </div>
                            <div class="d-flex align-items-center gap-2 mt-2">
                                <div class="rounded" style="width: 50px; background-color: #E0E0E0; height: 20px"></div>

                                <div class="rounded" style="width: 70px; background-color: #E0E0E0; height: 20px"></div>

                                <div class="rounded" style="width: 100px; background-color: #E0E0E0; height: 20px"></div>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="col mt-4">
                    <div class="card border-0 position-relative shadow"
                        style="width: 18rem; height: auto; cursor: pointer;">
                        <img src="https://dummyimage.com/600x550/E0E0E0/E0E0E0.png" class="card-img-top" alt="...">
                        <div class="card-body pb-2">
                            <div class="d-flex justify-content-between">
                                <div class="rounded" style="width: 150px; background-color: #E0E0E0; height: 20px"></div>
                                <div class="rounded" style="width: 50px; background-color: #E0E0E0; height: 20px"></div>
                            </div>
                            <div class="d-flex gap-2 mt-2">
                                <div class="me-2 rounded" style="width: 120px; background-color: #E0E0E0; height: 30px">
                                </div>
                                <div class="rounded" style="width: 50px; background-color: #E0E0E0; height: 30px"></div>

                            </div>
                            <div class="d-flex align-items-center gap-2 mt-2">
                                <div class="rounded" style="width: 50px; background-color: #E0E0E0; height: 20px"></div>

                                <div class="rounded" style="width: 70px; background-color: #E0E0E0; height: 20px"></div>

                                <div class="rounded" style="width: 100px; background-color: #E0E0E0; height: 20px"></div>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="col mt-4">
                    <div class="card border-0 position-relative shadow"
                        style="width: 18rem; height: auto; cursor: pointer;">
                        <img src="https://dummyimage.com/600x550/E0E0E0/E0E0E0.png" class="card-img-top" alt="...">
                        <div class="card-body pb-2">
                            <div class="d-flex justify-content-between">
                                <div class="rounded" style="width: 150px; background-color: #E0E0E0; height: 20px"></div>
                                <div class="rounded" style="width: 50px; background-color: #E0E0E0; height: 20px"></div>
                            </div>
                            <div class="d-flex gap-2 mt-2">
                                <div class="me-2 rounded" style="width: 120px; background-color: #E0E0E0; height: 30px">
                                </div>
                                <div class="rounded" style="width: 50px; background-color: #E0E0E0; height: 30px"></div>

                            </div>
                            <div class="d-flex align-items-center gap-2 mt-2">
                                <div class="rounded" style="width: 50px; background-color: #E0E0E0; height: 20px"></div>

                                <div class="rounded" style="width: 70px; background-color: #E0E0E0; height: 20px"></div>

                                <div class="rounded" style="width: 100px; background-color: #E0E0E0; height: 20px"></div>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="col mt-4">
                    <div class="card border-0 position-relative shadow"
                        style="width: 18rem; height: auto; cursor: pointer;">
                        <img src="https://dummyimage.com/600x550/E0E0E0/E0E0E0.png" class="card-img-top" alt="...">
                        <div class="card-body pb-2">
                            <div class="d-flex justify-content-between">
                                <div class="rounded" style="width: 150px; background-color: #E0E0E0; height: 20px"></div>
                                <div class="rounded" style="width: 50px; background-color: #E0E0E0; height: 20px"></div>
                            </div>
                            <div class="d-flex gap-2 mt-2">
                                <div class="me-2 rounded" style="width: 120px; background-color: #E0E0E0; height: 30px">
                                </div>
                                <div class="rounded" style="width: 50px; background-color: #E0E0E0; height: 30px"></div>

                            </div>
                            <div class="d-flex align-items-center gap-2 mt-2">
                                <div class="rounded" style="width: 50px; background-color: #E0E0E0; height: 20px"></div>

                                <div class="rounded" style="width: 70px; background-color: #E0E0E0; height: 20px"></div>

                                <div class="rounded" style="width: 100px; background-color: #E0E0E0; height: 20px"></div>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="col mt-4">
                    <div class="card border-0 position-relative shadow"
                        style="width: 18rem; height: auto; cursor: pointer;">
                        <img src="https://dummyimage.com/600x550/E0E0E0/E0E0E0.png" class="card-img-top" alt="...">
                        <div class="card-body pb-2">
                            <div class="d-flex justify-content-between">
                                <div class="rounded" style="width: 150px; background-color: #E0E0E0; height: 20px"></div>
                                <div class="rounded" style="width: 50px; background-color: #E0E0E0; height: 20px"></div>
                            </div>
                            <div class="d-flex gap-2 mt-2">
                                <div class="me-2 rounded" style="width: 120px; background-color: #E0E0E0; height: 30px">
                                </div>
                                <div class="rounded" style="width: 50px; background-color: #E0E0E0; height: 30px"></div>

                            </div>
                            <div class="d-flex align-items-center gap-2 mt-2">
                                <div class="rounded" style="width: 50px; background-color: #E0E0E0; height: 20px"></div>

                                <div class="rounded" style="width: 70px; background-color: #E0E0E0; height: 20px"></div>

                                <div class="rounded" style="width: 100px; background-color: #E0E0E0; height: 20px"></div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @if (count($products) >= 16)
            <div>
                <button id="load-more" data-next-page-url="{{ route('user-home') }}"
                    data-start-index="{{ $startIndex }}" class="btn rounded-0 mt-3 text-white"
                    style="width: 300px; background: #6777ef">Muat Lebih
                    Banyak</button>
            </div>
        @endif
    </div>
    <script src="{{ asset('/ourjs/home.js') }}" data-navigate-track></script>
@endsection
