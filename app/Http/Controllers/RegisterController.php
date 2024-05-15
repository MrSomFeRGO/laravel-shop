<?php

namespace App\Http\Controllers;

use App\Data\RegisterData;
use App\Helpers\CartHelper;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    public function index()
    {
        return inertia('Register');
    }

    public function store(RegisterData $data)
    {
        $user = User::create($data->toArray());

        // Добавляем в корзину пользователя продукты добавленные без авторизации
        CartHelper::fromCookieToDB($user->id);

        event(new Registered($user));
        Auth::login($user);
        return redirect()->route('home.index')->with('status', ['icon' => 'success', 'text' => 'Вам отправлено письмо для подтверждения почты']);
    }
}
