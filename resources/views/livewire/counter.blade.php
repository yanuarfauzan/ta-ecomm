<div class="d-flex align-items-center gap-2 shadow-sm" style="width: auto; height: auto; background-color: white;"
    id="counter">
    <button wire:click="decrease" id="decrease" class="badge rounded-0 border-0 text-center"
        style="height: 30px; width: 30px;"><i class="bi bi-dash"></i></button>
    <input id="number-counter" type="text" value="{{ $count }}" class="border-0 rounded-0 text-center"
        style="width: 20px; height: 28px;">
    <button wire:click="increase" id="increase" class="badge rounded-0 border-0 text-center"
        style="height: 30px; width: 30px;"><i class="bi bi-plus"></i></button>
</div>
