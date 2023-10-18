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
$token = '347097CF81FC454B9573BB30E248E709';

$clientPagSeguro = new PagSeguroApiClient(
    new PagSeguroApiConfig(EnvironmentEnum::Sandbox, $token)
);

try {
    // Criar e pegar pedido com Boleto

    $orderResource = new OrderResource();
    $orderResource->setReferenceId('ex-00001');
    $orderResource->setCustomer(new CustomerResource(
        'Jose da Silva',
        'c96827089160215759351@sandbox.pagseguro.com.br',
        '12345678909'
    ));
    $orderResource->setItems([
        new ItemResource('item-id-001', 'Item 01', 2, 4500), // 4500 é o valor referente à R$ 45,00
        new ItemResource('item-id-002', 'Item 02', 1, 6599) // 6599 é o valor referente à R$ 65,99
    ]);
    $orderResource->setNotificationUrls(['https://meusite.com/notificacoes']);
    $orderResource->setCharges([
        (new ChargeResource())
            ->setReferenceId('charge-id-001')
            ->setAmount(new AmountResource(15599, 'BRL')) // 15599 é o valor referente à R$ 155,99
            ->setPaymentMethod(
                (new PaymentMethodResource(PaymentMethodEnum::BOLETO))
                    ->setBoleto(
                        (new BoletoResource())
                            ->setDueDate((new DateTime('tomorrow'))->format('Y-m-d'))
                            ->setInstructionLines(
                                (new InstructionLinesResource())
                                    ->setLine1('Instrução linha 1')
                                    ->setLine2('Instrução linha 2')
                            )
                            ->setHolder(
                                (new HolderResource('Jose da Silva'))
                                    ->setTaxId('12345678909')
                                    ->setEmail('c96827089160215759351@sandbox.pagseguro.com.br')
                                    ->setAddress(
                                        (new AddressResource())
                                            ->setStreet('Avenida Brigadeiro Faria Lima')
                                            ->setNumber('1384')
                                            ->setComplement(null)
                                            ->setLocality('Pinheiros')
                                            ->setCity('São Paulo')
                                            ->setRegion('São Paulo')
                                            ->setRegionCode('SP')
                                            ->setCountry('Brasil')
                                            ->setPostalCode('01452002')
                                    )
                            )
                    )
            )
    ]);

    $newOrder = $clientPagSeguro->orders->create($orderResource);

    echo "<pre>";
    var_dump($newOrder);
    echo "</pre>";
    die;


} catch (PagSeguroApiException $e) {
    die($e->getMessage());
}
