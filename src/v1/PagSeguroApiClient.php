<?php
declare(strict_types=1);

namespace CanisLupus\ApiClients\PagSeguro\v1;

use CanisLupus\ApiClients\PagSeguro\v1\Handlers\ChargesHandler;
use CanisLupus\ApiClients\PagSeguro\v1\Handlers\OrdersHandler;
use CanisLupus\ApiClients\PagSeguro\v1\Handlers\PublicKeysHandler;

class PagSeguroApiClient
{
    public PublicKeysHandler $publicKeys;
    public OrdersHandler $orders;
    public ChargesHandler $charges;


    /**
     * @param PagSeguroApiConfig $config
     */
    public function __construct(
        PagSeguroApiConfig $config
    )
    {
        $this->publicKeys = new PublicKeysHandler($config);
        $this->orders = new OrdersHandler($config);
        $this->charges = new ChargesHandler($config);
    }
}
