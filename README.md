# API CLIENT - PAG-SEGURO

Cliente para integração com a API do sistema PagSeguro. [Conheça o PagSeguro](https://pagseguro.uol.com.br)

Este cliente se refere à mais recente API do PagSeguro, que está documentada em https://dev.pagbank.uol.com.br/reference/introducao

## Instalação

### Composer

```
composer require canislupus/api-client-pagseguro
```

## Utilização

~~~php
use CanisLupus\ApiClients\PagSeguro\v1\PagSeguroApiClient;
use CanisLupus\ApiClients\PagSeguro\v1\Enums\EnvironmentEnum;
use CanisLupus\ApiClients\PagSeguro\v1\PagSeguroApiConfig;
use CanisLupus\ApiClients\PagSeguro\v1\Exceptions\PagSeguroApiException;

// Inicialize o cliente passando um objeto de configuração
$clientPagSeguro = new PagSeguroApiClient(
    new PagSeguroApiConfig(EnvironmentEnum::Sandbox, '#SEU-TOKEN-PAGSEGURO#')
);

// Use o cliente
try {
    // Por exemplo, para criar uma chave-pública
    $newPublicKey = $clientPagSeguro->publicKeys->create();
    
    // Para criar um pedido (veja nos exemplos abaixo como passar os $dadosPedido)
    $newOrder = $clientPagSeguro->orders->create($dadosPedido);
    
} catch (PagSeguroApiException $e) {
    die($e->getMessage());
}
~~~

### Pode-se criar um pedido passando um objeto OrderResource construído 

~~~php
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
$orderResource->setNotificationUrls(['https://meusite.com/notificacoes1']);
$orderResource->setCharges([
    (new ChargeResource())
        ->setReferenceId('charge-id-001')
        ->setDescription('descricao da cobranca')
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
~~~

### Ou pode-se criar um pedido passando diretamente o array da estrutura requerida

~~~php
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
                    'holder' => [
                        'name' => "Jose da Silva",
                    ],
                    'store' => false,
                    
                    // Pode passar diretamente os dados do cartão
                    'number' => '4242424242424242',
                    'exp_month' => '12',
                    'exp_year' => '2032',

                     // Ou pode passar o cartão criptografado pelo javascript do PagSeguro
                     //'encrypted' => $encryptedCard,
                ],
            ]
        ]
    ],
]);
~~~

## Mais exemplos

Mais exemplos podem ser encontrados na pasta docs/examples




## Abrangência

<table>
<tr>
    <td>Total de Endpoints</td>
    <td>35</td>
</tr>
<tr>
    <td>Total de Endpoints abrangidos</td>
    <td>6</td>
</tr>
<tr>
    <td>Percentual abrangido</td>
    <td>17,14%</td>
</tr>
</table>



### Lista de API's

| **Grupo**                        | **Recurso**                                                 | **Situação** |
|----------------------------------|-------------------------------------------------------------|:------------:|
| Chaves Públicas                  | [POST] Criar chave pública                                  |     100%     |
| Chaves Públicas                  | [GET] Consultar chave pública                               |     100%     |
| Chaves Públicas                  | [PUT] Alterar chave pública                                 |      0%      |
| Connect                          | [POST] Criar aplicação                                      |      0%      |
| Connect                          | [GET] Consultar aplicação                                   |      0%      | 
| Connect                          | [POST] Solicitar autorização via SMS                        |      0%      |
| Connect                          | [POST] Obter access token                                   |      0%      |
| Connect                          | [POST] Obter access token para transferência                |      0%      |
| Connect                          | [POST] Renovar access token                                 |      0%      |
| Connect                          | [POST] Revogar access token                                 |      0%      |
| Certificado Digital              | [POST] Criar certificado digital                            |      0%      |
| Cadastro                         | [POST] Criar conta                                          |      0%      |
| Cadastro                         | [GET] Consultar conta                                       |      0%      |
| Pedidos & Pagamentos (Order)     | [POST] Criar pedido                                         |     100%     |
| Pedidos & Pagamentos (Order)     | [GET] Consultar pedido                                      |     100%     |
| Pedidos & Pagamentos (Order)     | [GET] Consultar pedido através de parâmetros                |      0%      |
| Pedidos & Pagamentos (Order)     | [POST] Pagar pedido                                         |      0%      |
| Pedidos & Pagamentos (Order)     | [GET] Consultar pagamento                                   |     100%     |
| Pedidos & Pagamentos (Order)     | [POST] Capturar pagamento                                   |      0%      |
| Pedidos & Pagamentos (Order)     | [POST] Cancelar pagamento                                   |      0%      |
| Pedidos & Pagamentos (Order)     | [POST] Criar sessão de autenticação 3DS                     |      0%      |
| Pedidos & Pagamentos (Order)     | [GET] Consultar juros de uma transação                      |     100%     |
| Pedidos & Pagamentos (Order)     | [POST] Validar e armazenar um cartão no PagBank             |      0%      |
| Pedidos com Divisão do Pagamento | [POST] Criar um pedido com divisão do pagamento             |      0%      |
| Pedidos com Divisão do Pagamento | [GET] Consultar um pedido com divisão do pagamento          |      0%      |
| Pedidos com Divisão do Pagamento | [GET] Consultar dados da divisão do pagamento               |      0%      |
| Pedidos com Divisão do Pagamento | [POST] Cancelar um pedido com divisão do pagamento          |      0%      |
| Transferência                    | [POST] Criar transferência                                  |      0%      |
| Transferência                    | [GET] Consultar transferência pelo código da transação      |      0%      |
| Transferência                    | [GET] Consultar transferência pelo ID do cliente ou período |      0%      |
| Transferência                    | [GET] Consultar transferência pelo ID                       |      0%      |
| Checkout PagBank                 | [POST] Criar um Checkout                                    |      0%      |
| Checkout PagBank                 | [GET] Consultar um Checkout                                 |      0%      |
| Checkout PagBank                 | [POST] Ativar um Checkout                                   |      0%      |
| Checkout PagBank                 | [POST] Inativar um Checkout                                 |      0%      |


## Licença

- MIT License
