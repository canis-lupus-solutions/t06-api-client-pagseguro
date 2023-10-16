<?php
declare(strict_types=1);

namespace CanisLupus\ApiClients\PagSeguro\v1\Resources\Common;

use CanisLupus\ApiClients\PagSeguro\v1\Traits\Arrayable;

class PaymentResponseResource
{
    use Arrayable;


    /**
     * Código PagBank que indica o motivo da resposta de autorização no pagamento, tanto para pagamento
     * autorizado, quanto para negado.
     * Exemplo: 20000
     */
    protected ?string $code = null;

    /**
     * Mensagem amigável descrevendo motivo da não aprovação ou autorização da cobrança.
     * Compatível com o padrão ABECS - Normativo 21.
     * 5-100 caracteres.
     * Exemplo: SUCESSO
     */
    protected ?string $message = null;

    /**
     * NSU da autorização, caso o pagamento seja aprovado pelo Emissor.
     * 4-20 caracteres.
     * Exemplo: 032416400102
     */
    protected ?string $reference = null;

    protected ?RawDataResource $rawData = null;


    /* GETTERS/SETTERS */

    /**
     * @return string|null
     */
    public function getCode(): ?string
    {
        return $this->code;
    }

    /**
     * @param string|null $code
     * @return PaymentResponseResource
     */
    public function setCode(?string $code): PaymentResponseResource
    {
        $this->code = $code;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getMessage(): ?string
    {
        return $this->message;
    }

    /**
     * @param string|null $message
     * @return PaymentResponseResource
     */
    public function setMessage(?string $message): PaymentResponseResource
    {
        $this->message = $message;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getReference(): ?string
    {
        return $this->reference;
    }

    /**
     * @param string|null $reference
     * @return PaymentResponseResource
     */
    public function setReference(?string $reference): PaymentResponseResource
    {
        $this->reference = $reference;
        return $this;
    }

    /**
     * @return RawDataResource|null
     */
    public function getRawData(): ?RawDataResource
    {
        return $this->rawData;
    }

    /**
     * @param RawDataResource|null $rawData
     * @return PaymentResponseResource
     */
    public function setRawData(?RawDataResource $rawData): PaymentResponseResource
    {
        $this->rawData = $rawData;
        return $this;
    }
}
