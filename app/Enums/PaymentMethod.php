<?php

namespace App\Enums;

enum PaymentMethod: string
{
    case CASH = 'Наличными при получении';

    case CARD = 'Картой при получении';

    case ONLINE = 'Онлайн по реквизитам';
}
