<?php
declare(strict_types=1);

namespace CanisLupus\ApiClients\PagSeguro\v1\Enums;

enum WalletTypeEnum: string
{
    case APPLE_PAY = 'APPLE_PAY';
    case GOOGLE_PAY = 'GOOGLE_PAY';
    case SAMSUNG_PAY = 'SAMSUNG_PAY';
    case MERCHANT_TOKENIZATION_PROGRAM = 'MERCHANT_TOKENIZATION_PROGRAM';
}
