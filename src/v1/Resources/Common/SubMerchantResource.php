<?php
declare(strict_types=1);

namespace CanisLupus\ApiClients\PagSeguro\v1\Resources\Common;

use CanisLupus\ApiClients\PagSeguro\v1\Traits\Arrayable;

class SubMerchantResource
{
    use Arrayable;


    /**
     * Identificador próprio referente ao lojista atribuído na plataforma do sub-adquirente.
     * 15 caracteres.
     * Exemplo: ID123456789
     */
    protected ?string $referenceId = null;

    /**
     * Razão social do lojista na plataforma do sub-adquirente em caso de pessoa jurídica.
     * Em casos de pessoa física, nome completo do lojista na plataforma do sub-adquirente.
     * 60 caracteres.
     * Exemplo: João Souza
     */
    protected ?string $name = null;

    /**
     * Número do documento (CPF ou CNPJ) do lojista na plataforma do sub-adquirente. Apenas números devem ser
     * informados (com ou sem máscara).
     * 11/14 caracteres.
     * Exemplo: 12345678908
     */
    protected ?string $taxId = null;

    /**
     * Código de atuação comercial do lojista (merchant category code) na plataforma do sub-adquirente.
     * Apenas números devem ser informados. Bloqueio padrão para MCC de alto risco.
     * 4 caracteres.
     * Exemplo: 0763
     */
    protected ?string $mcc = null;

    /**
     * Contém as informações de endereço do lojista na plataforma do sub-adquirente.
     */
    protected ?AddressResource $address = null;

    /**
     * Contém uma lista de telefones de contato do lojista na plataforma do sub adquirente.
     * É preciso ser informado para transações com a bandeira ELO.
     */
    protected ?PhoneResource $phone = null;


    /* GETTERS/SETTERS */

    /**
     * @return string|null
     */
    public function getReferenceId(): ?string
    {
        return $this->referenceId;
    }

    /**
     * @param string|null $referenceId
     * @return SubMerchantResource
     */
    public function setReferenceId(?string $referenceId): SubMerchantResource
    {
        $this->referenceId = $referenceId;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param string|null $name
     * @return SubMerchantResource
     */
    public function setName(?string $name): SubMerchantResource
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getTaxId(): ?string
    {
        return $this->taxId;
    }

    /**
     * @param string|null $taxId
     * @return SubMerchantResource
     */
    public function setTaxId(?string $taxId): SubMerchantResource
    {
        $this->taxId = $taxId;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getMcc(): ?string
    {
        return $this->mcc;
    }

    /**
     * @param string|null $mcc
     * @return SubMerchantResource
     */
    public function setMcc(?string $mcc): SubMerchantResource
    {
        $this->mcc = $mcc;
        return $this;
    }

    /**
     * @return AddressResource|null
     */
    public function getAddress(): ?AddressResource
    {
        return $this->address;
    }

    /**
     * @param AddressResource|null $address
     * @return SubMerchantResource
     */
    public function setAddress(?AddressResource $address): SubMerchantResource
    {
        $this->address = $address;
        return $this;
    }

    /**
     * @return PhoneResource|null
     */
    public function getPhone(): ?PhoneResource
    {
        return $this->phone;
    }

    /**
     * @param PhoneResource|null $phone
     * @return SubMerchantResource
     */
    public function setPhone(?PhoneResource $phone): SubMerchantResource
    {
        $this->phone = $phone;
        return $this;
    }
}
