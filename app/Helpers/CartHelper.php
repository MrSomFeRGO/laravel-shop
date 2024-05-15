<?php

namespace App\Helpers;

use App\Models\CartItem;
use Illuminate\Support\Facades\Session;

class CartHelper
{
    public static function fromCookieToDB(int $userId): void
    {
        $cartItemsInCookie = Session::get('cart');
        if ($cartItemsInCookie != null) {
            $cartItemsInDB = CartItem::all()->where('user_id', '=', $userId);

            foreach ($cartItemsInDB as $db) {
                foreach ($cartItemsInCookie as $key => $cookie) {
                    if ($db->product_id == $cookie['product']['id']) {
                        $db->update(['quantity' => $db->quantity + $cookie['quantity']]);
                        unset($cartItemsInCookie[$key]);
                    }
                }
            }
            array_map(function ($cartItem) use ($userId) {
                CartItem::create([
                    'user_id' => $userId,
                    'product_id' => $cartItem['product']['id'],
                    'quantity' => $cartItem['quantity'],
                ]);
            }, $cartItemsInCookie);
        }
    }
}
