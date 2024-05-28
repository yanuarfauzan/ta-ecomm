<div class="container d-flex justify-content-between gap-4" style="width: 100%; height: 100%">
    <div class="d-flex flex-column gap-2" style="width: 70%; height: 100%;">
        <div id="head-cart"
            class="bg-main-color d-flex justify-content-start px-4 align-items-center shadow-sm gap-4 text-white"
            style="width: 100%; height: 50px;">
            <span class="d-inline-block" style="width: 33%;"><strong>Order list</strong></span>
        </div>
        <div class="card-product card-all-check d-flex justify-content-between px-4 py-4 align-items-center shadow-sm gap-4"
        style="width: 100%; background-color: white" id="card-product">
        <div class="d-flex flex-column" style="width: 100%; height: 100%">
                <h5><strong>Alamat pengiriman</strong></h5>
                <span class="mt-2"><strong>{{ $defaultUserAdress->recipient_name }}</strong> {{ $defaultUserAdress->phone_number }}</span>
                <span><i class="bi bi-geo-alt"></i> {{ $defaultUserAdress->address }} - ({{ $defaultUserAdress->detail }})</span>
                <div class="d-flex justify-content-end mt-2">
                    <button id="checkout" class="btn rounded-0 bg-main-color text-white" data-bs-toggle="modal"
                    data-bs-target="#modalAddress"
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
                            <span> 
                                @if (isset($productBuyNow->discount))
                                <i class="bi bi-info-circle-fill me-1" style="cursor: pointer" data-bs-toggle="tooltip" data-bs-title="harga setelah diskon"></i>
                                @endif
                                {{ $count }} x Rp
                                {{ number_format($productBuyNow->price_after_dsicount, 2, ',', '.') }}</span>
                            <span><strong>
                                    <h4>Rp {{ number_format($subTotal, 2, ',', '.') }}
                                    </h4>
                                </strong></span>
                        </div>
                    @else
                        <div class="d-flex flex-column align-items-end">
                            <span>{{ $count }} x Rp
                                {{ number_format($productBuyNow->price, 2, ',', '.') }}</span>
                            <span><strong>
                                    <h4>Rp {{ number_format($subTotal, 2, ',', '.') }}</h4>
                                </strong></span>
                        </div>
                    @endif
                </div>
                <div class="d-flex justify-content-between align-items-center gap-2" style="width: 100%;">
                    <div class="d-flex justify-content-start gap-2 align-items-center" style="width: 100%">
                        <span for="note" class="bg-main-color px-3 text-white text-center"
                            style="padding-top: 12px; padding-bottom: 12px;">pesan:
                        </span>
                        <input wire:model.lazy="note" type="text" class="form-control rounded-0" id="note"
                            name="note" placeholder="tuliskan pesan anda disini"
                            style="box-shadow: none; width: 100%; height: 50px;">
                    </div>
                </div>
                @livewire('NoteAndShippingMethod', ['product' => $productBuyNow, 'order' => $order, 'userCarts' => $usersCarts, 'productVoucher' => $productVoucher])
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
                                    {{ number_format($product->price_after_dsicount, 2, ',', '.') }}</span>
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
                <div class="d-flex justify-content-between align-items-center gap-2" style="width: 100%;">
                    <div class="d-flex justify-content-start gap-2 align-items-center" style="width: 100%">
                        <span for="note" class="bg-main-color px-3 text-white text-center"
                            style="padding-top: 12px; padding-bottom: 12px;">pesan:
                        </span>
                        <input wire:model.lazy="note" type="text" class="form-control rounded-0" id="note"
                            name="note" placeholder="tuliskan pesan anda disini"
                            style="box-shadow: none; width: 100%; height: 50px;">
                    </div>
                </div>
                @livewire('NoteAndShippingMethod', ['product' => $product, 'order' => $order, 'userCarts' => $usersCarts, 'productVoucher' => $productVoucher])
            </div>
        @endif
    </div>
    <div class="d-flex flex-column align-items-start gap-2" style="width: 30%; height: auto;">
        <div class="shadow-sm card-summary bg-light" style="width: 100%; height: auto">
            <div class="container d-flex flex-column py-4 px-4 gap-2" style="width: 100%; height: auto">
                <span>
                    <strong class="font-main-color">
                        <h5>Shopping Summary</h5>
                    </strong>
                </span>
                <div class="d-flex justify-content-between align-items-center">
                    <div class="d-flex flex-column align-items-start">
                        <span><strong>Subtotal</strong></span>
                        <span><strong>Ongkos kirim</strong></span>
                        @if (isset($voucherValue))
                        <span><strong>Voucher</strong></span>
                        @endif
                    </div>
                    <div class="d-flex flex-column align-items-start">
                        <span class="ms-3"><strong>Rp {{ number_format($subTotal, 2, ',', '.') }}</strong></span>
                        <span><strong>+ Rp {{ number_format($costValue, 2, ',', '.') }}</strong></span>
                        @if (isset($voucherValue))
                            <span class="ms-1"><strong>- Rp {{ number_format($voucherValue, 2, ',', '.') }}</strong></span>
                        @endif
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
    <div class="modal fade" style="top: 10%" id="modalAddress" tabindex="-1"
        aria-labelledby="modalAddressLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content rounded-0">
                <span class="mt-4 mx-4" ><strong>Pilihan Alamat</strong></span>
                <hr>
                <div class="modal-body" >
                    @foreach ($userAddresses as $address)
                    <div class="d-flex justify-content-between align-items-center gap-2 mx-2">
                    <div>
                        <input wire:click="changeAddress('{{ $address->id }}')" {{ $address->is_default == true ? 'checked' : '' }}
                        class="form-check-input me-1" type="radio" value="" id="checkbox-address" name="checkbox-address" data-bs-dismiss="modal" aria-label="Close">
                    </div>
                        <div class="d-flex flex-column justify-content-start align-items-start mt-1">
                        <div class="d-flex justify-content-start align-items-center gap-2">
                            <span><strong>{{ $address->recipient_name }}</strong></span>
                            <span>{{ $address->phone_number }}</span>
                        </div>
                        <div>
                            <span>{{ $address->address }} {{ $address->detail }}</span>
                        </div>
                        @if($address->is_default == true)
                        <div>
                            <span class="font-main-color px-1" style="border: 1px solid #6777ef">
                                Utama
                            </span>
                        </div>
                        @endif
                    </div>
                    <div>
                        <span class="font-main-color">Ubah</span>
                    </div>
                </div>
                <hr>
                    @endforeach
                </div>
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
                snap.pay(snapToken[0].snapToken, {
                    onSuccess: function(result) {
                        document.getElementById('result-json').innerHTML += JSON
                            .stringify(result, null, 2);
                    },
                    onPending: function(result) {
                        document.getElementById('result-json').innerHTML += JSON
                            .stringify(result, null, 2);
                    },
                    onError: function(result) {
                        document.getElementById('result-json').innerHTML += JSON
                            .stringify(result, null, 2);
                    }
                });
            };
        })

    })
</script>
