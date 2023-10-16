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
use CanisLupus\ApiClients\PagSeguro\v1\Resources\Common\CardResource;
use CanisLupus\ApiClients\PagSeguro\v1\Resources\Common\CustomerResource;
use CanisLupus\ApiClients\PagSeguro\v1\Resources\Common\HolderResource;
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
    // Create

    // Criar pedido passando um objeto OrderResource construído
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
    $orderResource->setShipping(new ShippingResource(
        (new AddressResource())
            ->setStreet('Rua A')
            ->setNumber('49')
            ->setComplement('apto 102')
            ->setLocality('Bairro B')
            ->setCity('Cidade C')
            ->setRegionCode('SP')
            ->setCountry('BRA')
            ->setPostalCode('01452002')
    ));
    $orderResource->setNotificationUrls(['https://meusite.com/notificacoes1']);
    $orderResource->setCharges([
        (new ChargeResource())
            ->setReferenceId('charge-id-001')
            ->setDescription('descricao da cobranca')
            ->setCreatedAt(new DateTime())
            ->setAmount(new AmountResource(15599, 'BRL')) // 15599 é o valor referente à R$ 155,99
            ->setPaymentMethod(
                (new PaymentMethodResource(PaymentMethodEnum::CREDIT_CARD))
                    ->setInstallments(1)
                    ->setCard(
                        (new CardResource())
                            ->setHolder(new HolderResource("Jose da Silva"))
                            // Pode passar diretamente os dados do cartão
                            ->setNumber('4242424242424242')->setExpMonth('12')->setExpYear('2032')
                            // Ou pode passar o cartão criptografado pelo javascript do PagSeguro
                            // ->setEncrypted($encryptedCard)
                    )
            )
    ]);

    $newOrder = $clientPagSeguro->orders->create($orderResource);


    // Criar pedido passando diretamente o array da estrutura requerida
    $newOrder = $clientPagSeguro->orders->create([
        'reference_id' => 'ex-00001',
        'customer' => [
            'name' => 'Jose da Silva',
            'email' => 'c96827089160215759351@sandbox.pagseguro.com.br',
            'tax_id' => '12345678909',
        ],
        'items' => [
            [
                'reference_id' => 'item-id-001',
                'name' => 'Item 01',
                'quantity' => '1',
                'unit_amount' => '15599', // Significa R$ 155,99
            ]
        ],
        'notification_urls' => ['https://meusite.com/notificacoes'],
        'charges' => [
            [
                'reference_id' => 'charge-id-001',
                'description' => 'descricao da cobranca',
                'amount' => [
                    'value' => '15599', // Significa R$ 155,99
                    'currency' => 'BRL',
                ],
                'payment_method' => [
                    'type' => 'CREDIT_CARD',
                    'installments' => '1',
                    'capture' => true,
                    'card' => [
                        // Pode passar diretamente os dados do cartão
                        'number' => '4242424242424242',
                        'exp_month' => '12',
                        'exp_year' => '2032',

                       // Ou pode passar o cartão criptografado pelo javascript do PagSeguro
                       // 'encrypted' => $encryptedCard,

                        'holder' => [
                            'name' => "Jose da Silva",
                        ],
                        'store' => false,
                    ],
                ]
            ]
        ],
    ]);

} catch (PagSeguroApiException $e) {
    die($e->getMessage());
}
