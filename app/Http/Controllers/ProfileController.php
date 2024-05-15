<?php

namespace App\Http\Controllers;

use App\Data\OrderData;
use App\Data\UserAddressData;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\UserAddress;
use Auth;

// TODO: Сделать товары soft deleted
class ProfileController extends Controller
{
    public function index()
    {
        $orders = Order::where('user_id', '=', Auth::id())->get()->toArray();
        $orders = array_map(function ($order) {
            $order['address'] = UserAddress::withTrashed()->find($order['user_address_id']);
            $orderItems = OrderItem::where('order_id', '=', $order['id'])->get()->toArray();
            $order['order_items'] = array_map(function ($orderItem) {
                $orderItem['product'] = Product::with('deliveryRegions', 'standard', 'productImages')->where('id', '=', $orderItem['product_id'])->first();
                return $orderItem;
            }, $orderItems);
            return $order;
        }, $orders);
        usort($orders, function ($a, $b) {
            return strcmp($b['id'], $a['id']);
        });
        $addresses = UserAddress::where('user_id', '=', Auth::id())->get()->toArray();
        usort($addresses, function ($a, $b) {
            return strcmp($b['id'], $a['id']);
        });
        return inertia('Profile', [
            'user_addresses' => UserAddressData::collect($addresses),
            'orders' => OrderData::collect($orders),
        ]);
    }

}
