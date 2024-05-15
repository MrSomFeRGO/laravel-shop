<?php

namespace App\Data;

use Spatie\LaravelData\Attributes\Validation\Email;
use Spatie\LaravelData\Attributes\Validation\Max;
use Spatie\LaravelData\Attributes\Validation\Min;
use Spatie\LaravelData\Data;

class LoginData extends Data
{
    public function __construct(
        #[Email]
        public string $email,
        #[Min(8)]
        #[Max(32)]
        public string $password,
    )
    {
    }

    public static function messages(): array
    {
        return [
            'email.required' => 'Это поле обязательное!',
            'email.email' => 'В поле должен быть указан верный адрес электронной почты.',
            'password.required' => 'Это поле обязательное!',
            'password.min' => 'Поле пароля должно содержать не менее 8 символов.',
            'password.max' => 'Поле пароля должно содержать не более 32 символов.',
        ];
    }
}
