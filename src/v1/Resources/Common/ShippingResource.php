<?php
declare(strict_types=1);

namespace CanisLupus\ApiClients\PagSeguro\v1\Resources\Common;

use CanisLupus\ApiClients\PagSeguro\v1\Traits\Arrayable;

class ShippingResource
{
    use Arrayable;


    /**
     * Contém informações do endereço de entrega do pedido.
     */
    protected AddressResource $address;


    /**
     * @param AddressResource $address
     */
    public function __construct(AddressResource $address)
    {
        $this->address = $address;
    }


    /* GETTERS/SETTERS */

    /**
     * @return AddressResource
     */
    public function getAddress(): AddressResource
    {
        return $this->address;
    }

    /**
     * @param AddressResource $address
     * @return ShippingResource
     */
    public function setAddress(AddressResource $address): ShippingResource
    {
        $this->address = $address;
        return $this;
    }
}
