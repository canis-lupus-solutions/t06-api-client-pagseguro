<?php
declare(strict_types=1);

namespace CanisLupus\ApiClients\PagSeguro\v1;

use CanisLupus\ApiClients\PagSeguro\v1\Enums\EnvironmentEnum;

class PagSeguroApiConfig
{
    protected EnvironmentEnum $environment;
    protected ?string $token = null;


    /**
     * @param EnvironmentEnum $environment
     * @param string|null $token
     */
    public function __construct(
        EnvironmentEnum $environment,
        ?string         $token
    )
    {
        $this->environment = $environment;
        $this->token = $token;
    }


    /**
     * @return EnvironmentEnum
     */
    public function getEnvironment(): EnvironmentEnum
    {
        return $this->environment;
    }

    /**
     * @param EnvironmentEnum $environment
     */
    public function setEnvironment(EnvironmentEnum $environment): void
    {
        $this->environment = $environment;
    }

    /**
     * @return string|null
     */
    public function getToken(): ?string
    {
        return $this->token;
    }

    /**
     * @param string|null $token
     */
    public function setToken(?string $token): void
    {
        $this->token = $token;
    }
}
