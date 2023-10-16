<?php
declare(strict_types=1);

namespace CanisLupus\ApiClients\PagSeguro\v1\Resources\Common;

use CanisLupus\ApiClients\PagSeguro\v1\Traits\Arrayable;

class BoletoResource
{
    use Arrayable;


    /**
     * Data de vencimento do Boleto. Formato: “yyyy-MM-dd”.
     * 10 caracteres.
     * Exemplo: 2023-02-10
     */
    protected ?string $dueDate = null;

    /**
     * Contém as linhas de instrução do boleto.
     */
    protected ?InstructionLinesResource $instructionLines = null;

    /**
     * Contém as informações do responsável pelo pagamento do Boleto.
     */
    protected ?HolderResource $holder = null;


    /* GETTERS/SETTERS */

    /**
     * @return string|null
     */
    public function getDueDate(): ?string
    {
        return $this->dueDate;
    }

    /**
     * @param string|null $dueDate
     * @return BoletoResource
     */
    public function setDueDate(?string $dueDate): BoletoResource
    {
        $this->dueDate = $dueDate;
        return $this;
    }

    /**
     * @return InstructionLinesResource|null
     */
    public function getInstructionLines(): ?InstructionLinesResource
    {
        return $this->instructionLines;
    }

    /**
     * @param InstructionLinesResource|null $instructionLines
     * @return BoletoResource
     */
    public function setInstructionLines(?InstructionLinesResource $instructionLines): BoletoResource
    {
        $this->instructionLines = $instructionLines;
        return $this;
    }

    /**
     * @return HolderResource|null
     */
    public function getHolder(): ?HolderResource
    {
        return $this->holder;
    }

    /**
     * @param HolderResource|null $holder
     * @return BoletoResource
     */
    public function setHolder(?HolderResource $holder): BoletoResource
    {
        $this->holder = $holder;
        return $this;
    }
}
