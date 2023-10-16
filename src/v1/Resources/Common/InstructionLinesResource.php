<?php
declare(strict_types=1);

namespace CanisLupus\ApiClients\PagSeguro\v1\Resources\Common;

use CanisLupus\ApiClients\PagSeguro\v1\Traits\Arrayable;

class InstructionLinesResource
{
    use Arrayable;


    /**
     * Primeira linha de instruções sobre o pagamento do Boleto.
     * 1-75 caracteres.
     * Exemplo: Pagamento processado para DESC Fatura
     */
    protected ?string $line1 = null;

    /**
     * Segunda linha de instruções sobre o pagamento do Boleto.
     * 1-75 caracteres.
     * Exemplo: Via PagBank
     */
    protected ?string $line2 = null;


    /* GETTERS/SETTERS */

    /**
     * @return string|null
     */
    public function getLine1(): ?string
    {
        return $this->line1;
    }

    /**
     * @param string|null $line1
     * @return InstructionLinesResource
     */
    public function setLine1(?string $line1): InstructionLinesResource
    {
        $this->line1 = $line1;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getLine2(): ?string
    {
        return $this->line2;
    }

    /**
     * @param string|null $line2
     * @return InstructionLinesResource
     */
    public function setLine2(?string $line2): InstructionLinesResource
    {
        $this->line2 = $line2;
        return $this;
    }
}
