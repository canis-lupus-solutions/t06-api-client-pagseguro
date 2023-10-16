<?php
declare(strict_types=1);

namespace CanisLupus\ApiClients\PagSeguro\v1\Enums;

enum RecurringTypeEnum: string
{
    /**
     * Para a primeira cobrança da recorrência.
     */
    case INITIAL = 'INITIAL';

    /**
     * Para as cobranças subsequentes.
     */
    case SUBSEQUENT = 'SUBSEQUENT';
}
