<?php
declare(strict_types=1);

namespace CanisLupus\ApiClients\PagSeguro\v1\Resources\Common;

use CanisLupus\ApiClients\PagSeguro\v1\Traits\Arrayable;

class CardResource
{
    use Arrayable;


    /**
     * Identificador PagBank do Cartão de Crédito salvo (Cartão Tokenizado pelo PagBank).
     * Função indisponível para o método de pagamento Cartão de Débito e Token de Bandeira.
     * 41 caracteres.
     * Exemplo: CARD_CCFE8D12-79E9-4ADF-920B-A54E51D8DA6E
     */
    protected ?string $id = null;

    /**
     * Número do Cartão de Crédito ou Cartão de Débito.
     * 14-19 caracteres.
     * Exemplo: 4111111111111111
     */
    protected ?string $number = null;

    /**
     * Número do Token de Bandeira.
     * 14-19 caracteres.
     * Exemplo: 1234567890000000
     */
    protected ?string $networkToken = null;

    /**
     * Mês de expiração do Cartão de Crédito, Cartão de Débito ou Token de Bandeira.
     * Exemplo: 12
     */
    protected ?string $expMonth = null;

    /**
     * Ano de expiração do Cartão de Crédito, Cartão de Débito ou Token de Bandeira.
     * Exemplo: 2026
     */
    protected ?string $expYear = null;

    /**
     * Código de Segurança do Cartão de Crédito, Cartão de Débito ou Token de Bandeira.
     * 3/4 caracteres.
     * Exemplo: 2026
     */
    protected ?string $securityCode = null;

    protected ?string $encrypted = null;

    /**
     * Indica se o cartão deverá ser armazenado no PagBank para futuras compras. Função indisponível para o método de
     * pagamento Cartão de Débito e Token de Bandeira.
     * Informar false ou omitir este parâmetro fará com que o cartão não seja armazenado.
     * Informar true fará com que o cartão seja armazenado. Na resposta da requisição irá receber o token do cartão
     * em payment_method.card.id.
     */
    protected ?bool $store = false;

    /**
     * Bandeira do cartão.
     * 20 caracteres.
     * Exemplo: visa
     */
    protected ?string $brand = null;

    /**
     * Retornado quando um Cartão de Crédito foi do tipo PRE_PAID.
     * 20 caracteres.
     * Exemplo:
     */
    protected ?string $product = null;

    /**
     * Seis primeiros números do Cartão ou Token de Bandeira (BIN).
     * Exemplo: 411111
     */
    protected ?string $firstDigits = null;

    /**
     * Quatro últimos números do Cartão ou Token de Bandeira.
     * Exemplo: 1111
     */
    protected ?string $lastDigits = null;

    /**
     * Contém as informações do portador do Cartão de Crédito, Cartão de Débito e Token de Bandeira.
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
     * @return CardResource
     */
    public function setId(?string $id): CardResource
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getNumber(): ?string
    {
        return $this->number;
    }

    /**
     * @param string|null $number
     * @return CardResource
     */
    public function setNumber(?string $number): CardResource
    {
        $this->number = $number;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getNetworkToken(): ?string
    {
        return $this->networkToken;
    }

    /**
     * @param string|null $networkToken
     * @return CardResource
     */
    public function setNetworkToken(?string $networkToken): CardResource
    {
        $this->networkToken = $networkToken;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getExpMonth(): ?string
    {
        return $this->expMonth;
    }

    /**
     * @param string|null $expMonth
     * @return CardResource
     */
    public function setExpMonth(?string $expMonth): CardResource
    {
        $this->expMonth = $expMonth;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getExpYear(): ?string
    {
        return $this->expYear;
    }

    /**
     * @param string|null $expYear
     * @return CardResource
     */
    public function setExpYear(?string $expYear): CardResource
    {
        $this->expYear = $expYear;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getSecurityCode(): ?string
    {
        return $this->securityCode;
    }

    /**
     * @param string|null $securityCode
     * @return CardResource
     */
    public function setSecurityCode(?string $securityCode): CardResource
    {
        $this->securityCode = $securityCode;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getEncrypted(): ?string
    {
        return $this->encrypted;
    }

    /**
     * @param string|null $encrypted
     * @return CardResource
     */
    public function setEncrypted(?string $encrypted): CardResource
    {
        $this->encrypted = $encrypted;
        return $this;
    }

    /**
     * @return bool|null
     */
    public function getStore(): ?bool
    {
        return $this->store;
    }

    /**
     * @param bool|null $store
     * @return CardResource
     */
    public function setStore(?bool $store): CardResource
    {
        $this->store = $store;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getBrand(): ?string
    {
        return $this->brand;
    }

    /**
     * @param string|null $brand
     * @return CardResource
     */
    public function setBrand(?string $brand): CardResource
    {
        $this->brand = $brand;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getProduct(): ?string
    {
        return $this->product;
    }

    /**
     * @param string|null $product
     * @return CardResource
     */
    public function setProduct(?string $product): CardResource
    {
        $this->product = $product;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getFirstDigits(): ?string
    {
        return $this->firstDigits;
    }

    /**
     * @param string|null $firstDigits
     * @return CardResource
     */
    public function setFirstDigits(?string $firstDigits): CardResource
    {
        $this->firstDigits = $firstDigits;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getLastDigits(): ?string
    {
        return $this->lastDigits;
    }

    /**
     * @param string|null $lastDigits
     * @return CardResource
     */
    public function setLastDigits(?string $lastDigits): CardResource
    {
        $this->lastDigits = $lastDigits;
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
     * @return CardResource
     */
    public function setHolder(?HolderResource $holder): CardResource
    {
        $this->holder = $holder;
        return $this;
    }
}
