<?php

namespace App\Data;

use Spatie\LaravelData\Attributes\MapInputName;
use Spatie\LaravelData\Data;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript]
class ProductData extends Data
{
    public function __construct(
        public int          $id,
        public string       $title,
        public string       $slug,
        public ?string      $description,
        #[MapInputName('certificate_url')]
        public ?string      $certificateUrl,
        #[MapInputName('conformity_declaration')]
        public ?string      $conformityDeclaration,
        /** @var DeliveryRegionData[] */
        #[MapInputName('delivery_regions')]
        public array        $deliveryRegions,
        /** @var ProductImageData[] */
        #[MapInputName('product_images')]
        public ?array       $productImages,
        public float        $price,
        #[MapInputName('price_units')]
        public string       $priceUnits,
        public StandardData $standard,
    )
    {
    }
}
