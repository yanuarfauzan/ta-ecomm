document.addEventListener('DOMContentLoaded', function () {
    let selectedVariations = [];

    function handleVariationItemClick(event) {
        const item = event.target;
        
        if (item.classList.contains('variation-item')) {
            let variationId = item.dataset.variationId;
            let varOptionId = item.dataset.varOptionId;

            document.querySelectorAll(`.variation-item-${variationId}`).forEach(b => b.classList.remove('active-var-item'));

            item.classList.add('active-var-item');

            const index = selectedVariations.findIndex(v => v.variationId === variationId);
            if (index === -1) {
                selectedVariations.push({ variationId, varOptionId });
            } else {
                selectedVariations[index].varOptionId = varOptionId;
            }

            const activeVariations = Array.from(document.querySelectorAll('.active-var-item')).map(activeItem => ({
                variationId: activeItem.dataset.variationId,
                varOptionId: activeItem.dataset.varOptionId
            }));

            selectedVariations = [...new Map([...selectedVariations, ...activeVariations].map(item => [item.variationId, item])).values()];

            Livewire.dispatchTo('variation', 'updateVariationAndVarOptionId', { 'selectedVariations': selectedVariations });
        }
    }

    // Attach event listener to the body for event delegation
    document.body.addEventListener('click', handleVariationItemClick);
});
