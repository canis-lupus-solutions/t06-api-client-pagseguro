<?php
declare(strict_types=1);

namespace CanisLupus\ApiClients\PagSeguro\v1\Resources\Common;

use CanisLupus\ApiClients\PagSeguro\v1\Traits\Arrayable;

class ItemResource
{
    use Arrayable;


    protected string $referenceId;

    /**
     * Nome dado ao item.
     * 1-64 caracteres.
     * Exemplo: Nome do item
     */
    protected string $name;

    /**
     * Quantidade referente ao item.
     * Exemplo: 2
     */
    protected int $quantity;

    /**
     * Valor do item. Apenas números inteiros positivos.
     * Exemplo: R$ 5,00 = 500
     */
    protected int $unitAmount;


    /**
     * @param string $referenceId
     * @param string $name
     * @param int $quantity
     * @param int $unitAmount
     */
    public function __construct(string $referenceId, string $name, int $quantity, int $unitAmount)
    {
        $this->referenceId = $referenceId;
        $this->name = $name;
        $this->quantity = $quantity;
        $this->unitAmount = $unitAmount;
    }


    /* GETTERS/SETTERS */

    /**
     * @return string
     */
    public function getReferenceId(): string
    {
        return $this->referenceId;
    }

    /**
     * @param string $referenceId
     * @return ItemResource
     */
    public function setReferenceId(string $referenceId): ItemResource
    {
        $this->referenceId = $referenceId;
        return $this;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return ItemResource
     */
    public function setName(string $name): ItemResource
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return int
     */
    public function getQuantity(): int
    {
        return $this->quantity;
    }

    /**
     * @param int $quantity
     * @return ItemResource
     */
    public function setQuantity(int $quantity): ItemResource
    {
        $this->quantity = $quantity;
        return $this;
    }

    /**
     * @return int
     */
    public function getUnitAmount(): int
    {
        return $this->unitAmount;
    }

    /**
     * @param int $unitAmount
     * @return ItemResource
     */
    public function setUnitAmount(int $unitAmount): ItemResource
    {
        $this->unitAmount = $unitAmount;
        return $this;
    }
}
