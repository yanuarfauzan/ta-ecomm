<div style="width: 100%">
    <div class="d-flex justify-content-between align-items-center gap-2" style="width: 100%;">
        <div class="d-flex justify-content-start gap-2 align-items-center" style="width: 55%">
            <span for="note" class="bg-main-color px-4 text-white"
                style="padding-top: 12px; padding-bottom: 12px">voucher:
            </span>
            <span style="cursor: pointer; border: 1px solid #ccc; box-shadow: none; width: 100%; height: 50px;"
                class="d-flex justify-content-center align-items-center" data-bs-toggle="modal"
                data-bs-target="#modalVoucher">
                @if ($isVoucherApplied)
                    <div class="d-flex justify-content-start align-items-center">
                        <div class="d-flex justify-content-center align-items-center bg-main-color border-0 text-white"
                            style="width: 125px; height: 40px">
                            <img src="{{ Storage::url('public/icon_voucher/' . $voucherApplied?->voucher_icon) }}"
                                alt=""
                                style="width: {{ $voucherApplied?->voucher_icon == 'discount.svg' ? '30px;' : '50px;' }}">
                        </div>
                        <div class="d-flex justify-content-between align-items-center gap-1 ps-4"
                            style="border: 4px solid #6777ef; width: 70%; height: 40px;">
                            <div class="d-flex flex-column justify-content-center align-items-center"
                                style="width: 170px">
                                <span><strong>Rp
                                        {{ number_format(isset($voucherApplied?->discount_value) ? $voucherApplied?->discount_value : $costValue, 2, ',', '.') }}</strong></span>
                            </div>
                        </div>
                    </div>
                @else
                    <h5 class="opacity-50"><i class="bi bi-tag-fill"></i> gunakan voucher</h5>
                @endif
            </span>
        </div>
        <div class="d-flex justify-content-start gap-2 align-items-center" style="width: 45%">
            <span for="note" class="bg-main-color px-4 text-white text-center"
                style="padding-top: 12px; padding-bottom: 12px; width: 50%;">opsi pengiriman: </span>
            <select wire:ignore class="form-select form-select-lg rounded-0" aria-label="Large select example"
                style="width: 50%" wire:change="showCost($event.target.value)">
                <option value="jne" {{ $courier == 'jne' ? 'selected' : '' }}>JNE</option>
                <option value="pos" {{ $courier == 'pos' ? 'selected' : '' }}>POS</option>
                <option value="tiki" {{ $courier == 'tiki' ? 'selected' : '' }}>TIKI</option>
            </select>
        </div>
    </div>
    <h5 class="mt-4"><strong>Pilih Opsi pengiriman</strong></h5>
    <ul class="list-group rounded-0" style="width: 100%">
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
    </ul>
    <div class="modal fade" style="top: 10%" id="modalVoucher" tabindex="-1"
        aria-labelledby="modalVoucherLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content rounded-0">
                <span class="mt-4 mx-4" ><strong>Pilihan Voucher</strong></span>
                <hr>
                <div class="modal-body" style="overflow-y: scroll; max-height: 450px;">
                    @foreach ($productVoucher as $voucher)
                        <div class="d-flex justify-content-start align-items-center mt-2" style="cursor: pointer">
                            <div class="d-flex justify-content-center align-items-center bg-main-color border-0 text-white"
                                style="width: 150px; height: 88px">
                                <img src="{{ Storage::url('public/icon_voucher/' . $voucher->voucher_icon) }}"
                                    alt="" style="width: 50px">
                            </div>
                            <div class="d-flex justify-content-between align-items-center gap-1 ps-4"
                                style="border: 4px solid #6777ef; width: 70%; height: 88px;">
                                <div class="d-flex flex-column justify-content-center align-items-start">
                                    <span style="width: 250px;">
                                        <strong>{{ $voucher->name }} {{ isset($voucher->discount_value) ? 's.d Rp ' . number_format($voucher->discount_value, 2, ',', '.') : ''  }}</strong>
                                    </span>
                                    <span>Min. Blj Rp {{ $voucher->requirement }}</span>
                                    <span class="opacity-50">Berakhir dlm 23 jam <a href="">s&k</a></span>
                                </div>
                                <span class="pe-4">
                                    <input
                                        wire:click="useVoucher('{{ $voucher->type }}', '{{ $voucher->discount_value }}', '{{ $voucher->id }}')"
                                        class="form-check-input me-1" type="radio" id="checkbox-voucher" name="checkbox-voucher"
                                        value="" data-bs-dismiss="modal" aria-label="Close">
                                </span>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
