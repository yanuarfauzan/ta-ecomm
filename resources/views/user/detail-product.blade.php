@extends('partial.user.main')
@section('container')
    <div class="container">
        <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('user-home') }}">Home</a></li>
                @foreach ($product->hasCategory()->get() as $category)
                    <li class="breadcrumb-item"><a href="{{ $category->name }}">{{ $category->name }}</a></li>
                @endforeach
                <li class="breadcrumb-item active" aria-current="page"><a href="{{ route('user-detail-product', ['productId' => $product->id]) }}" style="text-decoration: none; color: black;">{{ $product->name }}</a></li>
            </ol>
        </nav>
    </div>

    <div class="container d-flex flex-column justify-content-center gap-4 card-detail-product">
        <div class="d-flex justify-content-start gap-2 my-4 mx-4" style="width: 96%; height: 100%">
            <div class="pt-0 my-2" style="width: 32%; height: 80%">
                <div class="swiper mySwiperImageProduct2">
                    <div class="swiper-wrapper">
                        @foreach ($product->hasImages()->get() as $productImage)
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
                        @foreach ($product->hasImages()->get() as $productImage)
                            <div class="swiper-slide">
                                <img src="{{ Storage::url('public/product_pictures/' . $productImage->filepath_image) }}"
                                    alt="" style="width: 95px">
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="d-flex flex-column gap-2 mt-2 px-4" style="width: 40%">
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
                    @livewire('DetailProductVariation', ['product' => $product])
                <div class="d-flex flex-column gap-4 mt-2">
                    <div class="d-flex flex-column gap-2">
                        <span><strong>deskripsi : </strong></span>
                        <div class="d-flex flex-column">
                            <span>Package size: 21x5x12 CM</span>
                            <span>Weight: 0,2 KG</span>
                            <span>Shipping Weight: 0,5 KG</span>
                        </div>
                        <div class="d-flex gap-2 justify-content-start">
                            Lorem ipsum, dolor sit amet consectetur adipisicing elit. Earum nesciunt sit, expedita eius
                            pariatur minus. Quaerat atque dignissimos necessitatibus iusto. Facere voluptatem perferendis
                            libero vitae veniam ipsa nostrum fuga perspiciatis?
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
            @livewire('AmountsAndNotes', ['product' => $product])
        </div>
    </div>
    <div class="container d-flex flex-column justify-content-center gap-4 card-detail-product mt-4"
        style="width: 100%; height: 100%">
        <div class="container mt-2 d-flex flex-column gap-2">
            <h4><strong>Description</strong></h4>
            <div class="d-flex flex-column ms-2">
                <span>Package size: 21x5x12 CM</span>
                <span>Weight: 0,2 KG</span>
                <span>Shipping Weight: 0,5 KG</span>
            </div>
            <div class="ms-2">
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Enim nobis pariatur quisquam itaque maxime,
                    perspiciatis dolores beatae accusamus veniam nisi, quam sint minima, delectus inventore expedita
                    obcaecati nihil laboriosam qui. Lorem, ipsum dolor sit amet consectetur adipisicing elit. Delectus
                    distinctio numquam commodi officiis ad libero est officia suscipit sed iste ullam quas facere recusandae
                    at possimus atque, fugit enim. Ab?</p>
            </div>
        </div>
    </div>

    <div class="container d-flex flex-column justify-content-center gap-4 card-detail-product mt-4"
        style="width: 100%; height: 100%">
        <div class="container mt-2 d-flex flex-column gap-2">
            <h4><strong>Review</strong></h4>
            <div class="d-flex flex-column ms-2">
                <div class="d-flex gap-1 justify-content-start">
                    <span>
                        <i class="bi bi-star-fill" style="color: #ffd900; font-size: 40px;"></i>
                    </span>
                    <span class="d-flex mt-2">
                        <h1><strong>{{ $product->rate }}</strong></h1>
                        <h1>/</h1>
                        <h4 class="mt-3">5</h4>
                    </span>
                </div>
            </div>
            <div class="ms-2">
            </div>
        </div>
    </div>
@endsection
<script src="{{ asset('/ourjs/detail-product.js') }}" data-navigate-track></script>
