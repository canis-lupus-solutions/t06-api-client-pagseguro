<?php
declare(strict_types=1);

namespace CanisLupus\ApiClients\PagSeguro\v1\Resources\Common;

use CanisLupus\ApiClients\PagSeguro\v1\Traits\Arrayable;

class BoletoResource
{
    use Arrayable;

    protected ?string $id = null;
    protected ?string $barcode = null;
    protected ?string $formattedBarcode = null;

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
    public function getId(): ?string
    {
        return $this->id;
    }

    /**
     * @param string|null $id
     * @return BoletoResource
     */
    public function setId(?string $id): BoletoResource
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getBarcode(): ?string
    {
        return $this->barcode;
    }

    /**
     * @param string|null $barcode
     * @return BoletoResource
     */
    public function setBarcode(?string $barcode): BoletoResource
    {
        $this->barcode = $barcode;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getFormattedBarcode(): ?string
    {
        return $this->formattedBarcode;
    }

    /**
     * @param string|null $formattedBarcode
     * @return BoletoResource
     */
    public function setFormattedBarcode(?string $formattedBarcode): BoletoResource
    {
        $this->formattedBarcode = $formattedBarcode;
        return $this;
    }

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
