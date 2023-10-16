<?php
/**********************************************************************************************************************/
/* THIS IS AN EXAMPLE FILE                                                                                            */
/**********************************************************************************************************************/
declare(strict_types=1);

use CanisLupus\ApiClients\PagSeguro\v1\Exceptions\PagSeguroApiException;
use CanisLupus\ApiClients\PagSeguro\v1\PagSeguroApiClient;
use CanisLupus\ApiClients\PagSeguro\v1\Enums\EnvironmentEnum;
use CanisLupus\ApiClients\PagSeguro\v1\PagSeguroApiConfig;

require('../../vendor/autoload.php');

$token = '#TOKEN#';

$clientPagSeguro = new PagSeguroApiClient(
    new PagSeguroApiConfig(EnvironmentEnum::Sandbox, $token)
);

try {
    // Calculate Fees
    $creditCardBin = 552100; // Primeiros 6 dígitos do número do cartão de crédito
    $value = 10000; // Valor como inteiro, representa R$ 100,00
    $maxInstallments = 10; // Quantidade máxima de parcelas
    $maxInstallmentsNoInterest = 4; // Número de parcelas sem juros

    $creditCardFees = $clientPagSeguro->charges->calculateFees($creditCardBin, $value, $maxInstallments, $maxInstallmentsNoInterest);


} catch (PagSeguroApiException $e) {
    die($e->getMessage());
}
