<?php

namespace App\Http\Controllers;

use App\Data\CartData;
use App\Data\CheckoutData;
use App\Data\UserAddressData;
use App\Enums\OrderStatus;
use App\Enums\PaymentMethod;
use App\Models\CartItem;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\UserAddress;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    public function index(string $cartIds, float $totalPrice)
    {
        $cartItemIds = explode('-', $cartIds);
        $orders = array_map(function ($orderId) {
            $cartItem = CartItem::where('user_id', '=', Auth::id())->find($orderId);
            $cartItem['product'] = Product::with('productImages', 'deliveryRegions', 'standard')->find($cartItem->product_id);
            return $cartItem;
        }, $cartItemIds);
        return inertia('Checkout', [
            'user_addresses' => UserAddressData::collect(UserAddress::where('user_id', '=', Auth::id())->get()),
            'cart_items' => CartData::collect($orders),
            'total_price' => $totalPrice,
        ]);
    }

    public function store(CheckoutData $checkoutData)
    {
        if (UserAddress::where('user_id', '=', Auth::id())->find($checkoutData->addressId) == null) {
            return redirect()->back()->with('status', ['icon' => 'error', 'text' => 'Ошибка оформления!']);
        }

        if ($checkoutData->paymentId == 2 && ($checkoutData->currentAccount == null
                || $checkoutData->bankAddress == null || $checkoutData->bik == null
                || $checkoutData->unp == null || $checkoutData->okpo == null)) {
            return redirect()->back()->with('status', ['icon' => 'error', 'text' => 'Ошибка оформления!']);
        }
        $paymentMethod = '';
        switch ($checkoutData->paymentId) {
            case 0:
                $paymentMethod = PaymentMethod::CASH->value;
                break;
            case 1:
                $paymentMethod = PaymentMethod::CARD->value;
                break;
            case 2:
                $paymentMethod = PaymentMethod::ONLINE->value;
                break;
        }

        $order = Order::create([
            'user_id' => Auth::id(),
            'total_price' => $checkoutData->totalPrice,
            'user_address_id' => $checkoutData->addressId,
            'status' => OrderStatus::PENDING->value,
            'payment_method' => $paymentMethod,
            'current_account' => $checkoutData->currentAccount,
            'bank_address' => $checkoutData->bankAddress,
            'bik' => $checkoutData->bik,
            'unp' => $checkoutData->unp,
            'okpo' => $checkoutData->okpo]);
        array_map(function ($product) use ($order) {
            return OrderItem::create([
                'product_id' => $product['id'],
                'order_id' => $order->id,
                'quantity' => $product['quantity'],
                'total_price' => $product['totalPrice'],
            ]);
        }, $checkoutData->products);
        array_map(function ($id) {
            CartItem::where('user_id', '=', Auth::id())->find($id)->delete();
        }, $checkoutData->cartIds);
        return redirect()->route('profile.index')->with('status', ['icon' => 'success', 'text' => 'Заказ успешно оформлен']);
    }
}
