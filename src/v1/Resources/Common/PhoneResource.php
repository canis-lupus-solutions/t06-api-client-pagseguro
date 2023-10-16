<?php
declare(strict_types=1);

namespace CanisLupus\ApiClients\PagSeguro\v1\Resources\Common;

use CanisLupus\ApiClients\PagSeguro\v1\Enums\PhoneTypeEnum;
use CanisLupus\ApiClients\PagSeguro\v1\Traits\Arrayable;

class PhoneResource
{
    use Arrayable;


    /**
     * Código de operadora do País (DDI).
     * Exemplo: 55
     */
    protected int $country;

    /**
     * Código de operadora local (DDD).
     * Exemplo: 021
     */
    protected int $area;

    /**
     * Número do telefone.
     * Exemplo: 123456789
     */
    protected int $number;

    /**
     * Indica o tipo de telefone.
     */
    protected PhoneTypeEnum $type;


    /**
     * @param int $country
     * @param int $area
     * @param int $number
     * @param PhoneTypeEnum $type
     */
    public function __construct(int $country, int $area, int $number, PhoneTypeEnum $type)
    {
        $this->country = $country;
        $this->area = $area;
        $this->number = $number;
        $this->type = $type;
    }


    /* GETTERS/SETTERS */

    /**
     * @return int
     */
    public function getCountry(): int
    {
        return $this->country;
    }

    /**
     * @param int $country
     * @return PhoneResource
     */
    public function setCountry(int $country): PhoneResource
    {
        $this->country = $country;
        return $this;
    }

    /**
     * @return int
     */
    public function getArea(): int
    {
        return $this->area;
    }

    /**
     * @param int $area
     * @return PhoneResource
     */
    public function setArea(int $area): PhoneResource
    {
        $this->area = $area;
        return $this;
    }

    /**
     * @return int
     */
    public function getNumber(): int
    {
        return $this->number;
    }

    /**
     * @param int $number
     * @return PhoneResource
     */
    public function setNumber(int $number): PhoneResource
    {
        $this->number = $number;
        return $this;
    }

    /**
     * @return PhoneTypeEnum
     */
    public function getType(): PhoneTypeEnum
    {
        return $this->type;
    }

    /**
     * @param PhoneTypeEnum $type
     * @return PhoneResource
     */
    public function setType(PhoneTypeEnum $type): PhoneResource
    {
        $this->type = $type;
        return $this;
    }
}
