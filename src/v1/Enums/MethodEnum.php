<?php
declare(strict_types=1);

namespace CanisLupus\ApiClients\PagSeguro\v1\Enums;

enum MethodEnum: string
{
    case GET = 'GET';
    case POST = 'POST';
    case PUT = 'PUT';
    case DELETE = 'DELETE';
}
