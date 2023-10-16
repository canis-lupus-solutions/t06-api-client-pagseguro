<?php
declare(strict_types=1);

namespace CanisLupus\ApiClients\PagSeguro\v1\Resources\PublicKeys;

class PublicKeyResource
{
    protected string $publicKey;
    protected int $createdAt;


    /**
     * @param string $publicKey
     * @param int $createdAt
     */
    public function __construct(string $publicKey, int $createdAt)
    {
        $this->publicKey = $publicKey;
        $this->createdAt = $createdAt;
    }


    /* GETTERS/SETTERS */

    /**
     * @return string
     */
    public function getPublicKey(): string
    {
        return $this->publicKey;
    }

    /**
     * @param string $publicKey
     */
    public function setPublicKey(string $publicKey): void
    {
        $this->publicKey = $publicKey;
    }

    /**
     * @return int
     */
    public function getCreatedAt(): int
    {
        return $this->createdAt;
    }

    /**
     * @param int $createdAt
     */
    public function setCreatedAt(int $createdAt): void
    {
        $this->createdAt = $createdAt;
    }
}
