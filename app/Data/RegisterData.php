<?php

namespace App\Data;

use App\Models\User;
use Spatie\LaravelData\Attributes\Validation\Email;
use Spatie\LaravelData\Attributes\Validation\Max;
use Spatie\LaravelData\Attributes\Validation\Min;
use Spatie\LaravelData\Attributes\Validation\Same;
use Spatie\LaravelData\Attributes\Validation\Unique;
use Spatie\LaravelData\Data;

class RegisterData extends Data
{
    public function __construct(
        #[Email]
        #[Unique(User::class, 'email')]
        public string $email,
        #[Min(8)]
        #[Max(32)]
        public string $password,
        #[Min(8)]
        #[Max(32)]
        #[Same('password')]
        public string $confirmPassword,
    )
    {
    }

    public static function messages(): array
    {
        return [
            'email.required' => 'Это поле обязательное!',
            'email.email' => 'В поле должен быть указан верный адрес электронной почты.',
            'email.unique' => 'Этот адрес почты уже занят!',
            'password.required' => 'Это поле обязательное!',
            'password.min' => 'Поле пароля должно содержать не менее 8 символов.',
            'password.max' => 'Поле пароля должно содержать не более 32 символов.',
            'confirmPassword.required' => 'Это поле обязательное!',
            'confirmPassword.min' => 'Поле пароля должно содержать не менее 8 символов.',
            'confirmPassword.max' => 'Поле пароля должно содержать не более 32 символов.',
            'confirmPassword.same'=> 'Это поле должно совпадать с паролем.'
        ];
    }
}
