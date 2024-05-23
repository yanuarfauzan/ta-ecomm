<div class="container d-flex justify-content-between gap-4" style="width: 100%; height: 100%">
    <div class="d-flex flex-column gap-2" style="width: 70%; height: 100%;">
        <div id="head-cart"
            class="bg-main-color d-flex justify-content-start px-4 align-items-center shadow-sm gap-4 text-white"
            style="width: 100%; height: 50px;">
            <span class="d-inline-block" style="width: 33%;"><strong>Order list</strong></span>
        </div>
        <div class="card-product card-all-check d-flex justify-content-between px-4 py-4 align-items-center shadow-sm gap-4"
            style="width: 100%; background-color: white" id="card-product">
            <div class="d-flex flex-column gap" style="width: 100%; height: 100%">
                <h5><strong>Alamat pengiriman</strong></h5>
                <span><i class="bi bi-geo-alt"></i> {{ $defaultUserAdress->address }},
                    {{ $user->phone_number }}</span>
                <div class="d-flex justify-content-end mt-2">
                    <button id="checkout" class="btn rounded-0 bg-main-color text-white"
                        style="width: 20%;"><strong>ganti alamat</strong></button>
                </div>
            </div>
        </div>
        @if ($productBuyNow != [])
            <div class="card-product card-all-check d-flex flex-column px-4 py-4 align-items-start shadow-sm gap-2"
                style="width: 100%; background-color: white">
                    <div class="card-product px-2 py-2 d-flex justify-content-between align-items-center"
                        style="width: 100%;">
                        <div class="d-flex justify-content-start align-items-center gap-4 position-relative">
                            <img src="{{ Storage::url('public/product_pictures/' . $productBuyNow->hasImages->first()->filepath_image) }}"
                                alt="" style="width: 80px; height: 80px;">
                            <span style="width: 150px">
                                <h4>{{ $productBuyNow->name }}</h4>
                            </span>
                        </div>
                        <div class="d-flex justify-content-start align-items-center gap-2 variation-container">
                            @foreach ($variationBuyNow as $variationOption)
                                <img src="{{ Storage::url('public/product_pictures/' . $variationOption->productImage->filepath_image) }}"
                                    alt="" class="variation-image">
                            @endforeach
                            <h4 class="variation-options">
                                @foreach ($variationBuyNow as $variationOption)
                                    {{ $variationOption->name }}{{ $loop->last ? '' : ',' }}
                                @endforeach
                            </h4>
                        </div>
                        @if (isset($productBuyNow->discount))
                            <div class="d-flex flex-column align-items-end">
                                <span>{{ $count }} x Rp
                                    {{ number_format($productBuyNow->price_after_dsicount, 2, ',', '.') }}</span>
                                <span><strong>
                                        <h4>Rp {{ number_format($productBuyNow->price_after_dsicount, 2, ',', '.') }}
                                        </h4>
                                    </strong></span>
                            </div>
                        @else
                            <div class="d-flex flex-column align-items-end">
                                <span>{{ $count }} x Rp
                                    {{ number_format($productBuyNow->price, 2, ',', '.') }}</span>
                                <span><strong>
                                        <h4>Rp {{ number_format($productBuyNow->price, 2, ',', '.') }}</h4>
                                    </strong></span>
                            </div>
                        @endif
                    </div>
                @livewire('NoteAndShippingMethod', ['product' => $productBuyNow, 'order' => $order, 'userCarts' => $usersCarts])
            </div>
        @else
            <div class="card-product card-all-check d-flex flex-column px-4 py-4 align-items-start shadow-sm gap-2"
                style="width: 100%; background-color: white">
                @foreach ($usersCarts as $index => $userCarts)
                    @php
                        $product = $userCarts?->hasProduct->first();
                        $variation = $product?->variation->first();
                    @endphp
                    <div class="card-product px-2 py-2 d-flex justify-content-between align-items-center"
                        style="width: 100%;">
                        <div class="d-flex justify-content-start align-items-center gap-4 position-relative">
                            <img src="{{ Storage::url('public/product_pictures/' . $product->hasImages->first()->filepath_image) }}"
                                alt="" style="width: 80px; height: 80px;">
                            <span style="width: 150px">
                                <h4>{{ $product->name }}</h4>
                            </span>
                        </div>
                        <div class="d-flex justify-content-start align-items-center gap-2 variation-container">
                            <span class="variation-options">
                                @foreach ($product->pickedVariationOption as $variationOption)
                                    {{ $variationOption->name }}{{ $loop->last ? '' : ',' }}
                                @endforeach
                            </span>
                        </div>
                        @if (isset($product->discount))
                            <div class="d-flex flex-column align-items-end">
                                <span>{{ $userCarts->qty }} x Rp
                                    {{ number_format($product->price_after_discount, 2, ',', '.') }}</span>
                                <span><strong>
                                        <h4>Rp {{ number_format($userCarts->total_price_after_discount, 2, ',', '.') }}
                                        </h4>
                                    </strong></span>
                            </div>
                        @else
                            <div class="d-flex flex-column align-items-end">
                                <span>{{ $userCarts->qty }} x Rp
                                    {{ number_format($product->price, 2, ',', '.') }}</span>
                                <span><strong>
                                        <h4>Rp {{ number_format($userCarts->total_price, 2, ',', '.') }}</h4>
                                    </strong></span>
                            </div>
                        @endif
                    </div>
                @endforeach
                @livewire('NoteAndShippingMethod', ['product' => $product, 'order' => $order, 'userCarts' => $usersCarts])
            </div>
        @endif
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
                        <span><strong>Ongkos kirim</strong></span>
                    </div>
                    <div class="d-flex flex-column align-items-start">
                        <span><strong>Rp {{ number_format($subTotal, 2, ',', '.') }}</strong></span>
                        <span><strong>Rp {{ number_format($costValue, 2, ',', '.') }}</strong></span>
                    </div>
                </div>
                <hr class="border border-secondary bg-main-color opacity-50">
                <div class="d-flex justify-content-between align-items-center">
                    <span><strong>Total :</strong></span>
                    <span><strong>Rp {{ number_format($totalPrice, 2, ',', '.') }}</strong></span>
                </div>
                <button id="checkout-payment" class="btn rounded-0 mt-3 bg-main-color text-white"
                    style="width: 100%;"><strong>Pay</strong></button>
            </div>
        </div>
    </div>
</div>
<script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ env('MIDTRANS_CLIENT_KEY') }}"
    data-navigate-track></script>
<script type="text/javascript" data-navigate-track>
    document.addEventListener('livewire:init', function() {
        Livewire.on('snapTokenGenerated', snapToken => {
            document.getElementById('checkout-payment').onclick = function() {
                console.log('snap');
                // SnapToken acquired from previous step
                snap.pay(snapToken[0].snapToken, {
                    // Optional
                    onSuccess: function(result) {
                        /* You may add your own js here, this is just example */
                        document.getElementById('result-json').innerHTML += JSON
                            .stringify(result, null, 2);
                    },
                    // Optional
                    onPending: function(result) {
                        /* You may add your own js here, this is just example */
                        document.getElementById('result-json').innerHTML += JSON
                            .stringify(result, null, 2);
                    },
                    // Optional
                    onError: function(result) {
                        /* You may add your own js here, this is just example */
                        document.getElementById('result-json').innerHTML += JSON
                            .stringify(result, null, 2);
                    }
                });
            };
        })

    })
</script>
