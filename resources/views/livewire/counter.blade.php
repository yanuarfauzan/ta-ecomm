<div class="d-flex justify-content-end gap-2">
    <div class="d-flex gap-2 align-items-end me-3">
        <a href="" class="font-main-color">
            <i class="bi bi-heart" style="font-size: 20px"></i>
        </a>
        <a href="" class="font-main-color">
            <i class="bi bi-trash" style="font-size: 20px"></i>
        </a>
    </div>
    <div class="d-flex flex-column">
        <div class="d-flex flex-column">
            <h5 class="font-main-color"><strong>Rp
                {{ number_format( isset($product->discount) ? $userCart->total_price_after_discount : $userCart->total_price, 2, ',', '.') }}</strong></h5>
            @if (isset($product->discount))                
            <p class="text-decoration-line-through font-main-color">
                <i>Rp
                    {{ number_format($userCart->total_price, 2, ',', '.') }}</i>
            </p>
            @endif
        </div>
        <div class="d-flex align-items-center gap-4 shadow-sm"
            style="width: 129px; height: auto; background-color: white;" id="counter">
            <button wire:click="decrease" id="decrease" class="badge rounded-0 border-0 text-center"
                style="height: 30px; width: 30px;"><i class="bi bi-dash"></i></button>
            <input id="number-counter" type="text" value="{{ $count }}"
                class="border-0 rounded-0 text-center" style="width: 20px; height: 28px;">
            <button wire:click="increase" id="increase" class="badge rounded-0 border-0 text-center"
                style="height: 30px; width: 30px;"><i class="bi bi-plus"></i></button>
        </div>
    </div>
</div>