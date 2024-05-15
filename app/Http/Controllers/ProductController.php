<?php

namespace App\Http\Controllers;

use App\Data\ProductData;
use App\Models\Product;

class ProductController extends Controller
{
    public function index(string $slug)
    {
        return inertia('Product', [
            'product' => ProductData::from(Product::where('slug', '=', $slug)
                ->with('deliveryRegions', 'productImages', 'standard')->first()->toArray()
            ),
        ]);
    }
}
