@extends('partial.user.main')
@section('container')
    <div class="container">
        <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('user-home') }}">Home</a></li>
                @foreach ($product->hasCategory()->get() as $category)
                    <li class="breadcrumb-item"><a href="{{ $category->name }}">{{ $category->name }}</a></li>
                @endforeach
                <li class="breadcrumb-item active" aria-current="page"><a
                        href="{{ route('user-detail-product', ['productId' => $product->id]) }}"
                        style="text-decoration: none; color: black;">{{ $product->name }}</a></li>
            </ol>
        </nav>
    </div>

    <div class="container d-flex flex-column justify-content-center gap-4 card-detail-product">
        <div class="d-flex justify-content-start gap-2 my-4 mx-4" style="width: 96%; height: 100%">
            <div class="pt-0 my-2" style="width: 32%; height: 80%">
                <div class="swiper mySwiperImageProduct2">
                    <div class="swiper-wrapper">
                        @php
                            $productImages = $product->hasImages()->get();
                        @endphp
                        @foreach ($productImages as $productImage)
                            <div class="swiper-slide">
                                <img src="{{ Storage::url('public/product_pictures/' . $productImage->filepath_image) }}"
                                    alt="" style="width: auto">
                            </div>
                        @endforeach
                    </div>
                    <div class="swiper-button-next"><i class="bi bi-chevron-right"></i></div>
                    <div class="swiper-button-prev"><i class="bi bi-chevron-left"></i></div>
                </div>
                <div thumbsSlider="" class="swiper mySwiperImageProduct mt-1">
                    <div class="swiper-wrapper">
                        @foreach ($productImages as $productImage)
                            <div class="swiper-slide">
                                <img src="{{ Storage::url('public/product_pictures/' . $productImage->filepath_image) }}"
                                    alt="" style="width: 95px">
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="d-flex flex-column gap-2 mt-2 px-4" style="width: 40%;">
                <div class="d-flex flex-column">
                    <span>
                        <h2><strong>{{ $product->name }}</strong></h2>
                    </span>
                    <div class="d-flex gap-2">
                        <span>
                            1000+ sold out
                        </span>
                        <div class="divider-black"></div>
                        <span>
                            1000+ review
                        </span>
                        <div class="divider-black"></div>
                        <div class="d-flex justify-content-start gap-1 align-items-center">
                            <span>
                                {{ $product->rate }}
                            </span>
                            @for ($i = 1; $i <= $product->rate; $i++)
                                <span>
                                    <i class="bi bi-star-fill" style="color: #ffd900"></i>
                                </span>
                            @endfor
                        </div>
                    </div>
                </div>
                @if ($product->discount)
                    <div class="d-flex flex-column gap-2 align-items-start">
                        <span class="d-flex flex-column p-0">
                            <h2><strong>Rp
                                    {{ number_format($product->price - $product->price * ($product->discount / 100), 2, ',', '.') }}</strong>
                            </h2>
                            <div class="d-flex gap-2">
                                <span class="text-dark bg-main-color border border-secondary text-center"
                                    style="width: 40px;"><i class="text-white">{{ floor($product->discount) }}%</i></span>
                                <i><strong class="text-decoration-line-through">Rp
                                        {{ number_format($product->price, 2, ',', '.') }}</strong></i>
                            </div>
                        </span>
                    </div>
                @else
                    <div class="d-flex justify-content-start gap-2">
                        <span>
                            <h2><strong>Rp {{ number_format($product->price, 2, ',', '.') }}</strong></h2>
                        </span>
                    </div>
                @endif
                @livewire('DetailProductVariation', ['product' => $product, 'firstVarOption' => $firstVarOption])
                <div class="d-flex flex-column gap-4 mt-2">
                    <div class="d-flex flex-column gap-2">
                        <span><strong>deskripsi : </strong></span>
                        <div class="d-flex flex-column">
                            <span>Package size: 21x5x12 CM</span>
                            <span>Weight: {{ $product->weight }} KG</span>
                            <span>Shipping Weight: 0,5 KG</span>
                        </div>
                        <div class="d-flex gap-2 justify-content-start">
                            {{ $product->desc }}
                        </div>
                    </div>
                </div>
                <div class="d-flex flex-column gap-4 mt-2">
                    <div class="d-flex flex-column gap-2">
                        <span><strong>pengiriman : </strong></span>
                        <div class="d-flex flex-column gap-2 justify-content-start">
                            <span><i class="bi bi-geo-alt"></i> dikirim dari</span>
                            <span><i class="bi bi-truck"></i> ongkir reguler 16 rb - 20 rb</span>
                            <span>estimasi 2 -3 hari</span>
                            <span class="d-flex justify-content-end font-main-color">lihat pilihan kurir</span>
                            <span class="d-flex justify-content-between">
                                <p>ada masalah dengan produk ini?</p>
                                <p class="font-main-color"><i class="bi bi-flag font-main-color"></i> laporkan</p>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            @livewire('AmountsAndNotes', ['product' => $product, 'firstVarOption' => $firstVarOption, 'firstVarOptionForCart' => $firstVarOptionForCart, 'user' => $user])
        </div>
    </div>
    <div class="container d-flex justify-content-start align-items-start gap-4 p-0">
        <div class="d-flex flex-column justify-content-center gap-4" style="width: 30%">
            <div class="d-flex flex-column justify-content-center gap-2 card-detail-product mt-4" style="width: 100%">
                <div class="container mt-4 d-flex flex-column gap-2 ms-4">
                    <h4><strong>ulasan pembeli</strong></h4>
                </div>
                <div class="container d-flex flex-column gap-2">
                    <div class="d-flex flex-column align-items-center justify-content-center">
                        <div class="d-flex gap-1 justify-content-start align-items-center">
                            <span>
                                <i class="bi bi-star-fill" style="color: #ffd900; font-size: 30px;"></i>
                            </span>
                            <span class="d-flex align-items-center mt-2" style="height: 80px">
                                <p style="font-size: 100px; font-weight: 100;">{{ $product->rate }}</p>
                                <div class="d-flex align-items-end mt-5">
                                    <p style="font-size: 20px; font-weight: 100;">/</p>
                                    <p style="font-size: 20px; font-weight: 100;">5</p>
                                </div>
                            </span>
                        </div>
                    </div>
                    <div class="ms-2">
                    </div>
                </div>
                <div class="container d-flex flex-column align-items-center">
                    <span>
                        86% pembeli merasa puas
                    </span>
                    <div class="d-flex gap-2 justify-content-center align-items-center">
                        <span>1.823 rating</span>
                        <div class="low-divider-black"></div>
                        <span>768 ulasan</span>
                    </div>
                </div>
                <div class="d-flex flex-column mb-4">
                    <div class="d-flex justify-content-center align-items-center mx-3 gap-2">
                        <!-- Elemen span dengan bintang -->
                        <span><i class="bi bi-star-fill" style="color: #ffd900;"></i> 5</span>
                        <!-- Elemen progress -->
                        <div class="progress" role="progressbar" aria-label="Basic example" aria-valuenow="0"
                            aria-valuemin="0" aria-valuemax="100" style="width: 50%;">
                            <div class="progress-bar bg-main-color" style="width: 50%"></div>
                        </div>
                        <span>13</span>
                    </div>
                    <div class="d-flex justify-content-center align-items-center mx-3 gap-2">
                        <!-- Elemen span dengan bintang -->
                        <span><i class="bi bi-star-fill" style="color: #ffd900;"></i> 4</span>
                        <!-- Elemen progress -->
                        <div class="progress" role="progressbar" aria-label="Basic example" aria-valuenow="0"
                            aria-valuemin="0" aria-valuemax="100" style="width: 50%;">
                            <div class="progress-bar bg-main-color" style="width: 50%"></div>
                        </div>
                        <span>13</span>
                    </div>
                    <div class="d-flex justify-content-center align-items-center mx-3 gap-2">
                        <!-- Elemen span dengan bintang -->
                        <span><i class="bi bi-star-fill" style="color: #ffd900;"></i> 3</span>
                        <!-- Elemen progress -->
                        <div class="progress" role="progressbar" aria-label="Basic example" aria-valuenow="0"
                            aria-valuemin="0" aria-valuemax="100" style="width: 50%;">
                            <div class="progress-bar bg-main-color" style="width: 50%"></div>
                        </div>
                        <span>13</span>
                    </div>
                    <div class="d-flex justify-content-center align-items-center mx-3 gap-2">
                        <!-- Elemen span dengan bintang -->
                        <span><i class="bi bi-star-fill" style="color: #ffd900;"></i> 2</span>
                        <!-- Elemen progress -->
                        <div class="progress" role="progressbar" aria-label="Basic example" aria-valuenow="0"
                            aria-valuemin="0" aria-valuemax="100" style="width: 50%;">
                            <div class="progress-bar bg-main-color" style="width: 50%"></div>
                        </div>
                        <span>13</span>
                    </div>
                    <div class="d-flex justify-content-center align-items-center mx-3 gap-2">
                        <!-- Elemen span dengan bintang -->
                        <span><i class="bi bi-star-fill" style="color: #ffd900;"></i> 1</span>
                        <!-- Elemen progress -->
                        <div class="progress" role="progressbar" aria-label="Basic example" aria-valuenow="0"
                            aria-valuemin="0" aria-valuemax="100" style="width: 50%;">
                            <div class="progress-bar bg-main-color" style="width: 50%"></div>
                        </div>
                        <span>13</span>
                    </div>
                </div>
            </div>
            <div class="d-flex flex-column justify-content-center gap-2 card-detail-product" style="width: 100%">
                <div class="container my-2 d-flex flex-column gap-2">
                    <h4 class="ms-4 mt-4"><strong>filter ulasan</strong></h4>
                    <div class="container d-flex flex-column">
                        <div class="ms-2">
                            <span><strong>media</strong></span>
                        </div>
                        <hr class="m-0">
                        <div class="d-flex justify-content-start align-items-center gap-2 my-2 ms-2">
                            <span>
                                <input class="form-check-input" type="checkbox" id="flexCheckDefault"
                                    style="width: 20px; height: 20px; cursor: pointer;">
                                <span>dengan foto dan video</span>
                            </span>
                        </div>
                    </div>
                    <div class="container d-flex flex-column">
                        <div>
                            <span class="ms-2"><strong>rating</strong></span>
                        </div>
                        <hr class="m-0">
                        <div class="d-flex flex-column justify-content-start align-items-start gap-2 my-2 ms-2">
                            <span>
                                <input class="form-check-input" type="checkbox" id="flexCheckDefault"
                                    style="width: 20px; height: 20px; cursor: pointer;">
                                <span><i class="bi bi-star-fill" style="color: #ffd900;"></i> 5</span>
                            </span>
                            <span>
                                <input class="form-check-input" type="checkbox" id="flexCheckDefault"
                                    style="width: 20px; height: 20px; cursor: pointer;">
                                <span><i class="bi bi-star-fill" style="color: #ffd900;"></i> 4</span>
                            </span>
                            <span>
                                <input class="form-check-input" type="checkbox" id="flexCheckDefault"
                                    style="width: 20px; height: 20px; cursor: pointer;">
                                <span><i class="bi bi-star-fill" style="color: #ffd900;"></i> 3</span>
                            </span>
                            <span>
                                <input class="form-check-input" type="checkbox" id="flexCheckDefault"
                                    style="width: 20px; height: 20px; cursor: pointer;">
                                <span><i class="bi bi-star-fill" style="color: #ffd900;"></i> 2</span>
                            </span>
                            <span>
                                <input class="form-check-input" type="checkbox" id="flexCheckDefault"
                                    style="width: 20px; height: 20px; cursor: pointer;">
                                <span><i class="bi bi-star-fill" style="color: #ffd900;"></i> 1</span>
                            </span>
                        </div>
                    </div>
                    <div class="container d-flex flex-column">
                        <div>
                            <span class="ms-2"><strong>topik ulasan</strong></span>
                        </div>
                        <hr class="m-0">
                        <div class="d-flex flex-column justify-content-start align-items-start gap-2 my-2 ms-2">
                            <span>
                                <input class="form-check-input" type="checkbox" id="flexCheckDefault"
                                    style="width: 20px; height: 20px; cursor: pointer;">
                                <span>kualitas barang</span>
                            </span>
                            <span>
                                <input class="form-check-input" type="checkbox" id="flexCheckDefault"
                                    style="width: 20px; height: 20px; cursor: pointer;">
                                <span>pengiriman</span>
                            </span>
                            <span>
                                <input class="form-check-input" type="checkbox" id="flexCheckDefault"
                                    style="width: 20px; height: 20px; cursor: pointer;">
                                <span>kemasan barang</span>
                            </span>
                            <span>
                                <input class="form-check-input" type="checkbox" id="flexCheckDefault"
                                    style="width: 20px; height: 20px; cursor: pointer;">
                                <span>pelayanan penjual</span>
                            </span>
                            <span>
                                <input class="form-check-input" type="checkbox" id="flexCheckDefault"
                                    style="width: 20px; height: 20px; cursor: pointer;">
                                <span>harga barang</span>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="d-flex flex-column gap-2 card-detail-product mt-4" style="width: 70%">
            <div class="container my-4 d-flex flex-column gap-2" style="100%;">
                <h4 class="ms-4"><strong>foto & video pembeli</strong></h4>
                <div class="d-flex align-items-center justify-content-start gap-2 ms-4">
                    <span>
                        <img src="https://placehold.co/600x400/png" alt="" style="width: 80px; height: 80px;">
                    </span>
                    <span>
                        <img src="https://placehold.co/600x400/png" alt="" style="width: 80px; height: 80px;">
                    </span>
                    <span>
                        <img src="https://placehold.co/600x400/png" alt="" style="width: 80px; height: 80px;">
                    </span>
                    <span>
                        <img src="https://placehold.co/600x400/png" alt="" style="width: 80px; height: 80px;">
                    </span>
                    <span>
                        <img src="https://placehold.co/600x400/png" alt="" style="width: 80px; height: 80px;">
                    </span>
                </div>
            </div>
            <div class="container d-flex flex-column gap-2">
                <div class="d-flex justify-content-between ms-4">
                    <div class="d-flex flex-column gap-2">
                        <h4><strong>ulasan pilihan</strong></h4>
                        <span class="opacity-50">menampilkan 5 dari 10 ulasan</span>
                    </div>
                    <div class="d-flex justify-content-start align-items-center gap-2 rounded-0 custom-div me-5">
                        <span class="mb-3"><strong>urutkan</strong></span>
                        <select class="form-select form-select-lg mb-3 rounded-0 custom-select" style="height: 50px"
                            aria-label="Large select example">
                            <option selected>paling membantu</option>
                            <option value="1">terbaru</option>
                            <option value="2">rating tertinggi</option>
                            <option value="3">rating terendah</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="container d-flex flex-column gap-2">
                <div class="d-flex justify-content-start align-items-center gap-2 ms-4">
                    <span>
                        <i class="bi bi-star-fill" style="color: #ffd900"></i>
                    </span>
                    <span>
                        <i class="bi bi-star-fill" style="color: #ffd900"></i>
                    </span>
                    <span>
                        <i class="bi bi-star-fill" style="color: #ffd900"></i>
                    </span>
                    <span>
                        <i class="bi bi-star-fill" style="color: #ffd900"></i>
                    </span>
                    <span>
                        <i class="bi bi-star-fill" style="color: #ffd900"></i>
                    </span>
                    <span>lebih dari 1 tahun yang lalu</span>
                </div>
                <div class="d-flex justify-content-start align-items-center gap-2 ms-4">
                    <span><img src="https://placehold.co/400x400/png" alt="" class="rounded-circle"
                            style="width: 40px;"></span>
                    <span><strong>Yanuar</strong></span>
                </div>
                <div class="d-flex justify-content-start align-items-center ms-4">
                    <span>varian: pendek, ungu</span>
                </div>
                <div class="d-flex justify-content-start align-items-center ms-4">
                    <span><strong>celananya bagus, warna ungu nya menyala, pelayanan nya memuaskan</strong></span>
                </div>
                <div class="accordion accordion-flush ms-2" id="accordionFlushExample">
                    <div class="accordion-item">
                        <h2 class="accordion-header" style="background-color: #F8F9FA;">
                            <button class="accordion-button collapsed border-white shadow-0" type="button"
                                data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false"
                                aria-controls="flush-collapseOne"
                                style="width: 155px; height: 30px; background-color: #F8F9FA;">
                                lihat balasan
                            </button>
                        </h2>
                        <div id="flush-collapseOne" class="accordion-collapse collapse mt-2"
                            data-bs-parent="#accordionFlushExample">
                            <div class="d-flex justify-content-start align-items-center gap-2 ms-3 my-1">
                                <span><img src="https://placehold.co/400x400/png" alt="" class="rounded-circle"
                                        style="width: 40px;"></span>
                                <span><strong>Penjual</strong></span>
                            </div>
                            <div class="d-flex justify-content-start align-items-center ms-3">
                                <span><strong>terimakasih ya kak</strong></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container d-flex flex-column gap-2">
                <div class="d-flex justify-content-start align-items-center gap-2 ms-4">
                    <span>
                        <i class="bi bi-star-fill" style="color: #ffd900"></i>
                    </span>
                    <span>
                        <i class="bi bi-star-fill" style="color: #ffd900"></i>
                    </span>
                    <span>
                        <i class="bi bi-star-fill" style="color: #ffd900"></i>
                    </span>
                    <span>
                        <i class="bi bi-star-fill" style="color: #ffd900"></i>
                    </span>
                    <span>
                        <i class="bi bi-star-fill" style="color: #ffd900"></i>
                    </span>
                    <span>lebih dari 1 tahun yang lalu</span>
                </div>
                <div class="d-flex justify-content-start align-items-center gap-2 ms-4">
                    <span><img src="https://placehold.co/400x400/png" alt="" class="rounded-circle"
                            style="width: 40px;"></span>
                    <span><strong>Yanuar</strong></span>
                </div>
                <div class="d-flex justify-content-start align-items-center ms-4">
                    <span>varian: pendek, ungu</span>
                </div>
                <div class="d-flex justify-content-start align-items-center ms-4">
                    <span><strong>celananya bagus, warna ungu nya menyala, pelayanan nya memuaskan</strong></span>
                </div>
                <div class="accordion accordion-flush ms-2" id="accordionFlushExample">
                    <div class="accordion-item">
                        <h2 class="accordion-header" style="background-color: #F8F9FA;">
                            <button class="accordion-button collapsed border-white shadow-0" type="button"
                                data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false"
                                aria-controls="flush-collapseOne"
                                style="width: 155px; height: 30px; background-color: #F8F9FA;">
                                lihat balasan
                            </button>
                        </h2>
                        <div id="flush-collapseOne" class="accordion-collapse collapse mt-2"
                            data-bs-parent="#accordionFlushExample">
                            <div class="d-flex justify-content-start align-items-center gap-2 ms-3 my-1">
                                <span><img src="https://placehold.co/400x400/png" alt="" class="rounded-circle"
                                        style="width: 40px;"></span>
                                <span><strong>Penjual</strong></span>
                            </div>
                            <div class="d-flex justify-content-start align-items-center ms-3">
                                <span><strong>terimakasih ya kak</strong></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container d-flex flex-column gap-2">
                <div class="d-flex justify-content-start align-items-center gap-2 ms-4">
                    <span>
                        <i class="bi bi-star-fill" style="color: #ffd900"></i>
                    </span>
                    <span>
                        <i class="bi bi-star-fill" style="color: #ffd900"></i>
                    </span>
                    <span>
                        <i class="bi bi-star-fill" style="color: #ffd900"></i>
                    </span>
                    <span>
                        <i class="bi bi-star-fill" style="color: #ffd900"></i>
                    </span>
                    <span>
                        <i class="bi bi-star-fill" style="color: #ffd900"></i>
                    </span>
                    <span>lebih dari 1 tahun yang lalu</span>
                </div>
                <div class="d-flex justify-content-start align-items-center gap-2 ms-4">
                    <span><img src="https://placehold.co/400x400/png" alt="" class="rounded-circle"
                            style="width: 40px;"></span>
                    <span><strong>Yanuar</strong></span>
                </div>
                <div class="d-flex justify-content-start align-items-center ms-4">
                    <span>varian: pendek, ungu</span>
                </div>
                <div class="d-flex justify-content-start align-items-center ms-4">
                    <span><strong>celananya bagus, warna ungu nya menyala, pelayanan nya memuaskan</strong></span>
                </div>
                <div class="accordion accordion-flush ms-2" id="accordionFlushExample">
                    <div class="accordion-item">
                        <h2 class="accordion-header" style="background-color: #F8F9FA;">
                            <button class="accordion-button collapsed border-white shadow-0" type="button"
                                data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false"
                                aria-controls="flush-collapseOne"
                                style="width: 155px; height: 30px; background-color: #F8F9FA;">
                                lihat balasan
                            </button>
                        </h2>
                        <div id="flush-collapseOne" class="accordion-collapse collapse mt-2"
                            data-bs-parent="#accordionFlushExample">
                            <div class="d-flex justify-content-start align-items-center gap-2 ms-3 my-1">
                                <span><img src="https://placehold.co/400x400/png" alt="" class="rounded-circle"
                                        style="width: 40px;"></span>
                                <span><strong>Penjual</strong></span>
                            </div>
                            <div class="d-flex justify-content-start align-items-center ms-3">
                                <span><strong>terimakasih ya kak</strong></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container d-flex flex-column gap-2">
                <div class="d-flex justify-content-start align-items-center gap-2 ms-4">
                    <span>
                        <i class="bi bi-star-fill" style="color: #ffd900"></i>
                    </span>
                    <span>
                        <i class="bi bi-star-fill" style="color: #ffd900"></i>
                    </span>
                    <span>
                        <i class="bi bi-star-fill" style="color: #ffd900"></i>
                    </span>
                    <span>
                        <i class="bi bi-star-fill" style="color: #ffd900"></i>
                    </span>
                    <span>
                        <i class="bi bi-star-fill" style="color: #ffd900"></i>
                    </span>
                    <span>lebih dari 1 tahun yang lalu</span>
                </div>
                <div class="d-flex justify-content-start align-items-center gap-2 ms-4">
                    <span><img src="https://placehold.co/400x400/png" alt="" class="rounded-circle"
                            style="width: 40px;"></span>
                    <span><strong>Yanuar</strong></span>
                </div>
                <div class="d-flex justify-content-start align-items-center ms-4">
                    <span>varian: pendek, ungu</span>
                </div>
                <div class="d-flex justify-content-start align-items-center ms-4">
                    <span><strong>celananya bagus, warna ungu nya menyala, pelayanan nya memuaskan</strong></span>
                </div>
                <div class="accordion accordion-flush ms-2" id="accordionFlushExample">
                    <div class="accordion-item">
                        <h2 class="accordion-header" style="background-color: #F8F9FA;">
                            <button class="accordion-button collapsed border-white shadow-0" type="button"
                                data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false"
                                aria-controls="flush-collapseOne"
                                style="width: 155px; height: 30px; background-color: #F8F9FA;">
                                lihat balasan
                            </button>
                        </h2>
                        <div id="flush-collapseOne" class="accordion-collapse collapse mt-2"
                            data-bs-parent="#accordionFlushExample">
                            <div class="d-flex justify-content-start align-items-center gap-2 ms-3 my-1">
                                <span><img src="https://placehold.co/400x400/png" alt="" class="rounded-circle"
                                        style="width: 40px;"></span>
                                <span><strong>Penjual</strong></span>
                            </div>
                            <div class="d-flex justify-content-start align-items-center ms-3">
                                <span><strong>terimakasih ya kak</strong></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container d-flex flex-column gap-2">
                <div class="d-flex justify-content-start align-items-center gap-2 ms-4">
                    <span>
                        <i class="bi bi-star-fill" style="color: #ffd900"></i>
                    </span>
                    <span>
                        <i class="bi bi-star-fill" style="color: #ffd900"></i>
                    </span>
                    <span>
                        <i class="bi bi-star-fill" style="color: #ffd900"></i>
                    </span>
                    <span>
                        <i class="bi bi-star-fill" style="color: #ffd900"></i>
                    </span>
                    <span>
                        <i class="bi bi-star-fill" style="color: #ffd900"></i>
                    </span>
                    <span>lebih dari 1 tahun yang lalu</span>
                </div>
                <div class="d-flex justify-content-start align-items-center gap-2 ms-4">
                    <span><img src="https://placehold.co/400x400/png" alt="" class="rounded-circle"
                            style="width: 40px;"></span>
                    <span><strong>Yanuar</strong></span>
                </div>
                <div class="d-flex justify-content-start align-items-center ms-4">
                    <span>varian: pendek, ungu</span>
                </div>
                <div class="d-flex justify-content-start align-items-center ms-4">
                    <span><strong>celananya bagus, warna ungu nya menyala, pelayanan nya memuaskan</strong></span>
                </div>
                <div class="accordion accordion-flush ms-2" id="accordionFlushExample">
                    <div class="accordion-item">
                        <h2 class="accordion-header" style="background-color: #F8F9FA;">
                            <button class="accordion-button collapsed border-white shadow-0" type="button"
                                data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false"
                                aria-controls="flush-collapseOne"
                                style="width: 155px; height: 30px; background-color: #F8F9FA;">
                                lihat balasan
                            </button>
                        </h2>
                        <div id="flush-collapseOne" class="accordion-collapse collapse mt-2"
                            data-bs-parent="#accordionFlushExample">
                            <div class="d-flex justify-content-start align-items-center gap-2 ms-3 my-1">
                                <span><img src="https://placehold.co/400x400/png" alt="" class="rounded-circle"
                                        style="width: 40px;"></span>
                                <span><strong>Penjual</strong></span>
                            </div>
                            <div class="d-flex justify-content-start align-items-center ms-3">
                                <span><strong>terimakasih ya kak</strong></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container d-flex flex-column justify-content-center gap-4 card-detail-product mt-4">
        <div class="container mb-4 mt-2">
            <div class="d-flex justify-content-between ms-2 mt-3">
                <span><strong>
                        <h4>produk serupa</h4>
                    </strong></span>
                <span>
                    <h5><a href="#">lihat lainnya</a></h5>
                </span>
            </div>
            <div class="row row-cols-4 ms-0">
                @foreach ($products as $index => $product)
                    <a href="{{ route('user-detail-product', ['productId' => $product->id]) }}"
                        style="text-decoration: none">
                        <div class="col mt-4">
                            <div class="card border-0 position-relative shadow rounded-0" id="card-product"
                                style="width: 18rem; height: auto; cursor: pointer;">
                                <div style="overflow: hidden;">
                                    <img src="{{ Storage::url('public/product_pictures/' . $product->hasImages->first()->filepath_image) }}"
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
                                        class="text-dark bg-secondary position-absolute border border-secondary text-center"
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

    </div>
@endsection
<script src="{{ asset('/ourjs/detail-product.js') }}" data-navigate-track></script>
