<?php

namespace App\Http\Controllers;

use App\Models\ProductImage;
use Illuminate\Http\Request;

class ProductImageController extends Controller
{
    public function getImagesByProduct($productId)
    {
        $images = ProductImage::where('product_id', $productId)->get(['id', 'filepath_image']);
        return response()->json($images);
    }
}
