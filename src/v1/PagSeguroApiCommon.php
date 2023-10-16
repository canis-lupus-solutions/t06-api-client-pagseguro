<?php
declare(strict_types=1);

namespace CanisLupus\ApiClients\PagSeguro\v1;

class PagSeguroApiCommon
{
    public static function camelCaseToSnakeCase(string $input): string
    {
        return strtolower(preg_replace('/(?<!^)[A-Z]/', '_$0', $input));
    }
}
