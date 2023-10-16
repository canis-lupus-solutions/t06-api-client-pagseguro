<?php
declare(strict_types=1);

namespace CanisLupus\ApiClients\PagSeguro\v1\Resources\Common;

use CanisLupus\ApiClients\PagSeguro\v1\Traits\Arrayable;

class AddressResource
{
    use Arrayable;


    /**
     * Rua do endereço.
     * 1-160 caracteres.
     * Exemplo: Avenida Brigadeiro Faria Lima
     */
    protected ?string $street = null;

    /**
     * Número do endereço.
     * 1-20 caracteres.
     * Exemplo: 1384
     */
    protected ?string $number = null;

    /**
     * Complemento do endereço.
     * 1-40 caracteres.
     * Exemplo: Casa
     */
    protected ?string $complement = null;

    /**
     * Bairro do endereço.
     * 1-60 caracteres.
     * Exemplo: Pinheiros
     */
    protected ?string $locality = null;

    /**
     * Cidade do endereço.
     * 1-90 caracteres.
     * Exemplo: São Paulo
     */
    protected ?string $city = null;

    /**
     * Nome do Estado.
     * 1-50 caracteres.
     * Exemplo: São Paulo
     */
    protected ?string $region = null;

    /**
     * Código do Estado (Padrão ISO 3166-2).
     * 2 caracteres.
     * Exemplo: SP
     */
    protected ?string $regionCode = null;

    /**
     * País do endereço (Padrão ISO 3166-1 alpha-3).
     * 1-50 caracteres.
     * Exemplo: BRA
     */
    protected ?string $country = null;

    /**
     * CEP do endereço.
     * 8 caracteres.
     * Exemplo: 01452002
     */
    protected ?string $postalCode = null;


    /* GETTERS/SETTERS */

    /**
     * @return string|null
     */
    public function getStreet(): ?string
    {
        return $this->street;
    }

    /**
     * @param string|null $street
     * @return AddressResource
     */
    public function setStreet(?string $street): AddressResource
    {
        $this->street = $street;
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
     * @return AddressResource
     */
    public function setNumber(?string $number): AddressResource
    {
        $this->number = $number;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getComplement(): ?string
    {
        return $this->complement;
    }

    /**
     * @param string|null $complement
     * @return AddressResource
     */
    public function setComplement(?string $complement): AddressResource
    {
        $this->complement = $complement;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getLocality(): ?string
    {
        return $this->locality;
    }

    /**
     * @param string|null $locality
     * @return AddressResource
     */
    public function setLocality(?string $locality): AddressResource
    {
        $this->locality = $locality;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getCity(): ?string
    {
        return $this->city;
    }

    /**
     * @param string|null $city
     * @return AddressResource
     */
    public function setCity(?string $city): AddressResource
    {
        $this->city = $city;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getRegion(): ?string
    {
        return $this->region;
    }

    /**
     * @param string|null $region
     * @return AddressResource
     */
    public function setRegion(?string $region): AddressResource
    {
        $this->region = $region;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getRegionCode(): ?string
    {
        return $this->regionCode;
    }

    /**
     * @param string|null $regionCode
     * @return AddressResource
     */
    public function setRegionCode(?string $regionCode): AddressResource
    {
        $this->regionCode = $regionCode;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getCountry(): ?string
    {
        return $this->country;
    }

    /**
     * @param string|null $country
     * @return AddressResource
     */
    public function setCountry(?string $country): AddressResource
    {
        $this->country = $country;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getPostalCode(): ?string
    {
        return $this->postalCode;
    }

    /**
     * @param string|null $postalCode
     * @return AddressResource
     */
    public function setPostalCode(?string $postalCode): AddressResource
    {
        $this->postalCode = $postalCode;
        return $this;
    }
}
