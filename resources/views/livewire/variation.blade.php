<div>
    <div class="d-flex flex-column align-items-start position-relative gap-0" style="width: 200px; height: auto;">
        <strong class="text-dark">{{ $product->name }}</strong>
        <span class="text-dark text-opacity-75">
            <a href="#collapseVariation-{{ $index }}" id="toggleButtonVariation" role="button" aria-expanded="false"
                aria-controls="categoryCollapse-{{ $product->id }}"
                class="dropdown-toggle btn bg-transparent border-0 px-0 py-0 toggle-button-variation-{{ $index }}"
                data-bs-toggle="collapse">Variasi</a>
        </span>
        <span class="text-dark text-opacity-75">
            @foreach ($userCart->pickedVariation as $variation)
                {{ $variation->variationOption->name }}{{ !$loop->last ? ',' : '' }}
            @endforeach
        </span>
        <span class="text-dark text-opacity-75">Stok {{ $stock }}</span>
    </div>
    <div class="collapse collapse-variation-{{ $index }} position-absolute border-0"
        style="top: 80%; width: 250px; height: auto; z-index: 1000" id="collapseVariation-{{ $index }}"
        wire:ignore>
        <div class="card card-body rounded-0 shadow" id="card-variation-{{ $product->id }}">
            <div class="d-flex flex-column gap-2">
                <div class="container d-flex flex-column">
                    @foreach ($product->variation as $index => $variation)
                        <span>{{ $variation->name }} :</span>
                        <div class="row row-cols-4 gap-2 mt-2 ms-3 border-0">
                            @foreach ($variation->variationOption as $varOption)
                                @php
                                    $pivotExists = $userCart->pickedVariation->contains(function ($item) use (
                                        $varOption,
                                    ) {
                                        return $item->variationOption->id == $varOption->id;
                                    });
                                @endphp
                                <button type="button" data-variation-id="{{ $variation->id }}"
                                    data-var-option-id="{{ $varOption->id }}"
                                    class="variation-item variation-item-{{ $variation->id }} {{ $pivotExists ? 'active-var-item' : '' }} shadow-sm badge border-sm rounded-0"
                                    style="width: auto">{{ $varOption->name }}</button>
                            @endforeach
                        </div>
                    @endforeach
                </div>
                <div class="d-flex gap-2 justify-content-end mt-4 border-0">
                    <button type="button" class="btn bg-main-color text-white rounded-0 variation-confirm"
                        style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;">
                        batal
                    </button>
                    <button type="button" wire:click="confirm" onclick="document.body.click()"
                        class="btn bg-main-color text-white rounded-0 variation-confirm"
                        style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;">
                        konfirmasi
                    </button>
                </div>
            </div>
        </div>
    </div>
    <script data-navigate-track>
        const variation = @json($product->variation);
        const userCarts = @json($usersCarts);
    </script>
    <script src="{{ asset('/ourjs/component-variation-product.js') }}" data-navigate-track></script>
</div>
