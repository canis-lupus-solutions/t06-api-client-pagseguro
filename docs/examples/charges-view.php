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
    // Consultar Pagamento
    $charge = $clientPagSeguro->charges->view('CHAR_A83C8141-B843-4E27-BFD9-C096E7AA6E4C');
    echo "<pre>";
    var_dump($charge);
    echo "</pre>";
    die;

} catch (PagSeguroApiException $e) {
    die($e->getMessage());
}
