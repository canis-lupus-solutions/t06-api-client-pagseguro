<?php
declare(strict_types=1);

namespace CanisLupus\ApiClients\PagSeguro\v1\Resources\Common;

use CanisLupus\ApiClients\PagSeguro\v1\Traits\Arrayable;

class SummaryResource
{
    use Arrayable;


    /**
     * Valor total da cobrança. Apenas números inteiros positivos.
     * Exemplo: R$ 1.500,99 = 150099
     */
    protected int $total;

    /**
     * Valor que foi pago na cobrança. Apenas números inteiros positivos.
     * Exemplo: R$ 1.500,99 = 150099
     */
    protected int $paid;

    /**
     * Valor que foi devolvido da Cobrança. Apenas números inteiros positivos.
     * Exemplo: R$ 1.500,99 = 150099
     */
    protected int $refunded;


    /**
     * @param int $total
     * @param int $paid
     * @param int $refunded
     */
    public function __construct(int $total, int $paid, int $refunded)
    {
        $this->total = $total;
        $this->paid = $paid;
        $this->refunded = $refunded;
    }


    /* GETTERS/SETTERS */

    /**
     * @return int
     */
    public function getTotal(): int
    {
        return $this->total;
    }

    /**
     * @param int $total
     * @return SummaryResource
     */
    public function setTotal(int $total): SummaryResource
    {
        $this->total = $total;
        return $this;
    }

    /**
     * @return int
     */
    public function getPaid(): int
    {
        return $this->paid;
    }

    /**
     * @param int $paid
     * @return SummaryResource
     */
    public function setPaid(int $paid): SummaryResource
    {
        $this->paid = $paid;
        return $this;
    }

    /**
     * @return int
     */
    public function getRefunded(): int
    {
        return $this->refunded;
    }

    /**
     * @param int $refunded
     * @return SummaryResource
     */
    public function setRefunded(int $refunded): SummaryResource
    {
        $this->refunded = $refunded;
        return $this;
    }
}
