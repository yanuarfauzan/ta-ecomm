<div>
    @if ($product->discount)
        <div class="d-flex flex-column gap-2 align-items-start">
            <span class="d-flex flex-column p-0">
                <h2><strong>Rp
                        {{ number_format($price - $price * ($product->discount / 100), 2, ',', '.') }}</strong>
                </h2>
                <div class="d-flex gap-2">
                    <span class="text-dark bg-main-color border border-secondary text-center" style="width: 40px;"><i
                            class="text-white">{{ floor($product->discount) }}%</i></span>
                    <i><strong class="text-decoration-line-through">Rp
                            {{ number_format($price, 2, ',', '.') }}</strong></i>
                </div>
            </span>
        </div>
    @else
        <div class="d-flex justify-content-start gap-2">
            <span>
                <h2><strong>Rp {{ number_format($price, 2, ',', '.') }}</strong></h2>
            </span>
        </div>
    @endif
    <div class="d-flex justify-content-start gap-4">
        @foreach ($product->variation as $index => $variation)
            <div class="d-flex flex-column align-items-start gap-2" style="width: auto">
                <span>
                    <strong>{{ $variation->name }}</strong>
                </span>
                    <div class="row row-cols-2 gap-1 ms-1">
                        @foreach ($variation->variationOption as $varOption)
                            <button wire:ignore type="button"
                                wire:click="chooseVarOptions('{{ $variation->id }}_{{ $varOption->id }}_{{ $varOption->productImage?->filepath_image }}', '{{ $index }}')"
                                class="variation-item variation-item-{{ $variation->id }} shadow-sm badge border-sm rounded-0 {{ $loop->first && $firstVarOption == $variation->id ? 'active-var-item' : '' }}"
                                style="width: auto">{{ $varOption->name }}</button>
                        @endforeach
                    </div>
            </div>
        @endforeach
    </div>
</div>
<script data-navigate-track>
    const variation = @json($product->variation);
</script>
