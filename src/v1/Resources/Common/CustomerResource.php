<?php
declare(strict_types=1);

namespace CanisLupus\ApiClients\PagSeguro\v1\Resources\Common;

use CanisLupus\ApiClients\PagSeguro\v1\Traits\Arrayable;

class CustomerResource
{
    use Arrayable;


    /**
     * Nome do cliente.
     * 1-30 caracteres.
     * Exemplo: João Souza
     */
    protected string $name;

    /**
     * E-mail do cliente.
     * 10-255 caracteres.
     * Exemplo: joaosouza@gmail.com
     */
    protected string $email;

    /**
     * Documento de identificação pessoal (CPF/CNPJ) do cliente.
     * 11/14 caracteres.
     * Exemplo: 12345678910
     */
    protected string $taxId;

    /**
     * Contém uma lista de telefones do cliente.
     *
     * @var PhoneResource[]
     */
    protected array $phones = [];


    /**
     * @param string $name
     * @param string $email
     * @param string $taxId
     */
    public function __construct(string $name, string $email, string $taxId)
    {
        $this->name = $name;
        $this->email = $email;
        $this->taxId = $taxId;
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
     * @return CustomerResource
     */
    public function setName(string $name): CustomerResource
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param string $email
     * @return CustomerResource
     */
    public function setEmail(string $email): CustomerResource
    {
        $this->email = $email;
        return $this;
    }

    /**
     * @return string
     */
    public function getTaxId(): string
    {
        return $this->taxId;
    }

    /**
     * @param string $taxId
     * @return CustomerResource
     */
    public function setTaxId(string $taxId): CustomerResource
    {
        $this->taxId = $taxId;
        return $this;
    }

    /**
     * @return array
     */
    public function getPhones(): array
    {
        return $this->phones;
    }

    /**
     * @param array $phones
     * @return CustomerResource
     */
    public function setPhones(array $phones): CustomerResource
    {
        $this->phones = $phones;
        return $this;
    }
}
