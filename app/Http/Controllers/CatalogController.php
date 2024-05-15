<?php

namespace App\Http\Controllers;

use App\Data\DeliveryRegionData;
use App\Data\FilterData;
use App\Data\PaginateProductData;
use App\Data\StandardData;
use App\Models\DeliveryRegion;
use App\Models\Product;
use App\Models\Standard;
use Illuminate\Database\Eloquent\Builder;

class CatalogController extends Controller
{
    public function index(FilterData $filter)
    {
        $request = $filter->delivery != 1 ?
            Product::whereHas('deliveryRegions', function (Builder $quarry) use ($filter) {
                $quarry->where('delivery_region_id', '=', $filter->delivery);
            }) :
            Product::with('deliveryRegions');

        return inertia('Catalog', [
            'products' => PaginateProductData::from(
                $filter->standard != 1 ?
                    $request->where('standard_id', '=', $filter->standard)->with('standard', 'productImages', 'deliveryRegions')->paginate(20)->toArray() :
                    $request->with('standard', 'productImages', 'deliveryRegions')->paginate(20)->toArray()),
            'standards' => StandardData::collect(Standard::all()),
            'delivery_regions' => DeliveryRegionData::collect(DeliveryRegion::all()),
        ]);
    }
}
