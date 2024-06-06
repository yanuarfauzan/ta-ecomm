<div class="container" style="width: 100%; height: 100%">
    <div class="card-product d-flex flex-column" style="width: 100%; height: 100%;">
        <div class="" id="bio" role="tabpanel" aria-labelledby="bio-tab">
            <div class="d-flex justify-content-center align-items-top gap-2 mx-4 mb-4">
                <div style="width: 50%; height: auto;">
                    <div class="d-flex justify-content-between align-items-top gap-2">
                        <div class="d-flex flex-column justify-content-between align-items-center gap-2 ms-4 my-4"
                            style="width: 50%;">
                            <div class="" style="width: 100%; height: 250px;">
                                <img src="{{ Storage::url('public/profile_pictures/' . $user->profile_image) }}"
                                    alt="" style="width: 100%; height: 100%">
                            </div>
                            <div class="card-product d-flex justify-content-center align-items-center"
                                style="cursor: pointer; width: 100%; height: 50px;">
                                <span style="cursor: pointer;"
                                    onclick="document.getElementById('profileImage').click()">
                                    <h5 class="">Change photo</h5>
                                </span>
                                <input type="file" wire:model.lazy="profileImage" id="profileImage" name="file"
                                    style="display: none;">
                            </div>
                            <div class="" style="width: 100%; height: 50px;">
                                <span style="cursor: pointer;">
                                    <button role="button" class="btn rounded-0 bg-main-color text-white"
                                        data-bs-toggle="modal" data-bs-target="#changePassword"
                                        style="width: 100%; height: 50px;"><strong>Change Password</strong></button>
                                </span>
                            </div>
                        </div>
                        <div class="d-flex flex-column justify-content-start align-items-center gap-3 me-4 mb-4 mt-5"
                            style="width: 50%;">
                            <div class="input-group" style="height: 55px">
                                <input wire:model.lazy="username" type="text" class="form-control rounded-0"
                                    id="username" name="username" style="box-shadow: none; width: 100%; height: 40px;">
                            </div>
                            <div class="input-group" style="height: 55px">
                                <input wire:model.lazy="birtdate" type="text" class="form-control rounded-0"
                                    id="email" name="birth_of_date"
                                    style="box-shadow: none; width: 100%; height: 40px;">
                            </div>
                            <div class="d-flex flex-column">
                                <div class="d-flex justify-content-center gap-4 align-items-center input-group"
                                    style="height: 55px">
                                    <div class="form-check d-flex justify-content-start gap-2 align-items-center">
                                        <input wire:model.lazy="gender1" class="form-check-input" type="radio"
                                            value="1" name="gender" id="flexRadioDefault1">
                                        <label class="form-check-label" for="flexRadioDefault1">
                                            Laki-laki
                                        </label>
                                    </div>
                                    <div class="form-check d-flex justify-content-start gap-2 align-items-center">
                                        <input wire:model.lazy="gender2" class="form-check-input" type="radio"
                                            value="0" name="gender" id="flexRadioDefault2" checked>
                                        <label class="form-check-label" for="flexRadioDefault2">
                                            Perempuan
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="input-group" style="height: 55px">
                                <input wire:model="email" type="email" class="form-control rounded-0"
                                    id="no_handphone" style="box-shadow: none; width: 100%; height: 40px;" disabled>
                            </div>
                            <div class="input-group" style="height: 55px">
                                <input wire:model="phoneNumber" type="number" class="form-control rounded-0"
                                    id="no_handphone" style="box-shadow: none; width: 100%; height: 40px;" disabled>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-product mt-4 d-flex flex-column justify-content-center align-items-center"
                    style="width: 50%; height: auto;">
                    <div class="d-flex justify-content-between align-items-center w-100 mt-2 mb-1">
                        <span>
                            <h6 class="mt-2 ms-3"><strong>Alamat</strong></h6>
                        </span>
                        <button id="checkout"
                            class="btn rounded-0 bg-main-color text-white d-flex justify-content-center align-items-center mt-2 me-4"
                            data-bs-toggle="modal" data-bs-target="#addAddress" style="width: 28%; height: 30px;">tambah
                            alamat</button>
                    </div>
                    <div class="d-flex flex-column justify-content-start align-items-center pb-4"
                        style="overflow-y: scroll; height: 350px;">
                        @foreach ($addresses as $address)
                            <div class="card-product p-2 d-flex flex-column justify-content-start align-items-start"
                                style="width: 95%; height: auto; margin-top: 20px;">
                                <span><strong>{{ $address->recipient_name }}</strong>
                                    {{ $address->phone_number }}</span>
                                <span><i class="bi bi-geo-alt"></i>{{ $address->address }} -
                                    {{ $address->detail }}</span>
                                <div class="d-flex justify-content-end mt-2 w-100 gap-2">
                                    <button
                                        class="btn rounded-0 bg-danger text-white d-flex justify-content-center align-items-center"
                                        wire:click="deleteAddress('{{ $address->id }}')"
                                        style="width: 30%; height: 30px;">hapus</button>
                                    <button
                                        class="btn rounded-0 bg-main-color text-white d-flex justify-content-center align-items-center"
                                        wire:click="editAddress('{{ $address->id }}')" data-bs-toggle="modal"
                                        data-bs-target="#changeAddress-{{ $address->id }}"
                                        style="width: 30%; height: 30px;">edit alamat</button>
                                </div>
                            </div>
                        @endforeach
                    </div>

                </div>
            </div>
        </div>
        <div class="" id="order" role="tabpanel" aria-labelledby="order-tab">
            <div wire:ignore.self class="d-flex justify-content-start align-items-top">
                <div class="d-flex flex-column justify-content-center align-items-center gap-2 mx-4 mb-4 w-100"
                    style="width: 100%; height: 100%">
                    <ul class="nav nav-tabs d-flex justify-content-evenly align-items-center" style="width: 50%" id="orderTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <a class="nav-link {{ $tabActive == 'pending' ? 'active text-dark' : 'text-dark' }}" id="unpaid-tab" data-bs-toggle="tab"
                                href="#unpaid" role="tab" aria-controls="unpaid" aria-selected="false">Belum Bayar</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link {{ $tabActive == 'packed' ? 'active text-dark' : 'text-dark' }}" id="packed-tab" data-bs-toggle="tab" href="#packed"
                                role="tab" aria-controls="packed" aria-selected="false">Dikemas</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link {{ $tabActive == 'shipped' ? 'active text-dark' : 'text-dark' }}" id="delivered-tab" data-bs-toggle="tab" href="#delivered"
                                role="tab" aria-controls="delivered" aria-selected="false">Dikirim</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link {{ $tabActive == 'completed' ? 'show active text-dark' : 'text-dark' }}" id="completed-tab" data-bs-toggle="tab" href="#completed"
                                role="tab" aria-controls="completed" aria-selected="false">Selesai</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link {{ $tabActive == 'cancelled' ? 'active text-dark' : 'text-dark' }}" id="cancelled-tab" data-bs-toggle="tab" href="#cancelled"
                                role="tab" aria-controls="cancelled" aria-selected="false">Dibatalkan</a>
                        </li>
                    </ul>
                    
                    <div class="tab-content" id="orderTabContent" style="width: 100%">
                        {{-- unpaid --}}
                        <div class="tab-pane {{ $tabActive == 'pending' ? 'show active' : '' }} fade w-100" id="unpaid" role="tabpanel"
                            aria-labelledby="unpaid-tab">
                            <!-- Content for Belum Bayar -->
                            <div class="d-flex flex-column justify-content-start gap-2 w-100">
                                @if (!$pendingOrders->isEmpty())
                                    @foreach ($pendingOrders as $order)
                                        <div
                                            class="card-product d-flex flex-column justify-content-between px-4 align-items-center shadow-sm">
                                            <div class="d-flex justify-content-between align-items-center w-100 my-2">
                                                <span class="text-danger">belum bayar</span>
                                                <button id="pay-{{ $order->id }}"
                                                    class="btn rounded-0 bg-main-color text-white d-flex justify-content-center align-items-center mt-1"
                                                    style="width: 10%; height: 30px;">bayar</button>
                                            </div>
                                            @if ($order->cartProduct && count($order->cartProduct) > 0)
                                                @foreach ($order->cartProduct as $cartProduct)
                                                    <div class="card-all-check d-flex justify-content-between align-items-center gap-4 mb-4"
                                                        style="width: 100%; height: auto; background-color: white"
                                                        id="card-product-PRODUCT_ID">
                                                        <div class="d-flex justify-content-start align-items-center gap-2 pe-2"
                                                            style="width: 30%;">
                                                            <img src="{{ Storage::url('public/product_pictures/' . $cartProduct->product->hasImages()->first()->filepath_image) }}"
                                                                alt="" style="width: 80px; height: 80px;">
                                                            <div class="d-flex justify-content-between"
                                                                style="width: auto; height: auto;">
                                                                <div class="d-flex flex-column align-items-start position-relative gap-0"
                                                                    style="width: 200px; height: auto;">
                                                                    <strong
                                                                        class="font-main-color">{{ $cartProduct->product->name }}</strong>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="d-flex justify-content-between"
                                                            style="width: auto; height: auto;">
                                                            <div class="d-flex flex-column align-items-start position-relative gap-0"
                                                                style="width: 200px; height: auto;">
                                                                <span>
                                                                    @foreach ($cartProduct->cart->pickedVariation as $variation)
                                                                        {{ $variation->variationOption->name }}{{ $loop->last ? '' : ',' }}
                                                                    @endforeach
                                                                </span>
                                                            </div>
                                                        </div>
                                                        <div class="d-flex flex-column justify-content-center align-items-center me-2"
                                                            style="width: 30%;">
                                                            <span><strong>Rp
                                                                    {{ number_format($cartProduct->product->price_after_additional, 2, ',', '.') }}
                                                                    x
                                                                    {{ $cartProduct->product->cart->first()->qty }}</strong></span>
                                                        </div>
                                                        <div class="d-flex flex-column justify-content-end align-items-end gap-2 px-2"
                                                            style="width: 30%">
                                                            <span>sub total :</span>
                                                            <span><strong>Rp
                                                                    {{ number_format($cartProduct->product->cart->first()->total_price, 2, ',', '.') }}</strong></span>
                                                        </div>
                                                    </div>
                                                @endforeach
                                                <div class="d-flex justify-content-end align-items-center w-100 mb-2">
                                                    <div
                                                        class="d-flex flex-column justify-content-start align-items-end me-1">
                                                        <span>total :</span>
                                                        <span><strong>Rp
                                                                {{ number_format($order->total_price, 2, ',', '.') }}</strong></span>
                                                    </div>
                                                </div>
                                            @else
                                                <div class="card-all-check d-flex justify-content-between align-items-center gap-4 mb-4"
                                                    style="width: 100%; height: auto; background-color: white"
                                                    id="card-product-PRODUCT_ID">
                                                    <div class="d-flex justify-content-start align-items-center gap-2 pe-2"
                                                        style="width: 30%;">
                                                        <img src="{{ Storage::url('public/product_pictures/' . $order->product->hasImages()->first()->filepath_image) }}"
                                                            alt="" style="width: 80px; height: 80px;">
                                                        <div wire:ignore
                                                            class="d-flex position-relative justify-content-between"
                                                            style="width: auto; height: auto;">
                                                            <div class="d-flex flex-column align-items-start position-relative gap-0"
                                                                style="width: 200px; height: auto;">
                                                                <strong
                                                                    class="font-main-color">{{ $order->product->name }}</strong>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="d-flex flex-column align-items-start position-relative gap-0"
                                                        style="width: 200px; height: auto;">
                                                        <span>
                                                            @foreach ($order->pickedVariationOption as $varOption)
                                                                {{ $varOption->name }}
                                                                {{ $loop->last ? '' : ',' }}
                                                            @endforeach
                                                        </span>
                                                    </div>
                                                    <div class="d-flex flex-column justify-content-center align-items-center me-2"
                                                        style="width: 30%;">
                                                        <span><strong>Rp
                                                                {{ number_format($order->product->price_after_additional, 2, ',', '.') }}
                                                                x {{ $order->qty }}</strong></span>
                                                    </div>
                                                    <div class="d-flex flex-column justify-content-end align-items-end gap-2 px-2"
                                                        style="width: 30%">
                                                        <span>total pesanan:</span>
                                                        <span><strong>Rp
                                                                {{ number_format($order->total_price, 2, ',', '.') }}</strong></span>
                                                    </div>
                                                </div>
                                            @endif
                                        </div>
                                    @endforeach
                                @else
                                    <div class="d-flex align-items-center justify-content-center mt-5">
                                        <div class="d-flex flex-column align-items-center gap-2">
                                            <img src="{{ asset('/oursvg/empty_order.svg') }}" alt=""
                                                style="width: 400px;">
                                            <span>
                                                <h3 class="font-main-color">belum ada pesanan</h3>
                                            </span>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                        {{-- end unpaid --}}
                        {{-- packed --}}
                        <div class="tab-pane {{ $tabActive == 'packed' ? 'show active' : '' }} fade w-100" id="packed" role="tabpanel"
                            aria-labelledby="packed-tab">
                            <!-- Content for Dikemas -->
                            <div class="d-flex flex-column justify-content-start gap-2 w-100">
                                @if (!$packedOrders->isEmpty())
                                    @foreach ($packedOrders as $order)
                                        <div
                                            class="card-product d-flex flex-column justify-content-between px-4 align-items-center shadow-sm">
                                            <div class="d-flex justify-content-between align-items-center w-100 my-2">
                                                <span class="text-success">Dikirim</span>
                                            </div>
                                            @if ($order->cartProduct && count($order->cartProduct) > 0)
                                                @foreach ($order->cartProduct as $cartProduct)
                                                    <div class="card-all-check d-flex justify-content-between align-items-center gap-4 mb-4"
                                                        style="width: 100%; height: auto; background-color: white"
                                                        id="card-product-PRODUCT_ID">
                                                        <div class="d-flex justify-content-start align-items-center gap-2 pe-2"
                                                            style="width: 30%;">
                                                            <img src="{{ Storage::url('public/product_pictures/' . $cartProduct->product->hasImages()->first()->filepath_image) }}"
                                                                alt="" style="width: 80px; height: 80px;">
                                                            <div wire:ignore
                                                                class="d-flex position-relative justify-content-between"
                                                                style="width: auto; height: auto;">
                                                                <div class="d-flex flex-column align-items-start position-relative gap-0"
                                                                    style="width: 200px; height: auto;">
                                                                    <strong
                                                                        class="font-main-color">{{ $cartProduct->product->name }}</strong>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="d-flex flex-column align-items-start position-relative gap-0"
                                                            style="width: 200px; height: auto;">
                                                            <span>
                                                                @foreach ($cartProduct->cart->pickedVariation as $variation)
                                                                    {{ $variation->variationOption->name }}{{ $loop->last ? '' : ',' }}
                                                                @endforeach
                                                            </span>
                                                        </div>
                                                        <div class="d-flex flex-column justify-content-center align-items-center me-2"
                                                            style="width: 30%;">
                                                            <span><strong>Rp
                                                                    {{ number_format($cartProduct->product->price_after_additional, 2, ',', '.') }}
                                                                    x
                                                                    {{ $cartProduct->product->cart->first()->qty }}</strong></span>
                                                        </div>
                                                        <div class="d-flex flex-column justify-content-end align-items-end gap-2 px-2"
                                                            style="width: 30%">
                                                            <span>sub total :</span>
                                                            <span><strong>Rp
                                                                    {{ number_format($cartProduct->product->cart->first()->total_price, 2, ',', '.') }}</strong></span>
                                                        </div>
                                                    </div>
                                                @endforeach
                                                <div class="d-flex justify-content-end align-items-center w-100 mb-2">
                                                    <div
                                                        class="d-flex flex-column justify-content-start align-items-end me-1">
                                                        <span>total :</span>
                                                        <span><strong>Rp
                                                                {{ number_format($order->total_price, 2, ',', '.') }}</strong></span>
                                                    </div>
                                                </div>
                                            @else
                                                <div class="card-all-check d-flex justify-content-between align-items-center gap-4 mb-4"
                                                    style="width: 100%; height: auto; background-color: white"
                                                    id="card-product-PRODUCT_ID">
                                                    <div class="d-flex justify-content-start align-items-center gap-2 pe-2"
                                                        style="width: 30%;">
                                                        <img src="{{ Storage::url('public/product_pictures/' . $order->product->hasImages()->first()->filepath_image) }}"
                                                            alt="" style="width: 80px; height: 80px;">
                                                        <div wire:ignore
                                                            class="d-flex position-relative justify-content-between"
                                                            style="width: auto; height: auto;">
                                                            <div class="d-flex flex-column align-items-start position-relative gap-0"
                                                                style="width: 200px; height: auto;">
                                                                <strong
                                                                    class="font-main-color">{{ $order->product->name }}</strong>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="d-flex flex-column align-items-start position-relative gap-0"
                                                        style="width: 200px; height: auto;">
                                                        <span>
                                                            @foreach ($order->pickedVariationOption as $varOption)
                                                                {{ $varOption->name }}
                                                                {{ $loop->last ? '' : ',' }}
                                                            @endforeach
                                                        </span>
                                                    </div>
                                                    <div class="d-flex flex-column justify-content-center align-items-center me-2"
                                                        style="width: 30%;">
                                                        <span><strong>Rp
                                                                {{ number_format($order->product->price_after_additional, 2, ',', '.') }}
                                                                x {{ $order->qty }}</strong></span>
                                                    </div>
                                                    <div class="d-flex flex-column justify-content-end align-items-end gap-2 px-2"
                                                        style="width: 30%">
                                                        <span>total pesanan:</span>
                                                        <span><strong>Rp
                                                                {{ number_format($order->total_price, 2, ',', '.') }}</strong></span>
                                                    </div>
                                                </div>
                                            @endif
                                        </div>
                                    @endforeach
                                @else
                                    <div class="d-flex align-items-center justify-content-center mt-5">
                                        <div class="d-flex flex-column align-items-center gap-2">
                                            <img src="{{ asset('/oursvg/empty_order.svg') }}" alt=""
                                                style="width: 400px;">
                                            <span>
                                                <h3 class="font-main-color">belum ada pesanan</h3>
                                            </span>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                        {{-- end packed --}}
                        {{-- delivered --}}
                        <div class="tab-pane {{ $tabActive == 'delivered' ? 'show active' : '' }} fade w-100" id="delivered" role="tabpanel"
                            aria-labelledby="delivered-tab">
                            <!-- Content for Dikirim -->
                            <div class="d-flex flex-column justify-content-start gap-2 w-100">
                                @if (!$deliveredOrders->isEmpty())
                                    @foreach ($deliveredOrders as $order)
                                        <div
                                            class="card-product d-flex flex-column justify-content-between px-4 align-items-center shadow-sm">
                                            <div class="d-flex justify-content-between align-items-center w-100 my-2">
                                                <span class="text-info">dikirim</span>
                                                <div class="d-flex justify-content-between align-items-center gap-2">
                                                    <button
                                                        class="btn rounded-0 bg-main-color text-white d-flex justify-content-center align-items-center mt-1"
                                                        style="width: 200px; height: 30px;" data-bs-toggle="modal"
                                                        data-bs-target="#detail-delivered-{{ $order->id }}">lacak
                                                        pengiriman</button>
                                                    <button wire:click="orderAccept('{{ $order->id }}')"
                                                        class="btn rounded-0 bg-success text-white d-flex justify-content-center align-items-center mt-1"
                                                        style="width: 200px; height: 30px;">pesanan telah
                                                        diterima</button>
                                                </div>
                                            </div>
                                            @if ($order->cartProduct && count($order->cartProduct) > 0)
                                                @foreach ($order->cartProduct as $cartProduct)
                                                    <div class="card-all-check d-flex justify-content-between align-items-center gap-4 mb-4"
                                                        style="width: 100%; height: auto; background-color: white"
                                                        id="card-product-PRODUCT_ID">
                                                        <div class="d-flex justify-content-start align-items-center gap-2 pe-2"
                                                            style="width: 30%;">
                                                            <img src="{{ Storage::url('public/product_pictures/' . $cartProduct->product->hasImages()->first()->filepath_image) }}"
                                                                alt="" style="width: 80px; height: 80px;">
                                                            <div wire:ignore
                                                                class="d-flex position-relative justify-content-between"
                                                                style="width: auto; height: auto;">
                                                                <div class="d-flex flex-column align-items-start position-relative gap-0"
                                                                    style="width: 200px; height: auto;">
                                                                    <strong
                                                                        class="font-main-color">{{ $cartProduct->product->name }}</strong>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="d-flex flex-column align-items-start position-relative gap-0"
                                                            style="width: 200px; height: auto;">
                                                            <span>
                                                                @foreach ($cartProduct->product->pickedVariationOption as $varOption)
                                                                    {{ $varOption->name }}{{ $loop->last ? '' : ',' }}
                                                                @endforeach
                                                            </span>
                                                        </div>
                                                        <div class="d-flex flex-column justify-content-center align-items-center me-2"
                                                            style="width: 30%;">
                                                            <span><strong>Rp
                                                                    {{ number_format($cartProduct->product->price_after_additional, 2, ',', '.') }}
                                                                    x
                                                                    {{ $cartProduct->product->cart->first()->qty }}</strong></span>
                                                        </div>
                                                        <div class="d-flex flex-column justify-content-end align-items-end gap-2 px-2"
                                                            style="width: 30%">
                                                            <span>sub total :</span>
                                                            <span><strong>Rp
                                                                    {{ number_format($cartProduct->product->cart->first()->total_price, 2, ',', '.') }}</strong></span>
                                                        </div>
                                                    </div>
                                                @endforeach
                                                <div class="d-flex justify-content-end align-items-center w-100 mb-2">
                                                    <div
                                                        class="d-flex flex-column justify-content-start align-items-end me-1">
                                                        <span>total :</span>
                                                        <span><strong>Rp
                                                                {{ number_format($order->total_price, 2, ',', '.') }}</strong></span>
                                                    </div>
                                                </div>
                                            @else
                                                <div class="card-all-check d-flex justify-content-between align-items-center gap-4 mb-4"
                                                    style="width: 100%; height: auto; background-color: white"
                                                    id="card-product-PRODUCT_ID">
                                                    <div class="d-flex justify-content-start align-items-center gap-2 pe-2"
                                                        style="width: 30%;">
                                                        <img src="{{ Storage::url('public/product_pictures/' . $order->product->hasImages->first()->filepath_image) }}"
                                                            alt="" style="width: 80px; height: 80px;">
                                                        <div wire:ignore
                                                            class="d-flex position-relative justify-content-between"
                                                            style="width: auto; height: auto;">
                                                            <div class="d-flex flex-column align-items-start position-relative gap-0"
                                                                style="width: 200px; height: auto;">
                                                                <strong
                                                                    class="font-main-color">{{ $order->product->name }}</strong>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="d-flex flex-column align-items-start position-relative gap-0"
                                                        style="width: 200px; height: auto;">
                                                        <span>
                                                            @foreach ($order->pickedVariationOption as $varOption)
                                                                {{ $varOption->name }}
                                                                {{ $loop->last ? '' : ',' }}
                                                            @endforeach
                                                        </span>
                                                    </div>
                                                    <div class="d-flex flex-column justify-content-center align-items-center me-2"
                                                        style="width: 30%;">
                                                        <span><strong>Rp
                                                                {{ number_format($order->product->price_after_additional, 2, ',', '.') }}
                                                                x {{ $order->qty }}</strong></span>
                                                    </div>
                                                    <div class="d-flex flex-column justify-content-end align-items-end gap-2 px-2"
                                                        style="width: 30%">
                                                        <span>total pesanan:</span>
                                                        <span><strong>Rp
                                                                {{ number_format($order->total_price, 2, ',', '.') }}</strong></span>
                                                    </div>
                                                </div>
                                            @endif
                                        </div>
                                    @endforeach
                                @else
                                    <div class="d-flex align-items-center justify-content-center mt-5">
                                        <div class="d-flex flex-column align-items-center gap-2">
                                            <img src="{{ asset('/oursvg/empty_order.svg') }}" alt=""
                                                style="width: 400px;">
                                            <span>
                                                <h3 class="font-main-color">belum ada pesanan</h3>
                                            </span>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                        {{-- end delivered --}}
                        {{-- completed --}}
                        <div class="tab-pane {{ $tabActive == 'completed' ? 'show active' : '' }} fade w-100" id="completed" role="tabpanel"
                            aria-labelledby="completed-tab">
                            <!-- Content for Selesai -->
                            <div class="d-flex flex-column justify-content-start gap-2 w-100">
                                @if (!$completedOrders->isEmpty())
                                    @foreach ($completedOrders as $order)
                                        <div
                                            class="card-product d-flex flex-column justify-content-between px-4 align-items-center shadow-sm">
                                            <div class="d-flex justify-content-between align-items-center w-100 my-2">
                                                <span class="text-success">selesai</span>
                                            </div>
                                            @if ($order->cartProduct && count($order->cartProduct) > 0)
                                                @foreach ($order->cartProduct as $cartProduct)
                                                    <div class="card-all-check d-flex justify-content-between align-items-center gap-4 mb-4"
                                                        style="width: 100%; height: auto; background-color: white"
                                                        id="card-product-PRODUCT_ID">
                                                        <div class="d-flex justify-content-start align-items-center gap-2 pe-2"
                                                            style="width: 30%;">
                                                            <img src="{{ Storage::url('public/product_pictures/' . $cartProduct->product->hasImages()->first()->filepath_image) }}"
                                                                alt="" style="width: 80px; height: 80px;">
                                                            <div wire:ignore
                                                                class="d-flex position-relative justify-content-between"
                                                                style="width: auto; height: auto;">
                                                                <div class="d-flex flex-column align-items-start position-relative gap-0"
                                                                    style="width: 200px; height: auto;">
                                                                    <strong
                                                                        class="font-main-color">{{ $cartProduct->product->name }}</strong>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="d-flex flex-column align-items-start position-relative gap-0"
                                                            style="width: 200px; height: auto;">
                                                            <span>
                                                                @foreach ($cartProduct->cart->pickedVariation as $variation)
                                                                    {{ $variation->variationOption->name }}{{ $loop->last ? '' : ',' }}
                                                                @endforeach
                                                            </span>
                                                        </div>
                                                        <div class="d-flex flex-column justify-content-center align-items-center me-2"
                                                            style="width: 30%;">
                                                            <span><strong>Rp
                                                                    {{ number_format($cartProduct->product->price_after_additional, 2, ',', '.') }}
                                                                    x
                                                                    {{ $cartProduct->product->cart->first()->qty }}</strong></span>
                                                        </div>
                                                        <div class="d-flex flex-column justify-content-end align-items-end gap-2 px-2"
                                                            style="width: 30%">
                                                            <span>sub total :</span>
                                                            <span><strong>Rp
                                                                    {{ number_format($cartProduct->product->cart->first()->total_price, 2, ',', '.') }}</strong></span>
                                                        </div>
                                                        @if ($cartProduct->is_reviewed == false)
                                                            <div class="d-flex flex-column justify-content-end align-items-end gap-2 px-2"
                                                                style="width: 30%">
                                                                <button
                                                                    class="btn rounded-0 bg-main-color text-white d-flex justify-content-center align-items-center mt-1"
                                                                    style="width: 200px; height: 30px;"
                                                                    data-bs-toggle="modal"
                                                                    data-bs-target="#review-modal-cart-{{ $cartProduct->id }}">beri
                                                                    ulasan</button>
                                                            </div>
                                                        @endif
                                                    </div>
                                                @endforeach
                                                <div class="d-flex justify-content-end align-items-center w-100 mb-2">
                                                    <div
                                                        class="d-flex flex-column justify-content-start align-items-end me-1">
                                                        <span>total :</span>
                                                        <span><strong>Rp
                                                                {{ number_format($order->total_price, 2, ',', '.') }}</strong></span>
                                                    </div>
                                                </div>
                                            @else
                                                <div class="card-all-check d-flex justify-content-between align-items-center gap-4 mb-4"
                                                    style="width: 100%; height: auto; background-color: white"
                                                    id="card-product-PRODUCT_ID">
                                                    <div class="d-flex justify-content-start align-items-center gap-2 pe-2"
                                                        style="width: 30%;">
                                                        <img src="{{ Storage::url('public/product_pictures/' . $order->product->hasImages->first()->filepath_image) }}"
                                                            alt="" style="width: 80px; height: 80px;">
                                                        <div wire:ignore
                                                            class="d-flex position-relative justify-content-between"
                                                            style="width: auto; height: auto;">
                                                            <div class="d-flex flex-column align-items-start position-relative gap-0"
                                                                style="width: 200px; height: auto;">
                                                                <strong
                                                                    class="font-main-color">{{ $order->product->name }}</strong>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="d-flex flex-column align-items-start position-relative gap-0"
                                                        style="width: 200px; height: auto;">
                                                        <span>
                                                            @foreach ($order->pickedVariationOption as $varOption)
                                                                {{ $varOption->name }}
                                                                {{ $loop->last ? '' : ',' }}
                                                            @endforeach
                                                        </span>
                                                    </div>
                                                    <div class="d-flex flex-column justify-content-center align-items-center me-2"
                                                        style="width: 30%;">
                                                        <span><strong>Rp
                                                                {{ number_format($order->product->price_after_additional, 2, ',', '.') }}
                                                                x {{ $order->qty }}</strong></span>
                                                    </div>
                                                    <div class="d-flex flex-column justify-content-end align-items-end gap-2 px-2"
                                                        style="width: 30%">
                                                        <span>total pesanan:</span>
                                                        <span><strong>Rp
                                                                {{ number_format($order->total_price, 2, ',', '.') }}</strong></span>
                                                    </div>
                                                    @if (collect($order->productAssessment->first())->isEmpty())
                                                        <div class="d-flex flex-column justify-content-end align-items-end gap-2 px-2"
                                                            style="width: 30%">
                                                            <button
                                                                class="btn rounded-0 bg-main-color text-white d-flex justify-content-center align-items-center mt-1"
                                                                style="width: 200px; height: 30px;"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#review-modal-buyNow-{{ $order->id }}">beri
                                                                ulasan</button>
                                                        </div>
                                                    @endif
                                                </div>
                                            @endif
                                        </div>
                                    @endforeach
                                @else
                                    <div class="d-flex align-items-center justify-content-center mt-5">
                                        <div class="d-flex flex-column align-items-center gap-2">
                                            <img src="{{ asset('/oursvg/empty_order.svg') }}" alt=""
                                                style="width: 400px;">
                                            <span>
                                                <h3 class="font-main-color">belum ada pesanan</h3>
                                            </span>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                        {{-- end completed --}}
                        {{-- cancelled --}}
                        <div class="tab-pane {{ $tabActive == 'cancelled' ? 'show active' : '' }} fade w-100" id="cancelled" role="tabpanel"
                            aria-labelledby="cancelled-tab">
                            <!-- Content for Dibatalkan -->
                            <div class="d-flex flex-column justify-content-start gap-2 w-100">
                                @if (!$cancelledOrders->isEmpty())
                                    @foreach ($cancelledOrders as $order)
                                        <div
                                            class="card-product d-flex flex-column justify-content-between px-4 align-items-center shadow-sm">
                                            <div class="d-flex justify-content-between align-items-center w-100 my-2">
                                                <span class="text-danger">dibatalkan</span>
                                            </div>
                                            @if ($order->cartProduct && count($order->cartProduct) > 0)
                                                @foreach ($order->cartProduct as $cartProduct)
                                                    <div class="card-all-check d-flex justify-content-between align-items-center gap-4 mb-4"
                                                        style="width: 100%; height: auto; background-color: white"
                                                        id="card-product-PRODUCT_ID">
                                                        <div class="d-flex justify-content-start align-items-center gap-2 pe-2"
                                                            style="width: 30%;">
                                                            <img src="{{ Storage::url('public/product_pictures/' . $cartProduct->product->hasImages()->first()->filepath_image) }}"
                                                                alt="" style="width: 80px; height: 80px;">
                                                            <div wire:ignore
                                                                class="d-flex position-relative justify-content-between"
                                                                style="width: auto; height: auto;">
                                                                <div class="d-flex flex-column align-items-start position-relative gap-0"
                                                                    style="width: 200px; height: auto;">
                                                                    <strong
                                                                        class="font-main-color">{{ $cartProduct->product->name }}</strong>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="d-flex flex-column align-items-start position-relative gap-0"
                                                            style="width: 200px; height: auto;">
                                                            <span>
                                                                @foreach ($cartProduct->cart->pickedVariation as $variation)
                                                                    {{ $variation->variationOption->name }}{{ $loop->last ? '' : ',' }}
                                                                @endforeach
                                                            </span>
                                                        </div>
                                                        <div class="d-flex flex-column justify-content-center align-items-center me-2"
                                                            style="width: 30%;">
                                                            <span><strong>Rp
                                                                    {{ number_format($cartProduct->product->price_after_additional, 2, ',', '.') }}
                                                                    x
                                                                    {{ $cartProduct->product->cart->first()->qty }}</strong></span>
                                                        </div>
                                                        <div class="d-flex flex-column justify-content-end align-items-end gap-2 px-2"
                                                            style="width: 30%">
                                                            <span>sub total :</span>
                                                            <span><strong>Rp
                                                                    {{ number_format($cartProduct->product->cart->first()->total_price, 2, ',', '.') }}</strong></span>
                                                        </div>
                                                    </div>
                                                @endforeach
                                                <div class="d-flex justify-content-end align-items-center w-100 mb-2">
                                                    <div
                                                        class="d-flex flex-column justify-content-start align-items-end me-1">
                                                        <span>total :</span>
                                                        <span><strong>Rp
                                                                {{ number_format($order->total_price, 2, ',', '.') }}</strong></span>
                                                    </div>
                                                </div>
                                            @else
                                                <div class="card-all-check d-flex justify-content-between align-items-center gap-4 mb-4"
                                                    style="width: 100%; height: auto; background-color: white"
                                                    id="card-product-PRODUCT_ID">
                                                    <div class="d-flex justify-content-start align-items-center gap-2 pe-2"
                                                        style="width: 30%;">
                                                        <img src="{{ Storage::url('public/product_pictures/' . $order->product->hasImages->first()->filepath_image) }}"
                                                            alt="" style="width: 80px; height: 80px;">
                                                        <div wire:ignore
                                                            class="d-flex position-relative justify-content-between"
                                                            style="width: auto; height: auto;">
                                                            <div class="d-flex flex-column align-items-start position-relative gap-0"
                                                                style="width: 200px; height: auto;">
                                                                <strong
                                                                    class="font-main-color">{{ $order->product->name }}</strong>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="d-flex flex-column align-items-start position-relative gap-0"
                                                        style="width: 200px; height: auto;">
                                                        <span>
                                                            @foreach ($order->pickedVariationOption as $varOption)
                                                                {{ $varOption->name }}
                                                                {{ $loop->last ? '' : ',' }}
                                                            @endforeach
                                                        </span>
                                                    </div>
                                                    <div class="d-flex flex-column justify-content-center align-items-center me-2"
                                                        style="width: 30%;">
                                                        <span><strong>Rp
                                                                {{ number_format($order->product->price_after_additional, 2, ',', '.') }}
                                                                x {{ $order->qty }}</strong></span>
                                                    </div>
                                                    <div class="d-flex flex-column justify-content-end align-items-end gap-2 px-2"
                                                        style="width: 30%">
                                                        <span>total pesanan:</span>
                                                        <span><strong>Rp
                                                                {{ number_format($order->total_price, 2, ',', '.') }}</strong></span>
                                                    </div>
                                                </div>
                                            @endif
                                        </div>
                                    @endforeach
                                @else
                                    <div class="d-flex align-items-center justify-content-center mt-5">
                                        <div class="d-flex flex-column align-items-center gap-2">
                                            <img src="{{ asset('/oursvg/empty_order.svg') }}" alt=""
                                                style="width: 400px;">
                                            <span>
                                                <h3 class="font-main-color">belum ada pesanan</h3>
                                            </span>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                        {{-- end cancelled --}}
                    </div>
                </div>

            </div>
        </div>
    </div>

    {{-- modal review --}}
    @foreach ($completedOrders as $order)
        @foreach ($order->cartProduct as $cartProduct)
            <div wire:ignore class="modal fade" id="review-modal-cart-{{ $cartProduct->id }}" tabindex="-1"
                aria-labelledby="changeAddress" aria-hidden="true" wire:key="modal">
                <div class="modal-dialog">
                    <div class="modal-content rounded-0">
                        <span class="mt-2 mx-4"><strong>Rating dan ulasan</strong></span>
                        <hr>
                        <div class="modal-body">
                            <div class="container">
                                <span class="text-center">
                                    <h5>Berikan rating dan ulasan anda</h5>
                                </span>
                                <div id="rating"
                                    class="d-flex justify-content-center align-items-center gap-2 w-100">
                                    <span class="star" data-value="1" wire:click="storeRating(1)"><i
                                            class="bi bi-star-fill"></i></span>
                                    <span class="star" data-value="2" wire:click="storeRating(2)"><i
                                            class="bi bi-star-fill"></i></span>
                                    <span class="star" data-value="3" wire:click="storeRating(3)"><i
                                            class="bi bi-star-fill"></i></span>
                                    <span class="star" data-value="4" wire:click="storeRating(4)"><i
                                            class="bi bi-star-fill"></i></span>
                                    <span class="star" data-value="5" wire:click="storeRating(5)"><i
                                            class="bi bi-star-fill"></i></span>
                                </div>
                                <form
                                    wire:submit.prevent="createReview('{{ 'cp_' . $cartProduct->id }}', [{{ $cartProduct->cart->pickedVariation[0]->variationOption->id }}, {{ $cartProduct->cart->pickedVariation[1]->variationOption->id }}])">
                                    <input wire:model="rating" id="rating" type="hidden">
                                    @error('rating')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                    <div class="d-flex flex-column">
                                        <label for="content">Foto :</label>
                                        <input type="file" wire:model="attachment">
                                        @error('attachment')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="mt-2">
                                        <label for="content">Pesan :</label>
                                        <textarea type="text" class="form-control rounded-0 mt-2" id="content" name="content" wire:model="content"
                                            style="box-shadow: none; width: 100%; height: 50px;"></textarea>
                                        @error('content')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="d-flex justify-content-end gap-2 mt-4">
                                        <button type="button" id="checkout"
                                            class="btn rounded-0 bg-danger text-white" style="width: 20%;"
                                            data-bs-dismiss="modal"><strong>kembali</strong></button>
                                        <button type="submit" id="checkout"
                                            class="btn rounded-0 bg-main-color text-white"
                                            style="width: 20%;"><strong>kirim</strong></button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    @endforeach
    @foreach ($completedOrders as $order)
        <div wire:ignore class="modal fade" id="review-modal-buyNow-{{ $order->id }}" tabindex="-1"
            aria-labelledby="changeAddress" aria-hidden="true" wire:key="modal">
            <div class="modal-dialog">
                <div class="modal-content rounded-0">
                    <span class="mt-2 mx-4"><strong>Rating dan ulasan</strong></span>
                    <hr>
                    <div class="modal-body">
                        <div class="container mt-5">
                            <h2>Berikan Ulasan Anda</h2>
                            <div id="rating" class="d-flex justify-content-center align-items-center gap-2 w-100">
                                <span class="star" data-value="1" wire:click="storeRating(1)"><i
                                        class="bi bi-star-fill"></i></span>
                                <span class="star" data-value="2" wire:click="storeRating(2)"><i
                                        class="bi bi-star-fill"></i></span>
                                <span class="star" data-value="3" wire:click="storeRating(3)"><i
                                        class="bi bi-star-fill"></i></span>
                                <span class="star" data-value="4" wire:click="storeRating(4)"><i
                                        class="bi bi-star-fill"></i></span>
                                <span class="star" data-value="5" wire:click="storeRating(5)"><i
                                        class="bi bi-star-fill"></i></span>
                            </div>
                            <form
                                wire:submit.prevent="createReview('{{ 'by_' . $order->id }}', {{ $order->pickedVariationOption->pluck('id') }})">
                                <input wire:model="rating" id="rating" type="hidden">
                                @error('rating')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                                <div class="d-flex flex-column">
                                    <label for="content">Foto :</label>
                                    <input type="file" wire:model="attachment">
                                    @error('attachment')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mt-2">
                                    <label for="content">Pesan :</label>
                                    <textarea type="text" class="form-control rounded-0 mt-2" id="content" name="content" wire:model="content"
                                        style="box-shadow: none; width: 100%; height: 50px;"></textarea>
                                    @error('content')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="d-flex justify-content-end gap-2 mt-4">
                                    <button type="button" id="checkout" class="btn rounded-0 bg-danger text-white"
                                        style="width: 20%;" data-bs-dismiss="modal"><strong>kembali</strong></button>
                                    <button type="submit" id="checkout"
                                        class="btn rounded-0 bg-main-color text-white"
                                        style="width: 20%;"><strong>kirim</strong></button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
    {{-- modal detail delivered order --}}
    @foreach ($deliveredOrders as $order)
        <div wire:ignore.self class="modal fade" id="detail-delivered-{{ $order->id }}" tabindex="-1"
            aria-labelledby="changeAddress" aria-hidden="true" wire:key="modal">
            <div class="modal-dialog">
                <div class="modal-content rounded-0">
                    <span class="mt-2 mx-4"><strong>Lacak pengiriman</strong></span>
                    <hr>
                    <div class="modal-body">
                        {{-- tracking --}}
                        <div class="tracking-container p-0">
                            <div class="d-flex justify-content-between align-items-center mx-2 mb-2">
                                <span>No. Resi</span>
                                <span class="font-main-color">{{ $order->shipping->resi }}</span>
                            </div>
                            @foreach ($historyDelivery[$order->id]['data']['history'] as $history)
                                <div class="tracking-step">
                                    <div class="tracking-dot" style="margin-left: 11px"></div>
                                    <div class="tracking-info">
                                        <strong>{{ $history['desc'] }}</strong>
                                        <small>{{ Carbon\Carbon::parse($history['date'])->format('d-m-Y H:i') }}</small>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        {{-- end tracking --}}
                    </div>
                </div>
            </div>
        </div>
    @endforeach

    {{-- modal change password --}}
    <div wire:ignore.self class="modal fade" id="changePassword" tabindex="-1" aria-labelledby="changeAddress"
        aria-hidden="true" wire:key="modal">
        <div class="modal-dialog">
            <div class="modal-content rounded-0">
                <span class="mt-4 mx-4"><strong>Ubah password</strong></span>
                <hr>
                <div class="modal-body">
                    <form wire:submit.prevent="updatePassword()" class="d-flex flex-column gap-2"
                        style="width: 100%;">
                        <div class="input-group" style="height: 100px">
                            <label for="password">Password lama</label>
                            <input wire:model="oldPassword" type="password" class="form-control rounded-0 mt-2"
                                id="password" name="new_password"
                                style="box-shadow: none; width: 100%; height: 50px;">
                            @error('oldPassword')
                                <span class="text-danger">{{ $message }}</spanc>
                                @enderror
                        </div>
                        <div class="input-group" style="height: 100px">
                            <label for="password">Password baru</label>
                            <input wire:model="newPassword" type="password" class="form-control rounded-0 mt-2"
                                id="password" name="new_password"
                                style="box-shadow: none; width: 100%; height: 50px;">
                            @error('newPassword')
                                <span class="text-danger">{{ $message }}</spanc>
                                @enderror
                        </div>
                        <div class="input-group">
                            <label for="password_confirmation">Konfirmasi password</label>
                            <input wire:model="newPassword_confirmation" type="password"
                                class="form-control rounded-0 mt-2" id="password_confirmation"
                                name="new_password_confirmation" style="box-shadow: none; width: 100%; height: 50px;">
                            @error('oldPassword_confirmation')
                                <span class="text-danger">{{ $message }}</spanc>
                                @enderror
                        </div>
                        <div class="d-flex justify-content-end align-items-center gap-2 mt-4 me-4 mb-4">
                            <button class="btn rounded-0 bg-danger text-white" style="width: 20%;"
                                data-bs-toggle="modal"
                                data-bs-target="#modalAddress"><strong>kembali</strong></button>
                            <button type="submit" id="checkout" class="btn rounded-0 bg-main-color text-white"
                                style="width: 20%;"><strong>ubah</strong></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    {{-- modal address --}}
    <div wire:ignore.self class="modal fade" id="addAddress" tabindex="-1" aria-labelledby="changeAddress"
        aria-hidden="true" wire:key="modal">
        <div class="modal-dialog">
            <div class="modal-content rounded-0">
                <span class="mt-4 mx-4"><strong>Tambah Alamat</strong></span>
                <hr>
                <div class="modal-body">
                    <form wire:submit.prevent="addAddress('{{ $address->id }}')">
                        <div class="mt-2">
                            <label for="recepient_name">Nama penerima</label>
                            <input type="text" class="form-control rounded-0 mt-2" id="username"
                                name="recepient_name" wire:model="add_recipient_name"
                                style="box-shadow: none; width: 100%; height: 50px;">
                            @error('add_recipient_name')
                                <span class="text-danger">{{ $message }}</spanc>
                                @enderror
                        </div>

                        <div class="">
                            <label for="address">Alamat lengkap</label>
                            <textarea type="text" class="form-control rounded-0 mt-2" id="address" name="address" wire:model="add_address"
                                style="box-shadow: none; width: 100%; height: 50px;"></textarea>
                            @error('add_address')
                                <span class="text-danger">{{ $message }}</spanc>
                                @enderror
                        </div>
                        <div class="mt-2">
                            <label for="province">Provinsi</label>
                            <select class="form-select form-select-lg rounded-0" aria-label="Large select example"
                                id="province" wire:model="add_province" name="province">
                                <option value="">pilih provinsi</option>
                                @foreach ($provincies as $key => $value)
                                    <option value="{{ $value }}" wire:key="province-{{ $key }}">
                                        {{ $value }}</option>
                                @endforeach
                            </select>
                            @error('add_province')
                                <span class="text-danger">{{ $message }}</spanc>
                                @enderror
                        </div>
                        <div class="mt-2">
                            <label for="province">Kota</label>
                            <select class="form-select form-select-lg rounded-0" aria-label="Large select example"
                                id="city" wire:model="add_city" name="city">
                                <option value="">pilih kota</option>
                                @foreach ($cities as $key => $value)
                                    <option value="{{ $value }}" wire:key="city-{{ $key }}">
                                        {{ $value }}
                                    </option>
                                @endforeach
                            </select>
                            @error('add_city')
                                <span class="text-danger">{{ $message }}</spanc>
                                @enderror
                        </div>
                        <div class="mt-2">
                            <label for="detail">Detail</label>
                            <input type="text" class="form-control rounded-0 mt-2" id="username" name="detail"
                                wire:model="add_detail" style="box-shadow: none; width: 100%; height: 50px;">
                            @error('add_detail')
                                <span class="text-danger">{{ $message }}</spanc>
                                @enderror
                        </div>
                        <div class="mt-2">
                            <label for="postal_code">Kode pos</label>
                            <input type="text" class="form-control rounded-0 mt-2" id="username"
                                name="postal_code" wire:model="add_postal_code"
                                style="box-shadow: none; width: 100%; height: 50px;">
                            @error('add_postal_code')
                                <span class="text-danger">{{ $message }}</spanc>
                                @enderror
                        </div>
                        <div class="d-flex justify-content-end align-items-center gap-2 mt-4 me-4 mb-4">
                            <button class="btn rounded-0 bg-danger text-white"
                                style="width: 20%;"><strong>kembali</strong></button>
                            <button type="submit" id="checkout" class="btn rounded-0 bg-main-color text-white"
                                style="width: 20%;"><strong>tambah</strong></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @foreach ($addresses as $address)
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
                                        <option value="{{ $value }}"
                                            wire:key="province-{{ $key }}"
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
                                <button class="btn rounded-0 bg-danger text-white"
                                    style="width: 20%;"><strong>kembali</strong></button>
                                <button type="submit" id="checkout" class="btn rounded-0 bg-main-color text-white"
                                    style="width: 20%;"><strong>ubah</strong></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div>
<script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ env('MIDTRANS_CLIENT_KEY') }}"
    data-navigate-track></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        let completedOrders = @json($completedOrders);
        window.addEventListener('closeModalCreateReview', function() {
            completedOrders.forEach(order => {
                var modal = document.getElementById('review-modal-buyNow-' + order.id);
                if (modal) {
                    var modalInstance = bootstrap.Modal.getInstance(modal);
                    if (!modalInstance) {
                        modalInstance = new bootstrap.Modal(modal);
                    }
                    modalInstance.hide();
                }
            });
        });

        window.addEventListener('closeModalCreateReviewCp', function() {
            completedOrders.forEach(order => {
                console.log(order);
                order.cart_product.forEach(cartProduct => {
                    var modal = document.getElementById('review-modal-cart-' +
                        cartProduct.id);
                    if (modal) {
                        var modalInstance = bootstrap.Modal.getInstance(modal);
                        if (!modalInstance) {
                            modalInstance = new bootstrap.Modal(modal);
                        }
                        modalInstance.hide();
                    }
                });
            });
        });
    });
</script>
<script>
    window.addEventListener('closeModalChangePassword', function() {

        var modal = document.getElementById('changePassword');
        var modalInstance = bootstrap.Modal.getInstance(modal); // Get the existing instance

        if (!modalInstance) {
            modalInstance = new bootstrap.Modal(modal); // Create a new instance if it doesn't exist
        }

        modalInstance.hide();
    })


    document.addEventListener('DOMContentLoaded', function() {

        const stars = document.querySelectorAll('.star');
        let rating = 0;

        stars.forEach(star => {
            star.addEventListener('click', function() {
                rating = parseInt(this.getAttribute('data-value'));
                updateStars(rating);
                updateStars(rating);
            });
        });

        function updateStars(rating) {
            stars.forEach(star => {
                if (parseInt(star.getAttribute('data-value')) <= rating) {
                    star.classList.add('selected');
                } else {
                    star.classList.remove('selected');
                }
            });
        }
        const pendingOrders = @json($pendingOrders);
        for (let i = 0; i < pendingOrders.length; i++) {
            (function(index) {
                document.getElementById('pay-' + pendingOrders[index].id).onclick = function() {
                    console.log(pendingOrders[index].snap_token)
                    snap.pay(pendingOrders[index].snap_token, {
                        onSuccess: function(result) {
                            window.location.href = "{{ route('user-home') }}"
                        },
                        onPending: function(result) {
                            console.log('onPending', result);
                        },
                        onError: function(result) {
                            console.log('onError', result);
                        }
                    });
                };
            })(i);
        }
    })
</script>
