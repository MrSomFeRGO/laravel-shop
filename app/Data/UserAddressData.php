<?php

namespace App\Data;

use Spatie\LaravelData\Data;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript]
class UserAddressData extends Data
{
    public function __construct(
        public ?int   $id,
        public string $country,
        public string $region,
        public string $city,
        public string $address,
        public string $zipcode,
        public string $fio,
        public string $phone_number,
    )
    {
    }

    public function toModelArray(): array
    {
        return [
            'country' => $this->country,
            'region' => $this->region,
            'city' => $this->city,
            'address' => $this->address,
            'zipcode' => $this->zipcode,
            'fio' => $this->fio,
            'phone_number' => $this->phone_number,
        ];
    }

    public static function messages(...$args): array
    {
        return [
            'country.required' => 'Укажите страну',
            'region.required' => 'Укажите край, область или регион',
            'city.required' => 'Укажите город',
            'address.required' => 'Укажите улицу, дом и квартиру',
            'zipcode.required' => 'Укажите почтовый индекс',
            'fio.required' => 'Укажите ФИО',
            'phone_number.required' => 'Укажите номер мобильного телефона'
        ];
    }
}
