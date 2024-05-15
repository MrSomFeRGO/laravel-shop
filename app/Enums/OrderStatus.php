<?php

namespace App\Enums;

enum OrderStatus: string
{
    case DELIVERED = 'Доставлено';

    case DELIVERING = 'Доставляется';

    case PAYABLE = 'Требует оплаты по реквизитам';

    case PENDING = 'Ожидает подтверждения';

}
