<div class="container d-flex justify-content-between gap-4" style="width: 100%; height: 100%">
    <div class="d-flex flex-column gap-2" style="width: 70%; height: 100%;">
        <div id="head-cart"
            class="bg-main-color d-flex justify-content-start px-4 align-items-center shadow-sm gap-4 text-white"
            style="width: 100%; height: 50px;">
            <span class="d-inline-block" style="width: 33%;"><strong>Daftar pesanan</strong></span>
        </div>
        <div class="card-product card-all-check d-flex justify-content-between px-4 py-4 align-items-center shadow-sm gap-4"
            style="width: 100%; background-color: white" id="card-product">
            <div class="d-flex flex-column" style="width: 100%; height: 100%">
                <h5><strong>Alamat pengiriman</strong></h5>
                <span class="mt-2"><strong>{{ $defaultUserAdress->recipient_name }}</strong>
                    {{ $defaultUserAdress->phone_number }}</span>
                <span><i class="bi bi-geo-alt"></i> {{ $defaultUserAdress->address }} -
                    ({{ $defaultUserAdress->detail }})</span>
                <div class="d-flex justify-content-end mt-2">
                    <button id="checkout" class="btn rounded-0 bg-main-color text-white" data-bs-toggle="modal"
                        data-bs-target="#modalAddress" style="width: 20%;"><strong>ganti alamat</strong></button>
                </div>
            </div>
        </div>
        @if ($productBuyNow != [])
            <div class="card-product card-all-check d-flex flex-column px-4 py-4 align-items-start shadow-sm gap-2"
                style="width: 100%; background-color: white">
                <div class="card-product px-2 py-2 d-flex justify-content-between align-items-center"
                    style="width: 100%; height: 120px;">
                    <div class="d-flex justify-content-start align-items-center gap-4 position-relative">
                        <img src="{{ Storage::url($variationBuyNow->whereNotNull('product_image_id')->first()->productImage->filepath_image) }}"
                            alt="" style="width: 80px; height: 80px;">
                        <span style="width: 150px">
                            <h5>{{ $productBuyNow->name }}</h5>
                        </span>
                    </div>
                    <div class="d-flex justify-content-start align-items-center gap-2 variation-container">
                        <h4 class="variation-options">
                            @foreach ($variationBuyNow as $variationOption)
                                {{ $variationOption->name }}{{ $loop->last ? '' : ',' }}
                            @endforeach
                        </h4>
                    </div>
                    @if (isset($productBuyNow->discount))
                        <div class="d-flex flex-column align-items-end">
                            <span>
                                <i class="bi bi-info-circle-fill me-1" style="cursor: pointer" data-bs-toggle="tooltip"
                                    data-bs-title="harga setelah diskon"></i>
                                {{ $count }} x Rp
                                {{ number_format($productBuyNow->price_after_dsicount, 2, ',', '.') }}
                            </span>
                            <span><strong>
                                    <h4>Rp {{ number_format($subTotal, 2, ',', '.') }}
                                    </h4>
                                </strong></span>
                        </div>
                    @else
                        <div class="d-flex flex-column align-items-end">
                            <span>{{ $count }} x Rp
                                {{ number_format($productBuyNow->price_after_additional, 2, ',', '.') }}</span>
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
                @livewire('NoteAndShippingMethod', ['product' => $productBuyNow, 'order' => $order, 'userCarts' => $usersCarts, 'productVoucher' => $productVoucher, 'subTotal' => $subTotal])
            </div>
        @else
            <div class="card-product card-all-check d-flex flex-column px-4 py-4 align-items-start shadow-sm gap-2"
                style="width: 100%;  background-color: white">
                @foreach ($usersCarts as $index => $userCarts)
                    @php
                        $product = $userCarts?->hasProduct->first();
                        $variation = $product?->variation->first();
                    @endphp
                    <div class="card-product px-2 py-2 d-flex justify-content-between align-items-center"
                        style="width: 100%; height: 120px;">
                        <div class="d-flex justify-content-start align-items-center gap-4 position-relative">
                            <img src="{{ Storage::url($product->pickedVariationOption->whereNotNull('product_image_id')->first()->productImage->filepath_image) }}"
                                alt="" style="width: 80px; height: 80px;">
                            <span style="width: 150px">
                                <h5>{{ $product->name }}</h5>
                            </span>
                        </div>
                        <div class="d-flex justify-content-start align-items-center gap-2 variation-container">
                            <span class="variation-options">
                                @foreach ($userCarts->pickedVariation as $variation)
                                    {{ $variation->variationOption->name }}{{ !$loop->last ? ',' : '' }}
                                @endforeach
                            </span>
                        </div>
                        @php
                            $variationOptionId1 = $userCarts->pickedVariation[0]->variationOption->id;
                            $variationOptionId2 = $userCarts->pickedVariation[1]->variationOption->id;

                            $mergeVarOption = \App\Models\MergeVariationOption::where([
                                ['variation_option_1_id', $variationOptionId1],
                                ['variation_option_2_id', $variationOptionId2],
                            ])->first();
                        @endphp
                        @if (isset($product->discount))
                            <div class="d-flex flex-column align-items-end">
                                <span>
                                    <i class="bi bi-info-circle-fill me-1" style="cursor: pointer"
                                        data-bs-toggle="tooltip" data-bs-title="harga setelah diskon"></i>
                                    {{ $userCarts->qty }} x Rp
                                    {{ number_format($mergeVarOption->merge_price_after_discount, 2, ',', '.') }}</span>
                                <span><strong>
                                        <h4>Rp {{ number_format($userCarts->total_price_after_discount, 2, ',', '.') }}
                                        </h4>
                                    </strong></span>
                            </div>
                        @else
                            <div class="d-flex flex-column align-items-end">
                                <span>{{ $userCarts->qty }} x Rp
                                    {{ number_format($mergeVarOption->merge_price, 2, ',', '.') }}</span>
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
                @livewire('NoteAndShippingMethod', ['product' => $product, 'order' => $order, 'userCarts' => $usersCarts, 'productVoucher' => $productVoucher, 'subTotal' => $subTotal])
            </div>
        @endif
    </div>
    <div class="d-flex flex-column align-items-start gap-2" style="width: 30%; height: auto;">
        <div class="shadow-sm card-summary bg-light" style="width: 100%; height: auto">
            <div class="container d-flex flex-column py-4 px-4 gap-2" style="width: 100%; height: auto">
                <span>
                    <strong class="font-main-color">
                        <h5>Detail pemesanan</h5>
                    </strong>
                </span>
                <div class="d-flex justify-content-between align-items-center">
                    <div class="d-flex flex-column align-items-start">
                        <span>Subtotal</span>
                        <span>Ongkos kirim</span>
                        @if (isset($voucherValue))
                            <span>Voucher</span>
                        @endif
                    </div>
                    <div class="d-flex flex-column align-items-start">
                        <span class="ms-3"><strong>Rp {{ number_format($subTotal, 2, ',', '.') }}</strong></span>
                        <span><strong>+ Rp {{ number_format($costValue, 2, ',', '.') }}</strong></span>
                        @if (isset($voucherValue))
                            <span class="ms-1"><strong>- Rp
                                    {{ number_format($voucherValue, 2, ',', '.') }}</strong></span>
                        @endif
                    </div>
                </div>
                <hr class="border border-secondary bg-main-color opacity-50">
                <div class="d-flex justify-content-between align-items-center">
                    <span>Total :</span>
                    <span><strong>Rp {{ number_format($totalPrice, 2, ',', '.') }}</strong></span>
                </div>
                <button id="checkout-payment" class="btn rounded-0 mt-3 bg-main-color text-white"
                    style="width: 100%;"><strong>Bayar</strong></button>
            </div>
        </div>
    </div>
    <div wire:ignore.self class="modal fade" style="top: 10%" id="modalAddress" tabindex="-1"
        aria-labelledby="modalAddressLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content rounded-0">
                <span class="mt-4 mx-4"><strong>Pilihan Alamat</strong></span>
                <hr>
                <div class="modal-body">
                    @foreach ($userAddresses as $address)
                        <div class="d-flex justify-content-between align-items-center gap-2 mx-2">
                            <div>
                                <input wire:click="changeAddress('{{ $address->id }}')"
                                    {{ $address->is_default == true ? 'checked' : '' }} class="form-check-input me-1"
                                    type="radio" value="" id="checkbox-address" name="checkbox-address"
                                    data-bs-dismiss="modal" aria-label="Close">
                            </div>
                            <div class="d-flex flex-column justify-content-start align-items-start mt-1">
                                <div class="d-flex justify-content-start align-items-center gap-2">
                                    <span><strong>{{ $address->recipient_name }}</strong></span>
                                    <span>{{ $address->phone_number }}</span>
                                </div>
                                <div>
                                    <span>{{ $address->address }} {{ $address->detail }}</span>
                                </div>
                                @if ($address->is_default == true)
                                    <div>
                                        <span class="font-main-color px-1" style="border: 1px solid #6777ef">
                                            Utama
                                        </span>
                                    </div>
                                @endif
                            </div>
                            <div>
                                <button class="bg-main-color border-0 text-white"
                                    wire:click="editAddress('{{ $address->id }}')" data-bs-toggle="modal"
                                    data-bs-target="#changeAddress-{{ $address->id }}">Ubah</button>
                            </div>
                        </div>
                        <hr>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    @foreach ($userAddresses as $address)
        <div wire:ignore.self class="modal fade" id="changeAddress-{{ $address->id }}" tabindex="-1"
            aria-labelledby="changeAddress" aria-hidden="true" wire:key="modal-{{ $address->id }}">
            <div class="modal-dialog">
                <div class="modal-content rounded-0">
                    <span class="mt-4 mx-4"><strong>Ubah Alamat</strong></span>
                    <hr>
                    <div class="modal-body">
                        <form wire:submit.prevent="updateAddress('{{ $address->id }}')">
                            <div class="mt-2">
                                <label for="recepient_name">Nama penerima</label>
                                <input type="text" class="form-control rounded-0 mt-2" id="username"
                                    name="recepient_name" wire:model="recipient_name"
                                    style="box-shadow: none; width: 100%; height: 50px;" required>
                                @error('recipientName')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="">
                                <label for="address">Alamat lengkap</label>
                                <textarea type="text" class="form-control rounded-0 mt-2" id="address" name="address" wire:model="address"
                                    style="box-shadow: none; width: 100%; height: 50px;" required></textarea>
                            </div>
                            <div class="mt-2">
                                <label for="province">Provinsi</label>
                                <select class="form-select form-select-lg rounded-0" aria-label="Large select example"
                                    id="province" wire:model="province" name="province" required>
                                    <option value="">pilih provinsi</option>
                                    @foreach ($provincies as $key => $value)
                                        <option value="{{ $value }}" wire:key="province-{{ $key }}"
                                            {{ $province == $address->province ? 'selected' : '' }}>
                                            {{ $value }}</option>
                                    @endforeach
                                </select>
                                @error('province')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mt-2">
                                <label for="province">Kota</label>
                                <select class="form-select form-select-lg rounded-0" aria-label="Large select example"
                                    id="city" wire:model="city" name="city" required>
                                    <option value="">pilih kota</option>
                                    @foreach ($cities as $key => $value)
                                        <option value="{{ $value }}" wire:key="city-{{ $key }}"
                                            {{ $city == $address->city ? 'selected' : '' }}>{{ $value }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('city')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mt-2">
                                <label for="detail">Detail</label>
                                <input type="text" class="form-control rounded-0 mt-2" id="username"
                                    name="detail" wire:model="detail"
                                    style="box-shadow: none; width: 100%; height: 50px;" required>
                                @error('detail')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mt-2">
                                <label for="postal_code">Kode pos</label>
                                <input type="text" class="form-control rounded-0 mt-2" id="username"
                                    name="postal_code" wire:model="postal_code"
                                    style="box-shadow: none; width: 100%; height: 50px;" required>
                                @error('postal_code')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="d-flex justify-content-end align-items-center gap-2 mt-4 me-4 mb-4">
                                <button class="btn rounded-0 bg-danger text-white" style="width: 20%;"
                                    data-bs-toggle="modal"
                                    data-bs-target="#modalAddress"><strong>kembali</strong></button>
                                <button type="submit" id="checkout" class="btn rounded-0 bg-main-color text-white"
                                    style="width: 20%;" data-bs-toggle="modal"
                                    data-bs-target="#modalAddress"><strong>ubah</strong></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div>
</div>
<script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ env('MIDTRANS_CLIENT_KEY') }}"
    data-navigate-track></script>
<script type="text/javascript" data-navigate-track>
    document.addEventListener('livewire:init', function() {
        Livewire.on('snapTokenGenerated', snapToken => {
            document.getElementById('checkout-payment').onclick = function() {
                snap.pay(snapToken[0].snapToken, {
                    onSuccess: function(result) {
                        window.location.href =
                            "{{ route('after-payment', ['order_id' => $order->order_number]) }}"
                    },
                    onPending: function(result) {
                        fetch("{{ route('after-payment', ['order_id' => $order->order_number]) }}", {
                                method: 'GET'
                            })
                            .then(response => {
                                if (!response.ok) {
                                    throw new Error('Network response was not ok');
                                }
                                return response.json();
                            })
                            .then(data => {
                                console.log(data);
                            })
                            .catch(error => {
                                console.error(
                                    'There has been a problem with your fetch operation:',
                                    error);
                            });

                    },
                    onError: function(result) {
                        fetch("{{ route('after-payment', ['order_id' => $order->order_number]) }}", {
                                method: 'GET'
                            })
                            .then(response => {
                                if (!response.ok) {
                                    throw new Error('Network response was not ok');
                                }
                                return response.json();
                            })
                            .then(data => {
                                console.log(data);
                            })
                            .catch(error => {
                                console.error(
                                    'There has been a problem with your fetch operation:',
                                    error);
                            });
                    }
                });
            };
        })

    })
</script>
