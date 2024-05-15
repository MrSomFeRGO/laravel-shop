<?php

namespace App\Http\Controllers;

use App\Data\OrderData;
use App\Enums\OrderStatus;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\UserAddress;
use Illuminate\Http\Request;
use Str;

class EditOrdersController extends Controller
{
    public function index()
    {
        $orders = Order::all()->toArray();
        $orders = array_map(function ($order) {
            $order['address'] = UserAddress::withTrashed()->find($order['user_address_id']);
            $orderItems = OrderItem::where('order_id', '=', $order['id'])->get()->toArray();
            $order['order_items'] = array_map(function ($orderItem) {
                $orderItem['product'] = Product::with('deliveryRegions', 'standard', 'productImages')->where('id', '=', $orderItem['product_id'])->first();
                return $orderItem;
            }, $orderItems);
            $order['allStatuses'] = array(['Все статусы', OrderStatus::PENDING->value, OrderStatus::PAYABLE->value, OrderStatus::DELIVERING->value, OrderStatus::DELIVERED->value]);
            return $order;
        }, $orders);
        usort($orders, function ($a, $b) {
            return strcmp($b['id'], $a['id']);
        });
        return inertia('EditOrders', [
            'orders' => OrderData::collect($orders),
        ]);
    }

    public function store(Request $request)
    {
        if ($request->get('id') == null || $request->get('newStatus') == null || OrderStatus::tryFrom($request->get('newStatus')) == null) {
            return redirect()->back()->with('status', ['icon' => 'error', 'text' => 'Ошибка сохранения!']);
        }
        $order = Order::find($request->get('id'));
        $order->update(['status' => $request->get('newStatus')]);
        //$order->save();
        return redirect()->back()->with('status', ['icon' => 'success', 'text' => 'Статус изменён!']);
    }

    public function upload(Request $request, int $id)
    {
        if ($request->file('doc') == null) {
            return redirect()->back();
        }
        $filename = Str::slug(pathinfo($request->file('doc')->getClientOriginalName(), PATHINFO_FILENAME));
        $filename .= '-';
        $filename .= Str::random(6);
        $filename .= '.';
        $filename .= $request->file('doc')->getClientOriginalExtension();
        $request->file('doc')->storeAs('', $filename, 'documents');
        Order::find($id)->update(['doc_url' => "/docs/$filename"]);
        return redirect()->back()->with('status', ['icon' => 'success', 'text' => 'Документ загружен!']);
    }
}
