<?php

namespace App\Data;

use Spatie\LaravelData\Data;

class CheckoutData extends Data
{
    public function __construct(
        public int     $addressId,
        public int     $paymentId,
        public array   $cartIds,
        public float   $totalPrice,
        public array   $products,
        public ?string $currentAccount,
        public ?string $bankAddress,
        public ?string $bik,
        public ?string $unp,
        public ?string $okpo,
    )
    {
    }
}
