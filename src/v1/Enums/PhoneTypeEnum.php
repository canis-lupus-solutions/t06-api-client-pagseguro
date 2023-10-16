<?php
declare(strict_types=1);

namespace CanisLupus\ApiClients\PagSeguro\v1\Enums;

enum PhoneTypeEnum: string
{
    case MOBILE = 'MOBILE';
    case BUSINESS = 'BUSINESS';
    case HOME = 'HOME';
}
