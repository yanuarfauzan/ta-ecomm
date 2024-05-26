<div style="width: 100%">
    <div class="d-flex justify-content-between align-items-center gap-2" style="width: 100%;">
        <div class="d-flex justify-content-start gap-2 align-items-center" style="width: 55%">
            <span for="note" class="bg-main-color px-4 text-white"
                style="padding-top: 12px; padding-bottom: 12px">voucher:
            </span>
            <span style="cursor: pointer; border : 1px solid #ccc; box-shadow: none; width: 100%; height: 50px;"
                class="d-flex justify-content-center align-items-center" data-bs-toggle="modal"
                data-bs-target="#modalVoucher">
                <h5>Gunakan voucher</h5>
            </span>
        </div>
        <div class="d-flex justify-content-start gap-2 align-items-center" style="width: 45%">
            <span for="note" class="bg-main-color px-4 text-white text-center"
                style="padding-top: 12px; padding-bottom: 12px; width: 50%;">opsi pengiriman: </span>
            <select wire:ignore class="form-select form-select-lg rounded-0" aria-label="Large select example"
                style="width: 50%" wire:change="showCost($event.target.value)">
                <option value="jne">JNE</option>
                <option value="pos">POS</option>
                <option value="tiki">TIKI</option>
            </select>
        </div>
    </div>
    <h5 class="mt-4"><strong>Pilih Opsi pengiriman</strong></h5>
    <ul class="list-group rounded-0" style="width: 100%">
        @if ($product->id == $costs['product_id'])
            @foreach ($costs['costs'] as $cost)
                <li class="list-group-item d-flex justify-content-start align-items-center gap-4">
                    <span>
                        <input wire:click="addCostValueToTotalPrice('{{ $cost['service'] }}')"
                            class="form-check-input me-1" type="radio" name="listGroupRadio" value=""
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
    <div class="modal fade" style="top: 10%" id="modalVoucher" tabindex="-1" aria-labelledby="modalVoucherLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content rounded-0">
                <div class="modal-body">
                    <span><strong>Pilihan Voucher</strong></span>
                    <hr>
                    <div class="d-flex justify-content-start align-items-center">
                        <div class="d-flex justify-content-center align-items-center bg-main-color border-0 text-white"
                            style="width: 150px; height: 88px">
                            <h5>
                                <strong>
                                    Gratis
                                    <br>
                                    Ongkir
                                </strong>
                            </h5>
                        </div>
                        <div class="d-flex justify-content-between align-items-center gap-1 ps-4"
                            style="border: 4px solid #6777ef; width: 70%; height: 88px;">
                            <div class="d-flex flex-column justify-content-center align-items-start">
                                <span><strong>Gratis Ongkir</strong></span>
                                <span>Min. Blj Rp 12.000</span>
                                <span class="opacity-50">Berakhir dlm 23 jam</span>
                            </div>
                            <span class="pe-4">
                                <input wire:click="addCostValueToTotalPrice('{{ $cost['service'] }}')"
                                    class="form-check-input me-1" type="radio" name="listGroupRadio" value=""
                                    id="firstRadio" {{ isset($cost['is_picked']) ? 'checked' : '' }}>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
