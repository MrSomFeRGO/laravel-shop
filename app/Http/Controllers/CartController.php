<?php

namespace App\Http\Controllers;

use App\Data\CartData;
use App\Models\CartItem;
use App\Models\Product;
use Auth;
use Illuminate\Http\Request;
use Session;

class CartController extends Controller
{
    public function index()
    {
        // Для не авторизированных пользователей
        if (Auth::user() == null) {
            $cartItems = Session::get('cart');
            if($cartItems == null){
                return inertia('Cart', ['cart_items' => []]);
            }
            usort($cartItems, function ($a, $b){return $a['id'] > $b['id'];});
            return inertia('Cart', ['cart_items' => $cartItems]);
        }

        // Для авторизированных пользователей
        $cartItems = array_map(function ($cartItem) {
            $cartItem['product'] = Product::with('productImages', 'deliveryRegions', 'standard')->find($cartItem['product_id']);
            return $cartItem;
        }, CartItem::where('user_id', '=', Auth::id())->get()->toArray());
        usort($cartItems, function ($a, $b){return $a['id'] > $b['id'];});
        return inertia('Cart', [
            'cart_items' => CartData::collect($cartItems)
        ]);
    }

    public function store(int $id, Request $request)
    {
        // Для не авторизированных пользователей
        if (Auth::user() == null) {
            $cartItems = Session::get('cart');
            $cartItemsLastId = Session::get('cart_id');
            if ($cartItemsLastId == null) {
                Session::put('cart_id', 1);
                $cartItemsLastId = 1;
            }
            $newCartItem = CartData::from([
                'id' => $cartItemsLastId,
                'product' => Product::with('productImages', 'standard', 'deliveryRegions')->find($id),
                'quantity' => $request->quantity,
            ])->toArray();

            if ($cartItems == null) {
                $cartItems = array();
            }

            foreach ($cartItems as $key => $cartItem) {
                if ($cartItem['product']['id'] == $id) {
                    $cartItem['quantity'] = $cartItem['quantity'] + $request->quantity;
                    $cartItems[$key] = $cartItem;
                    Session::put('cart',$cartItems);
                    return redirect()->back()->with('status', ['icon' => 'success', 'text' => 'Товар успешно добавлен']);
                }
            }

            $cartItems[] = $newCartItem;
            Session::put('cart', $cartItems);
            Session::put('cart_id', $cartItemsLastId + 1);
            return redirect()->back()->with('status', ['icon' => 'success', 'text' => 'Товар успешно добавлен']);
        }

        // Для авторизированных пользователей
        $cartItem = CartItem::where('product_id', '=', $id)->where('user_id', '=', Auth::id())->first();
        if ($cartItem != null) {
            $cartItem->update(['quantity' => $cartItem->quantity + $request->quantity]);
            return redirect()->back()->with('status', ['icon' => 'success', 'text' => 'Товар успешно добавлен']);
        }
        CartItem::create([
            'user_id' => Auth::id(),
            'product_id' => $id,
            'quantity' => $request->quantity,
        ]);
        return redirect()->back()->with('status', ['icon' => 'success', 'text' => 'Товар успешно добавлен']);
    }

    public function update(int $id, Request $request){
        // Для не авторизированных пользователей
        if (Auth::user() == null) {
            $cartItems = Session::get('cart');
            foreach ($cartItems as $key => $cartItem) {
                if ($cartItem['id'] == $id) {
                    $cartItem['quantity'] = $request->quantity;
                    $cartItems[$key] = $cartItem;
                    Session::put('cart',$cartItems);
                    return redirect()->back();
                }
            }
        }

        // Для авторизированных пользователей
        $cartItem = CartItem::where('id', '=', $id)->where('user_id', '=', Auth::id())->first();
        $cartItem->update(['quantity' => $request->quantity]);
        return redirect()->back();
    }

    public function destroy(int $id)
    {
        // Для не авторизированных пользователей
        if (Auth::user() == null) {
            $cartItems = Session::get('cart');
            $newCartItems = array();
            foreach ($cartItems as $key => $cartItem) {
                if ($cartItem['id'] != $id) {
                    $newCartItems[] = $cartItem;
                }
            }
            Session::put('cart', $newCartItems);
            return redirect()->back()->with('status', ['icon' => 'success', 'text' => 'Товар успешно удалён']);
        }

        // Для авторизированных пользователей
        CartItem::where('id', '=', $id)->where('user_id', '=', Auth::id())->first()->delete();
        return redirect()->back()->with('status', ['icon' => 'success', 'text' => 'Товар успешно удалён']);
    }
}
