<?php

namespace App\Data;

use Spatie\LaravelData\Data;

class FilterData extends Data
{
    public function __construct(
        public int $standard = 1,
        public int $delivery = 1,
    )
    {
    }
}
