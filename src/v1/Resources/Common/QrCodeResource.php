<?php
declare(strict_types=1);

namespace CanisLupus\ApiClients\PagSeguro\v1\Resources\Common;

use CanisLupus\ApiClients\PagSeguro\v1\Traits\Arrayable;
use DateTime;

class QrCodeResource
{
    use Arrayable;


    /**
     * Data de expiração do QR Code. Por padrão, o QR Code gerado tem validade de 24 horas caso o
     * parâmetro qr_codes.expiration_date não seja definido na requisição.
     * Exemplo: 2021-08-29T20:15:59-03:00
     */
    protected DateTime $expirationDate;

    /**
     * Contém informações do valor a ser utilizado no QR Code.
     */
    protected AmountResource $amount;


    /**
     * @param DateTime $expirationDate
     * @param AmountResource $amount
     */
    public function __construct(DateTime $expirationDate, AmountResource $amount)
    {
        $this->expirationDate = $expirationDate;
        $this->amount = $amount;
    }


    /* GETTERS/SETTERS */

    /**
     * @return DateTime
     */
    public function getExpirationDate(): DateTime
    {
        return $this->expirationDate;
    }

    /**
     * @param DateTime $expirationDate
     * @return QrCodeResource
     */
    public function setExpirationDate(DateTime $expirationDate): QrCodeResource
    {
        $this->expirationDate = $expirationDate;
        return $this;
    }

    /**
     * @return AmountResource
     */
    public function getAmount(): AmountResource
    {
        return $this->amount;
    }

    /**
     * @param AmountResource $amount
     * @return QrCodeResource
     */
    public function setAmount(AmountResource $amount): QrCodeResource
    {
        $this->amount = $amount;
        return $this;
    }
}
