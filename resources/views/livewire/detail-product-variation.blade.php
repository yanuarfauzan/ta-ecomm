<div>
    <div class="d-flex justify-content-start gap-4">
        @foreach ($product->variation as $variation)
            <div class="d-flex flex-column align-items-start gap-2" style="width: auto">
                <span>
                    <strong>{{ $variation->name }}</strong>
                </span>
                <div class="row row-cols-4 gap-1 ms-1">
                    @foreach ($variation->variationOption as $varOption)
                    <button wire:ignore type="button" wire:click="chooseVarOptions('{{ $variation->id }}_{{ $varOption->id }}_{{ $varOption->productImage?->filepath_image }}')"
                        class="variation-item variation-item-{{ $variation->id }} shadow-sm badge border-sm rounded-0"
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
