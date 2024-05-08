@extends('partial.user.main')
@section('container')
    <div class="container d-flex flex-column justify-content-center gap-4 card-detail-product"
        style="width: 100%; height: 100%">
        <div class="d-flex justify-content-start gap-4 my-4 mx-4" style="width: 96%; height: 100%">
            <div class="pt-0 mt-2">
                <img src="{{ Storage::url('public/product_pictures/' . $product->hasImages()->first()->filepath_image) }}" alt=""
                    style="width: auto">
            </div>
            <div class="d-flex flex-column gap-2 mt-2 px-4" style="width: 40%">
                <div class="d-flex flex-column">
                    <span class=" mt-4">
                        <h2><strong>{{ $product->name }}</strong></h2>
                    </span>
                    <div class="d-flex gap-4">
                        <span>
                            1000+ sold out
                        </span>
                        <span>
                            1000+ review
                        </span>
                        <div  class="d-flex justify-content-start gap-1">
                            {{ $product->rate }} 
                            @for ($i = 1; $i <= $product->rate; $i++)
                                <i class="bi bi-star-fill" style="color: #ffd900"></i>
                            @endfor
                        </div>
                    </div>
                </div>
                @if ($product->discount)
                    <div class="d-flex justify-content-start gap-4 align-items-center">
                        <span>
                            <h2><strong>Rp
                                    {{ number_format($product->price - $product->price * ($product->discount / 100), 2, ',', '.') }}</strong>
                            </h2>
                        </span>
                        <span>
                            <i><strong class="text-decoration-line-through">Rp
                                    {{ number_format($product->price, 2, ',', '.') }}</strong></i>
                        </span>
                    </div>
                @else
                    <div class="d-flex justify-content-start gap-2">
                        <span>
                            <h2><strong>Rp {{ number_format($product->price, 2, ',', '.') }}</strong></h2>
                        </span>
                    </div>
                @endif
                <div class="d-flex justify-content-start gap-4">
                    @foreach ($product->variation as $variation)
                        <div class="d-flex flex-column align-items-start gap-2" style="width: auto">
                            <span>
                                <strong>{{ $variation->name }}</strong>
                            </span>
                            <div class="row row-cols-4 gap-1 ms-1">
                                @foreach ($variation->variationOption as $varOption)
                                    <button type="button"
                                        class="variation-item shadow-sm badge border-sm rounded-0 text-dark"
                                        style="width:auto">
                                        {{ $varOption->name }}
                                    </button>
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="d-flex flex-column gap-2">
                    <div class="d-flex flex-column gap-2">
                        <span>
                            <strong>quantity</strong>
                        </span>
                        <div class="d-flex align-items-center gap-4 shadow-sm"
                            style="width: 129px; height: auto; background-color: white;" id="counter">
                            <button wire:click="decrease" id="decrease" class="badge rounded-0 border-0 text-center"
                                style="height: 30px; width: 30px;"><i class="bi bi-dash"></i></button>
                            <input id="number-counter" type="text" role="spinbutton" pattern="[0-9]*" value="1"
                                class="border-0 rounded-0 text-center" style="width: 20px; height: 28px;" readonly>
                            <button wire:click="increase" id="increase" class="badge rounded-0 border-0 text-center"
                                style="height: 30px; width: 30px;"><i class="bi bi-plus"></i></button>
                        </div>
                    </div>
                    <div class="d-flex justify-content-start gap-4 mb-4">
                        <button class="btn bg-main-color rounded-0 text-white" style="width: 50%" id="add-to-cart">Add to
                            Cart</button>
                        <button class="btn bg-main-color rounded-0 text-white" style="width: 50%" id="add-to-cart">Buy
                            Now</button>
                    </div>
                </div>
            </div>
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
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Enim nobis pariatur quisquam itaque maxime, perspiciatis dolores beatae accusamus veniam nisi, quam sint minima, delectus inventore expedita obcaecati nihil laboriosam qui. Lorem, ipsum dolor sit amet consectetur adipisicing elit. Delectus distinctio numquam commodi officiis ad libero est officia suscipit sed iste ullam quas facere recusandae at possimus atque, fugit enim. Ab?</p>
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
                    <h1><strong>{{ $product->rate}}</strong></h1>
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
