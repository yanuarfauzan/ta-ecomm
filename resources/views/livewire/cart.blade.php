<div class="container d-flex justify-content-between gap-4" style="width: 100%; height: 100%">
    <div class="d-flex flex-column gap-2" style="width: 70%; height: 100%;">
        <div id="head-cart"
            class="bg-main-color d-flex justify-content-start px-4 align-items-center shadow-sm gap-4 text-white"
            style="width: 100%; height: 50px;">
            <span class="d-inline-block" style="width: 8%;">
                <input id="all-check" class="form-check-input head-check-input" type="checkbox" value=""
                    style="width: 20px; height: 20px; cursor: pointer;">
            </span>
            <span class="d-inline-block" style="width: 33%;">Produk</span>
            <span class="d-inline-block" style="width: 37%;">Harga satuan</span>
            <span>Total harga</span>
        </div>
        @foreach ($usersCarts as $index => $userCart)
            @php
                $product = $userCart->hasProduct->first();
                $variation = $product->variation->first();
            @endphp
            <div class="card-product card-all-check d-flex justify-content-between px-4 align-items-center shadow-sm gap-4"
                style="width: 100%; height: 140px; background-color: white" id="card-product-{{ $userCart->id }}">
                <div class="d-flex justify-content-start align-items-center gap-4" style="width: 30%;">
                    <span>
                        <input class="form-check-input check-product-{{ $userCart->id }} all-check" type="checkbox"
                            id="flexCheckDefault" style="width: 20px; height: 20px; cursor: pointer;">
                    </span>
                    <img src="{{ Storage::url('public/product_pictures/' . $product->product_image) }}" alt=""
                        style="width: 80px; height: 80px;">
                    <div class="d-flex position-relative justify-content-between" style="width: auto;">
                        @livewire('variation', ['index' => $index, 'product' => $product, 'usersCarts' => $usersCarts], key($product->id))
                    </div>
                </div>
                <div class="d-flex flex-column justify-content-center align-items-center " style="width: 150px;">
                    <div class="width: 100%">
                        <h5 class="font-main-color"><strong>Rp
                                {{ number_format($product->price, 2, ',', '.') }}</strong></h5>
                    </div>
                    @if (isset($product->discount))
                        <div class="d-flex" style="width: auto">
                            <span class="text-dark bg-light border-main-color text-center"
                                style="width: 80px; height: 27px;">
                                <p class="font-main-color">Discount</p>
                            </span>
                            <span class="text-dark bg-main-color border-main-color text-center"
                                style="width: 40px; height: 27px"><i
                                    class="text-white">{{ floor($product->discount) }}%</i></span>
                        </div>
                    @endif
                    <span>
                        <input type="checkbox" class="btn-check btn-check-outlined"
                            id="btn-check-outlined-{{ $userCart->id }}" autocomplete="off"
                            wire:click="toggleRelatedProducts('{{ $userCart->id }}')"
                            {{ $userCartId === $userCart->id ? 'checked' : '' }}>
                        <label class="btn rounded-0 mt-2 p-0" for="btn-check-outlined-{{ $userCart->id }}"
                            style="width: 120px; height: 27px;">produk serupa</label><br>
                    </span>
                </div>
                @livewire('counter', ['userCart' => $userCart, 'product' => $product, 'user' => $user], key($userCart->id))
            </div>
            @php
                $index++;
            @endphp
        @endforeach
    </div>
    <div class="d-flex flex-column align-items-start gap-2" style="width: 30%; height: 100%;">
        <div class="shadow-sm card-summary bg-light" style="width: 100%; height: 280px;">
            <div class="container d-flex flex-column py-4 px-4 gap-2" style="width: 100%; height: 100%">
                <span>
                    <strong class="font-main-color">
                        <h5>Shopping Summary</h5>
                    </strong>
                </span>
                <div class="d-flex justify-content-between align-items-center">
                    <div class="d-flex flex-column align-items-start">
                        <span><strong>Subtotal</strong></span>
                        <span><strong>Discount</strong></span>
                    </div>
                    <div class="d-flex flex-column align-items-center">
                        <span><strong>Rp {{ number_format($totalPrice, 2, ',', '.') }}</strong></span>
                        <span><strong>- Rp {{ number_format($totalDiscount, 2, ',', '.') }}</strong></span>
                    </div>
                </div>
                <hr class="border border-secondary bg-main-color opacity-50">
                <div class="d-flex justify-content-between align-items-center">
                    <span><strong>Total :</strong></span>
                    <span><strong>Rp {{ number_format($totalPrice - $totalDiscount, 2, ',', '.') }}</strong></span>
                </div>
                <button id="checkout" class="btn rounded-0 mt-3 bg-main-color text-white"
                    style="width: 100%;"><strong>Checkout</strong></button>
            </div>
        </div>
        <div class="shadow-sm card-related-products card-summary bg-light {{ count($relatedProducts ?? []) > 0 ? 'show' : 'hide' }}"
            style="width: 100%; height: 590px;">
            <div class="container" style="width: 100%; height: 400px">
                <div class="d-flex flex-column position-relative">
                    <span class="d-flex justify-content-between mt-4 mx-3">
                        <strong class="font-main-color">
                            <h5>Related Product</h5>
                        </strong>
                        <form action="/test" method="GET">
                            @csrf
                            @for ($i = 0; $i < count($categoryIds ?? []); $i++)
                                <input type="hidden" name="categoryIds[]" value="{{ $categoryIds[$i] ?? null }}">
                            @endfor
                            <button type="submit" class="font-main-color bg-transparent border-0">
                                <p>view more..</p>
                            </button>
                        </form>
                    </span>
                    <div class="row row-cols-2 mx-2">
                        @foreach ($relatedProducts ?? [] as $product)
                            <a href="" style="text-decoration: none">
                                <div class="col mt-4" style="width: 145px;">
                                    <div class="card border position-relative shadow-sm rounded-0" id="card-product"
                                        style="width: 100%; max-width: 150px; height: auto; cursor: pointer;">
                                        <div style="overflow: hidden;">
                                            <img src="{{ Storage::url('public/product_pictures/' . $product->product_image) }}"
                                                class="card-img-top rounded-0" alt="..." id="image-product"
                                                style="width: 100%;">
                                        </div>
                                        @if (isset($product->discount))
                                            <span
                                                class="text-dark bg-light position-absolute border border-secondary text-center"
                                                style="top: 127px; width: 50px; font-size: 10px;">Discount</span>
                                            <span
                                                class="text-dark bg-secondary position-absolute border border-secondary text-center"
                                                style="top: 127px; left: 50px; width: 30px; font-size: 10px;"><i
                                                    class="text-white">{{ floor($product->discount) }}%</i></span>
                                        @endif
                                        <div class="card-body p-2">
                                            <div class="d-flex justify-content-between">
                                                <strong style="font-size: 10px;">{{ $product->name }}</strong>
                                                <p style="font-size: 10px;">Stock
                                                    {{ $product->stock }}</p>
                                            </div>
                                            @if (isset($product->discount))
                                                <div class="d-flex gap-2 align-items-center">
                                                    <h5 style="font-size: 12px; margin: 0;">
                                                        <strong>Rp
                                                            {{ number_format($product->price - $product->price * ($product->discount / 100), 2, ',', '.') }}</strong>
                                                    </h5>
                                                    <div class="d-flex justify-content-center align-items-center">
                                                        <p style="font-size: 8px; margin: 0;"
                                                            class="text-decoration-line-through">
                                                            <i>Rp
                                                                {{ number_format($product->price, 2, ',', '.') }}</i>
                                                        </p>
                                                    </div>
                                                </div>
                                            @else
                                                <div class="d-flex gap-2 align-items-center">
                                                    <h5 style="font-size: 12px; margin: 0;">
                                                        <strong>Rp
                                                            {{ number_format($product->price, 2, ',', '.') }}</strong>
                                                    </h5>
                                                </div>
                                            @endif
                                            <div class="d-flex align-items-center gap-1 mt-1">
                                                <i class="bi bi-star-fill"
                                                    style="color: #ffd900; font-size: 10px;"></i>
                                                <span style="font-size: 10px;">{{ $product->rate }}</span>
                                                <div class="low-divider-black"
                                                    style="width: 1px; background-color: black; height: 10px;">
                                                </div>
                                                <span style="font-size: 10px;">10 Terjual</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="{{ asset('/ourjs/cart.js') }}" data-navigate-track></script>