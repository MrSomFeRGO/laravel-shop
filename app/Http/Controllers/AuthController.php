<?php

namespace App\Http\Controllers;

use App\Data\LoginData;
use App\Helpers\CartHelper;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function index()
    {
        return inertia('Login');
    }

    public function store(LoginData $data)
    {
        // Пробуем авторизировать пользователя
        if (!Auth::attempt($data->toArray(), true)) {
            return redirect()->back()->withErrors(['email' => 'Неверная почта или пароль!']);
        }

        // Добавляем в корзину пользователя продукты добавленные без авторизации
        CartHelper::fromCookieToDB(Auth::id());

        // Создаём сессию и отправляем на домашнюю страницу
        request()->session()->regenerate();
        if (Auth::user()->hasVerifiedEmail()) {
            return redirect()->route('home.index');
        }
        return redirect()->route('home.index')->with('status', ['icon' => 'error', 'text' => 'Подтвердите адрес почты!']);
    }


    public function destroy()
    {
        auth()->logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();
        return redirect()->back();
    }
}
