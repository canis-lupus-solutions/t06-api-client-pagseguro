<?php
declare(strict_types=1);

namespace CanisLupus\ApiClients\PagSeguro\v1\Resources\Common;

use CanisLupus\ApiClients\PagSeguro\v1\Traits\Arrayable;

class RawDataResource
{
    use Arrayable;


    protected ?string $authorizationCode = null;
    protected ?string $nsu = null;
    protected ?string $reasonCode = null;


    /* GETTERS/SETTERS */

    /**
     * @return string|null
     */
    public function getAuthorizationCode(): ?string
    {
        return $this->authorizationCode;
    }

    /**
     * @param string|null $authorizationCode
     * @return RawDataResource
     */
    public function setAuthorizationCode(?string $authorizationCode): RawDataResource
    {
        $this->authorizationCode = $authorizationCode;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getNsu(): ?string
    {
        return $this->nsu;
    }

    /**
     * @param string|null $nsu
     * @return RawDataResource
     */
    public function setNsu(?string $nsu): RawDataResource
    {
        $this->nsu = $nsu;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getReasonCode(): ?string
    {
        return $this->reasonCode;
    }

    /**
     * @param string|null $reasonCode
     * @return RawDataResource
     */
    public function setReasonCode(?string $reasonCode): RawDataResource
    {
        $this->reasonCode = $reasonCode;
        return $this;
    }
}
