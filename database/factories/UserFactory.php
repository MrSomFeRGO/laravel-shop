<?php

namespace Database\Factories;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    protected $model = User::class;

    public function definition(): array
    {
        return [
            'email' => 'test@test.com',
            'password' => Hash::make('testtest'),
            'remember_token' => Str::random(10),
            'email_verified_at' => Carbon::now(),
        ];
    }
}
