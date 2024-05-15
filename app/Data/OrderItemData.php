<?php

namespace App\Data;

use Spatie\LaravelData\Data;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript]
class OrderItemData extends Data
{
    public function __construct(
        public ProductData $product,
        public int         $quantity,
        public float       $total_price,
    )
    {
    }
}
