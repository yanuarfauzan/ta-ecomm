document.addEventListener('DOMContentLoaded', function () {

    let selectedVariations = [];

    // Function to handle variation item click
    function handleVariationItemClick(event) {
        const item = event.target;
        
        // Check if the clicked element is a variation item
        if (item.classList.contains('variation-item')) {
            let variationId = item.dataset.variationId;
            let varOptionId = item.dataset.varOptionId;

            // Remove active class from all buttons in this variation group
            document.querySelectorAll(`.variation-item-${variationId}`).forEach(b => b.classList.remove('active-var-item'));

            // Add active class to the clicked button
            item.classList.add('active-var-item');

            // Update selectedVariations array
            const index = selectedVariations.findIndex(v => v.variationId === variationId);
            if (index === -1) {
                selectedVariations.push({ variationId, varOptionId });
            } else {
                selectedVariations[index].varOptionId = varOptionId;
            }

            console.log(selectedVariations);
            Livewire.dispatchTo('variation', 'updateVariationAndVarOptionId', { 'selectedVariations': selectedVariations });
        }
    }

    // Attach event listener to the body for event delegation
    document.body.addEventListener('click', handleVariationItemClick);
})