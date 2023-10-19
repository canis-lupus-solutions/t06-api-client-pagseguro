<?php
/**********************************************************************************************************************/
/* THIS IS AN EXAMPLE FILE                                                                                            */
/**********************************************************************************************************************/
declare(strict_types=1);

use CanisLupus\ApiClients\PagSeguro\v1\Enums\PaymentMethodEnum;
use CanisLupus\ApiClients\PagSeguro\v1\Exceptions\PagSeguroApiException;
use CanisLupus\ApiClients\PagSeguro\v1\PagSeguroApiClient;
use CanisLupus\ApiClients\PagSeguro\v1\Enums\EnvironmentEnum;
use CanisLupus\ApiClients\PagSeguro\v1\PagSeguroApiConfig;
use CanisLupus\ApiClients\PagSeguro\v1\Resources\Common\AddressResource;
use CanisLupus\ApiClients\PagSeguro\v1\Resources\Common\AmountResource;
use CanisLupus\ApiClients\PagSeguro\v1\Resources\Common\BoletoResource;
use CanisLupus\ApiClients\PagSeguro\v1\Resources\Common\CardResource;
use CanisLupus\ApiClients\PagSeguro\v1\Resources\Common\CustomerResource;
use CanisLupus\ApiClients\PagSeguro\v1\Resources\Common\HolderResource;
use CanisLupus\ApiClients\PagSeguro\v1\Resources\Common\InstructionLinesResource;
use CanisLupus\ApiClients\PagSeguro\v1\Resources\Common\ItemResource;
use CanisLupus\ApiClients\PagSeguro\v1\Resources\Common\PaymentMethodResource;
use CanisLupus\ApiClients\PagSeguro\v1\Resources\Common\ShippingResource;
use CanisLupus\ApiClients\PagSeguro\v1\Resources\Orders\ChargeResource;
use CanisLupus\ApiClients\PagSeguro\v1\Resources\Orders\OrderResource;

require('../../vendor/autoload.php');

$token = '#TOKEN#';

$clientPagSeguro = new PagSeguroApiClient(
    new PagSeguroApiConfig(EnvironmentEnum::Sandbox, $token)
);

try {
    // Consultar Pedido
    $order = $clientPagSeguro->orders->view('ORDE_7060D052-23C5-49B7-9DB4-6B1B117F18D5');
    echo "<pre>";
    var_dump($order);
    echo "</pre>";
    die;

} catch (PagSeguroApiException $e) {
    die($e->getMessage());
}
