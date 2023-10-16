<?php
declare(strict_types=1);

namespace CanisLupus\ApiClients\PagSeguro\v1\Resources\Common;

use CanisLupus\ApiClients\PagSeguro\v1\Traits\Arrayable;

class AmountResource
{
    use Arrayable;


    /**
     * Valor a ser cobrado em centavos. Apenas números inteiros positivos.
     * Exemplo: R$ 1.500,99 = 150099
     */
    protected int $value;

    /**
     * Código de moeda ISO de três letras, em maiúsculas. Por enquanto, apenas o Real brasileiro é suportado (“BRL”).
     * 3 caracteres.
     * Exemplo: BRL
     */
    protected string $currency;

    /**
     * Contém um resumo de valores da cobrança.
     */
    protected ?SummaryResource $summary = null;


    /**
     * @param int $value
     * @param string $currency
     */
    public function __construct(int $value, string $currency)
    {
        $this->value = $value;
        $this->currency = $currency;
    }


    /* GETTERS/SETTERS */

    /**
     * @return int
     */
    public function getValue(): int
    {
        return $this->value;
    }

    /**
     * @param int $value
     * @return AmountResource
     */
    public function setValue(int $value): AmountResource
    {
        $this->value = $value;
        return $this;
    }

    /**
     * @return string
     */
    public function getCurrency(): string
    {
        return $this->currency;
    }

    /**
     * @param string $currency
     * @return AmountResource
     */
    public function setCurrency(string $currency): AmountResource
    {
        $this->currency = $currency;
        return $this;
    }

    /**
     * @return SummaryResource|null
     */
    public function getSummary(): ?SummaryResource
    {
        return $this->summary;
    }

    /**
     * @param SummaryResource|null $summary
     * @return AmountResource
     */
    public function setSummary(?SummaryResource $summary): AmountResource
    {
        $this->summary = $summary;
        return $this;
    }
}
