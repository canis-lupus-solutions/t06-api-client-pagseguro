<?php
declare(strict_types=1);

namespace CanisLupus\ApiClients\PagSeguro\v1\Enums;

enum CreditCardBrandEnum: string
{
    case VISA = 'VISA';
    case MASTERCARD = 'MASTERCARD';
}
