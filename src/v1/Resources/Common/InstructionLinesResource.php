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
    protected ?string $line_1 = null;

    /**
     * Segunda linha de instruções sobre o pagamento do Boleto.
     * 1-75 caracteres.
     * Exemplo: Via PagBank
     */
    protected ?string $line_2 = null;


    /* GETTERS/SETTERS */

    /**
     * @return string|null
     */
    public function getLine1(): ?string
    {
        return $this->line_1;
    }

    /**
     * @param string|null $line_1
     * @return InstructionLinesResource
     */
    public function setLine1(?string $line_1): InstructionLinesResource
    {
        $this->line_1 = $line_1;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getLine2(): ?string
    {
        return $this->line_2;
    }

    /**
     * @param string|null $line_2
     * @return InstructionLinesResource
     */
    public function setLine2(?string $line_2): InstructionLinesResource
    {
        $this->line_2 = $line_2;
        return $this;
    }
}
