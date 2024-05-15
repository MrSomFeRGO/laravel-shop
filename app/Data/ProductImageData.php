<?php

namespace App\Data;

use Spatie\LaravelData\Attributes\MapInputName;
use Spatie\LaravelData\Data;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript]
class ProductImageData extends Data
{
    public function __construct(
        public int    $id,
        #[MapInputName('image_url')]
        public string $imageUrl,
    ) {}
}
