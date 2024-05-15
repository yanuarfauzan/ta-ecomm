<div class="card-detail-product pt-0 my-2" style="width: 32%; height: 430px;">
    <div class="container mx-4 my-4 d-flex flex-column gap-4" style="width: auto; height: auto;">
        <strong>Atur jumlah dan catatan</strong>
        <div class="d-flex gap-2 justify-content-start align-items-center">
            @foreach ($choosedVarOptions as $varOption)
                @if (!explode('_', $varOption)[2] == null)
                    <img src="{{ Storage::url('public/product_pictures/' . explode('_', $varOption)[2]) }}" alt=""
                        style="width: 60px">
                @endif
            @endforeach
            <h4>
                @foreach ($choosedVarOptions as $varOption)
                    {{ explode('_', $varOption)[1] }} {{ $loop->last ? '' : ',' }}
                @endforeach
            </h4>
        </div>
        <div class="d-flex gap-2 align-items-center">
            <div class="d-flex flex-column gap-2">
                <div class="d-flex align-items-center gap-4 shadow-sm"
                    style="width: 129px; height: auto; background-color: white;" id="counter">
                    <button wire:click="decrease" id="decrease" class="badge rounded-0 border-0 text-center"
                        style="height: 30px; width: 30px;"><i class="bi bi-dash"></i></button>
                    <input id="number-counter" type="text" role="spinbutton" pattern="[0-9]*"
                        value="{{ $count }}" class="border-0 rounded-0 text-center"
                        style="width: 20px; height: 28px;" readonly>
                    <button wire:click="increase" id="increase" class="badge rounded-0 border-0 text-center"
                        style="height: 30px; width: 30px;"><i class="bi bi-plus"></i></button>
                </div>
            </div>
            <span>Stock : 1000</span>
        </div>

        <div class="d-flex justify-content-between">
            <span><strong>subtotal</strong></span>
            <span><strong>Rp
                    {{ number_format($totalPrice - $totalPrice * ($product->discount / 100), 2, ',', '.') }}</strong></span>
        </div>
        <div class="d-flex flex-column gap-4">
            @if (count($product->variation) == count($choosedVarOptions))
                <button wire:click="addToCart" class="btn bg-main-color rounded-0 text-white" style="width: 100%"
                    id="add-to-cart">Add to
                    Cart</button>
                <button class="btn bg-main-color rounded-0 text-white" style="width: 100%" id="add-to-cart">Buy
                    Now</button>
            @else
                <button class="btn bg-main-color rounded-0 text-white opacity-50" style="width: 100%"
                    id="add-to-cart">Add to
                    Cart</button>
                <button class="btn bg-main-color rounded-0 text-white opacity-50" style="width: 100%" id="add-to-cart">Buy
                    Now</button>
            @endif
        </div>
        <div class="d-flex justify-content-center align-items-center gap-2">
            <span><i class="bi bi-heart"></i> wishlist</span>
            <div class="low-divider-black"></div>
            <span><i class="bi bi-share"></i> share</span>
        </div>
    </div>
</div>
