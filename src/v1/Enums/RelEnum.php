<?php
declare(strict_types=1);

namespace CanisLupus\ApiClients\PagSeguro\v1\Enums;

enum RelEnum: string
{
    case SELF = 'SELF';
    case CHARGE_CANCEL = 'CHARGE.CANCEL';
    case PAY = 'PAY';
}
