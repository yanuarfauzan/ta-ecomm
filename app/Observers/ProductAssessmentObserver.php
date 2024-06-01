<?php

namespace App\Observers;

use App\Models\ProductAssessment;
use App\Models\Product;

class ProductAssessmentObserver
{
    /**
     * Handle the ProductAssessment "created" event.
     */
    public function created(ProductAssessment $productAssessment)
    {
        $this->updateProductRate($productAssessment);
    }

    /**
     * Handle the ProductAssessment "updated" event.
     */
    public function updated(ProductAssessment $productAssessment)
    {
        $this->updateProductRate($productAssessment);
    }

    /**
     * Handle the ProductAssessment "deleted" event.
     */
    public function deleted(ProductAssessment $productAssessment)
    {
        $this->updateProductRate($productAssessment);
    }

    protected function updateProductRate(ProductAssessment $productAssessment)
    {
        $product = $productAssessment->product;

        if ($product) {
            $averageRating = $product->assessments()->avg('rating');
            $product->rate = $averageRating ?? 0;
            $product->save();
        }
    }

    /**
     * Handle the ProductAssessment "restored" event.
     */
    public function restored(ProductAssessment $productAssessment)
    {
        //
    }

    /**
     * Handle the ProductAssessment "force deleted" event.
     */
    public function forceDeleted(ProductAssessment $productAssessment)
    {
        //
    }
}
