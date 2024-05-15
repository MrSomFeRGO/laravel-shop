<?php

namespace App\Data;

use Spatie\LaravelData\Data;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript]
class PaginateLinksData extends Data
{
    public function __construct(
        public ?string $url,
        public string  $label,
        public bool    $active,
    )
    {
    }
}
