<?php

namespace App\Data;

use Spatie\LaravelData\Data;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript]
class OrderData extends Data
{
    public function __construct(
        public int             $id,
        public UserAddressData $address,
        /** @var OrderItemData[] */
        public array           $order_items,
        public float           $total_price,
        public string          $status,
        public ?array  $allStatuses,
        public string          $payment_method,
        public ?string $current_account,
        public ?string $bank_address,
        public ?string $bik,
        public ?string $unp,
        public ?string $okpo,
        public ?string $doc_url,
    )
    {
    }
}
