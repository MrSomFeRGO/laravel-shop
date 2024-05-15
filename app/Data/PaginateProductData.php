<?php

namespace App\Data;

use Spatie\LaravelData\Data;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript]
class PaginateProductData extends Data
{
    public function __construct(
        /**  @var ProductData[] */
        public array $data,
        /** @var PaginateLinksData[] */
        public array $links,
        public int   $current_page,
    )
    {
    }
}
