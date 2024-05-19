<div style="width: 100%">
    <div class="d-flex justify-content-between align-items-center gap-2" style="width: 100%;">
        <div class="d-flex justify-content-start gap-2 align-items-center" style="width: 55%">
            <span for="note" class="bg-main-color px-4 text-white"
                style="padding-top: 12px; padding-bottom: 12px">pesan:
            </span>
            <input wire:model.lazy="note" type="text" class="form-control rounded-0" id="note" name="note" value="{{ $order->note }}"
                placeholder="tuliskan pesan anda disini" style="box-shadow: none; width: 100%; height: 50px;">
        </div>
        <div class="d-flex justify-content-start gap-2 align-items-center" style="width: 45%">
            <span for="note" class="bg-main-color px-4 text-white"
                style="padding-top: 12px; padding-bottom: 12px; width: 50%;">opsi pengiriman: </span>
            <select wire:ignore class="form-select form-select-lg rounded-0" aria-label="Large select example"
                style="width: 50%" wire:change="showCost($event.target.value)">
                <option value="jne">JNE</option>
                <option value="pos">POS</option>
                <option value="tiki">TIKI</option>
            </select>
        </div>
    </div>
    <h5 class="mt-4" ><strong>Pilih Opsi pengiriman</strong></h5>
    <ul class="list-group rounded-0" style="width: 100%">
        @if ($product->id == $costs['product_id'])
            @foreach ($costs['costs'] as $cost)
                <li class="list-group-item d-flex justify-content-start align-items-center gap-4">
                    <span>
                        <input wire:click="addCostValueToTotalPrice('{{ $cost['service'] }}')" class="form-check-input me-1" type="radio" name="listGroupRadio" value=""
                            id="firstRadio" {{ isset($cost['is_picked']) ? 'checked' : '' }}>
                    </span>
                    <div for="firstRadio" class="d-flex flex-column align-items start">
                        <span><strong>{{ $costs['name'] }}</strong></span>
                        <div class="d-flex justify-content-start align-items-center gap-2">
                            <span><strong>{{ $cost['service'] }}</strong></span>
                            <span class="font-main-color">Rp
                                {{ number_format($cost['cost'][0]['value'], 2, ',', '.') }}</span>
                        </div>
                        <div class="d-flex justify-content-start align-items-center gap-2">
                            <span>Estimasi sampai</span>
                            <span>{{ $cost['cost'][0]['etd'] }}</span>
                        </div>
                    </div>
                </li>
            @endforeach
        @endif
    </ul>
</div>
