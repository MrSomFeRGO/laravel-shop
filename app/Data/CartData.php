<?php

namespace App\Data;

use App\Models\Product;
use Spatie\LaravelData\Data;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript]
class CartData extends Data
{
    public function __construct(
        public int $id,
        public ProductData $product,
        public int     $quantity,
    )
    {
    }
}
