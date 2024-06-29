@extends('partial.user.main')
@section('container')
    <div class="container">
        <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('user-home') }}" class="text-secondary text-opacity-50">Beranda</a></li>
                <li class="breadcrumb-item"><a
                        href="{{ route('user-home') . '?category=' . $product->hasCategory->first()->id }}" class="text-secondary text-opacity-50">{{ $product->hasCategory->first()->name }}</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page"><a
                        href="{{ route('user-detail-product', ['productId' => $product->id]) }}"
                        class="font-main-color text-opacity-50" style="text-decoration: none;">{{ $product->name }}</a></li>
            </ol>
        </nav>
    </div>

    <div class="container d-flex flex-column justify-content-center gap-4 card-detail-product bg-white">
        <div class="d-flex justify-content-start gap-2 my-4 mx-4" style="width: 96%; height: 100%">
            <div class="pt-0 my-2" style="width: 32%; height: 80%">
                <div class="swiper mySwiperImageProduct2">
                    <div class="swiper-wrapper">
                        @php
                            $productImages = $product->hasImages()->get();
                        @endphp
                        @foreach ($productImages as $productImage)
                            <div class="swiper-slide">
                                <img src="{{ Storage::url($productImage->filepath_image) }}" alt=""
                                    style="width: 400px; height: 400px;">
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
                                <img src="{{ Storage::url($productImage->filepath_image) }}" alt=""
                                    style="width: 95px">
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="d-flex flex-column gap-2 mt-2 px-4" style="width: 40%;">
                <div class="d-flex flex-column">
                    <span>
                        <h4><strong>{{ $product->name }}</strong></h4>
                    </span>
                    <div class="d-flex gap-2">
                        <span class="text-dark text-opacity-50">
                            {{ $totalOrders }} terjual
                        </span>
                        <div class="divider-black"></div>
                        <span class="text-dark text-opacity-50">
                            {{ $totalReviews }} ulasan
                        </span>
                        <div class="divider-black"></div>
                        <div class="d-flex justify-content-start gap-1 align-items-center">
                            <span class="text-dark text-opacity-50">
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
                @livewire('DetailProductVariation', ['product' => $product, 'firstVarOption' => $firstVarOption, 'firstVarOptionInit' => $firstVarOptionForCart])
                <div class="d-flex flex-column gap-4 mt-2">
                    <div class="d-flex flex-column gap-2">
                        <span><strong>Deskripsi : </strong></span>
                        <div class="d-flex flex-column">
                            <span>Dimensi : {{ $product->dimensions }}cm</span>
                            <span>Berat : {{ $product->weight }}kg</span>
                        </div>
                        <div class="d-flex gap-2 justify-content-start">
                            {{ $product->desc }}
                        </div>
                    </div>
                </div>
                @if ($defaultUserAddress != [])
                    <div class="d-flex flex-column gap-4 mt-2">
                        <div class="d-flex flex-column gap-2">
                            <span><strong>Pengiriman : </strong></span>
                            <div class="d-flex flex-column gap-2 justify-content-start">
                                <span><i class="bi bi-geo-alt"></i> Pengiriman ke
                                    <strong>{{ $defaultUserAddress->city }}</strong></span>
                                <span><i class="bi bi-truck"></i> Ongkir {{ $defaultCost['service'] }}
                                    ({{ $defaultCost['description'] }}) <strong>Rp
                                        {{ number_format($defaultCost['cost'][0]['value'], 2, ',', '.') }}</strong></span>
                                <span>{{ $costResults['name'] }}</span>
                                <span>Estimasi {{ $defaultCost['cost'][0]['etd'] }} hari</span>
                                <span class="d-flex justify-content-end"><a href="" class="font-main-color"
                                        data-bs-toggle="modal" data-bs-target="#exampleModal">lihat pilihan kurir</a></span>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
            @livewire('AmountsAndNotes', ['product' => $product, 'firstVarOption' => $firstVarOption, 'firstVarOptionForCart' => $firstVarOptionForCart, 'user' => $user])
        </div>
    </div>
    @livewire('Assessment', [
        'product' => $product,
        'arrayStars' => [
            'acumulatedRating' => $acumulatedRating,
            'acumulatedInPercentRating' => $acumulatedInPercentRating,
            'totalRating' => $totalRating,
            'totalReviews' => $totalReviews,
            'percentFiveStars' => $percentFiveStars,
            'fiveStarsCount' => $fiveStarsCount,
            'fourStarsCount' => $fourStarsCount,
            'percentFourStars' => $percentFourStars,
            'percentThreeStars' => $percentThreeStars,
            'threeStarsCount' => $threeStarsCount,
            'percentTwoStars' => $percentTwoStars,
            'twoStarsCount' => $twoStarsCount,
            'percentOneStars' => $percentOneStars,
            'oneStarsCount' => $oneStarsCount,
        ],
    ])
    <div class="container d-flex flex-column justify-content-center gap-4 card-detail-product mt-4 bg-white">
        <div class="container mb-4 mt-2">
            <div class="d-flex justify-content-between ms-2 mt-3">
                <span><strong>
                        <h5>Produk serupa</h5>
                    </strong></span>
                <span class="font-main-color">
                    <strong>lihat lainnya</strong>
                </span>
            </div>
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
                                                <h4>Stok Habis</h4>
                                            </span>
                                        </div>
                                    </div>
                                @endif
                                @if (isset($product->discount))
                                    <span class="text-dark bg-light position-absolute border border-secondary text-center"
                                        style="top: 262px; width: 70px;">Diskon</span>
                                    <span
                                        class="text-dark bg-main-color position-absolute border border-secondary text-center"
                                        style="top: 262px; left: 70px; width: 40px;"><i
                                            class="text-white">{{ floor($product->discount) }}%</i></span>
                                @endif
                                <div class="card-body pb-2">
                                    <div class="d-flex justify-content-between">
                                        <strong>{{ $product->name }}</strong>
                                        <p>Stok {{ $product->stock }}</p>
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
                                            {{ $product?->order?->where('order_status', 'completed')?->count() ?? 0 }} Terjual
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>

        <div class="modal" tabindex="-1" id="modalSuccessAddToCart">
            <div class="modal-dialog">
                <div class="modal-content rounded-0">
                    <div class="d-flex justify-content-end">
                        <button type="button" class="btn-close me-2 mt-2" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body d-flex flex-column justify-content-center align-items-center gap-4 text-center">
                        <span class="text-success fs-1">
                            <i class="bi bi-check-circle-fill"></i>
                        </span>
                        <h5 id="modalMessage"></h5>
                    </div>
                </div>
            </div>
        </div>


    </div>
    @if ($defaultUserAddress != [])
        <div class="modal fade" style="top: 10%" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content rounded-0">
                    <div class="modal-body">
                        <span><strong>Pilihan Kurir Pengiriman</strong></span>
                        <hr>
                        @foreach ($costResults['costs'] as $cost)
                            <div class="d-flex flex-column gap-2 justify-content-start mt-4 mx-4">
                                <span><i class="bi bi-geo-alt"></i> Pengiriman ke
                                    <strong>{{ $defaultUserAddress->city }}</strong></span>
                                <span><i class="bi bi-truck"></i> Ongkir {{ $cost['service'] }}
                                    ({{ $cost['description'] }})
                                    <strong>Rp
                                        {{ number_format($cost['cost'][0]['value'], 2, ',', '.') }}</strong></span>
                                <span>{{ $costResults['name'] }}</span>
                                <span>Estimasi {{ $cost['cost'][0]['etd'] }} hari</span>
                            </div>
                            <hr>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    @endif

@endsection
<script src="{{ asset('/ourjs/detail-product.js') }}" data-navigate-track></script>
<script>
    document.addEventListener('livewire:init', function() {
        Livewire.on('openModalSuccessAddToCart', message => {
            var modal = new bootstrap.Modal(document.getElementById('modalSuccessAddToCart'));
            var modalMessage = document.getElementById('modalMessage');
            console.log(message[0].message);
            modalMessage.innerHTML = message[0].message; // Menambahkan pesan ke dalam tabel-body modal
            modal.show();
        })
    })
</script>
