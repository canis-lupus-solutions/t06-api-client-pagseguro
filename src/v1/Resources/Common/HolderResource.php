<?php
declare(strict_types=1);

namespace CanisLupus\ApiClients\PagSeguro\v1\Resources\Common;

use CanisLupus\ApiClients\PagSeguro\v1\Traits\Arrayable;

class HolderResource
{
    use Arrayable;


    /**
     * Nome do responsável pelo pagamento do Boleto.
     * 1-30 caracteres.
     * Exemplo: Jose da Silva
     */
    protected string $name;

    /**
     * Número do documento do responsável pelo pagamento do Boleto.
     * 11/14 caracteres.
     * Exemplo: 12345678902
     */
    protected ?string $taxId = null;

    /**
     * E-mail do responsável pelo pagamento do Boleto.
     * 10-255 caracteres.
     * Exemplo: josedasilva@email.com
     */
    protected ?string $email = null;

    /**
     * Contém informações do endereço do dono da conta ou sócio da empresa.
     */
    protected ?AddressResource $address = null;


    /**
     * @param string $name
     */
    public function __construct(string $name)
    {
        $this->name = $name;
    }


    /* GETTERS/SETTERS */

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return HolderResource
     */
    public function setName(string $name): HolderResource
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
     * @return HolderResource
     */
    public function setTaxId(?string $taxId): HolderResource
    {
        $this->taxId = $taxId;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getEmail(): ?string
    {
        return $this->email;
    }

    /**
     * @param string|null $email
     * @return HolderResource
     */
    public function setEmail(?string $email): HolderResource
    {
        $this->email = $email;
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
     * @return HolderResource
     */
    public function setAddress(?AddressResource $address): HolderResource
    {
        $this->address = $address;
        return $this;
    }
}
