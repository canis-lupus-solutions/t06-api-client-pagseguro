<?php
declare(strict_types=1);

namespace CanisLupus\ApiClients\PagSeguro\v1\Resources\Common;

use CanisLupus\ApiClients\PagSeguro\v1\Enums\WalletTypeEnum;
use CanisLupus\ApiClients\PagSeguro\v1\Traits\Arrayable;

class TokenDataResource
{
    use Arrayable;


    /**
     * Identificador de quem gerou o Token de Bandeira (Token Requestor).
     * 11 caracteres.
     * Exemplo: 12345678901
     */
    protected ?string $requestorId = null;

    /**
     * Tipo de carteira que armazenou o Token de Bandeira.
     */
    protected ?WalletTypeEnum $wallet = null;

    /**
     * Criptograma gerado pela bandeira.
     * 40 caracteres.
     * Exemplo:
     */
    protected ?string $cryptogram = null;

    /**
     * Identificador do domínio de origem da transação, comumente caracterizado em um formato de domínio reverso.
     * 150 caracteres.
     * Exemplo: br.com.pagbank
     */
    protected ?string $ecommerceDomain = null;

    /**
     * Conteúdo que indica o nível de confiança do token de rede.
     * Exemplo: 99
     */
    protected ?int $assuranceLevel = null;


    /* GETTERS/SETTERS */

    /**
     * @return string|null
     */
    public function getRequestorId(): ?string
    {
        return $this->requestorId;
    }

    /**
     * @param string|null $requestorId
     * @return TokenDataResource
     */
    public function setRequestorId(?string $requestorId): TokenDataResource
    {
        $this->requestorId = $requestorId;
        return $this;
    }

    /**
     * @return WalletTypeEnum|null
     */
    public function getWallet(): ?WalletTypeEnum
    {
        return $this->wallet;
    }

    /**
     * @param WalletTypeEnum|null $wallet
     * @return TokenDataResource
     */
    public function setWallet(?WalletTypeEnum $wallet): TokenDataResource
    {
        $this->wallet = $wallet;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getCryptogram(): ?string
    {
        return $this->cryptogram;
    }

    /**
     * @param string|null $cryptogram
     * @return TokenDataResource
     */
    public function setCryptogram(?string $cryptogram): TokenDataResource
    {
        $this->cryptogram = $cryptogram;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getEcommerceDomain(): ?string
    {
        return $this->ecommerceDomain;
    }

    /**
     * @param string|null $ecommerceDomain
     * @return TokenDataResource
     */
    public function setEcommerceDomain(?string $ecommerceDomain): TokenDataResource
    {
        $this->ecommerceDomain = $ecommerceDomain;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getAssuranceLevel(): ?int
    {
        return $this->assuranceLevel;
    }

    /**
     * @param int|null $assuranceLevel
     * @return TokenDataResource
     */
    public function setAssuranceLevel(?int $assuranceLevel): TokenDataResource
    {
        $this->assuranceLevel = $assuranceLevel;
        return $this;
    }
}
