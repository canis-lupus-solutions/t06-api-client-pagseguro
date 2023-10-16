<?php
declare(strict_types=1);

namespace CanisLupus\ApiClients\PagSeguro\v1\Enums;

enum AuthenticationMethodTypeEnum: string
{
    /**
     * Se o método de autenticação utilizado for 3DS.
     */
    case THREEDS = 'THREEDS';

    /**
     * Se o método de autenticação utilizado for InApp
     */
    case INAPP = 'INAPP';
}
