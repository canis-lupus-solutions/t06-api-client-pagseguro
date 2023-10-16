<?php
declare(strict_types=1);

namespace CanisLupus\ApiClients\PagSeguro\v1\Resources\Common;

use CanisLupus\ApiClients\PagSeguro\v1\Enums\AuthenticationMethodTypeEnum;
use CanisLupus\ApiClients\PagSeguro\v1\Traits\Arrayable;

class AuthenticationMethodResource
{
    use Arrayable;


    /**
     * Indica o método de autenticação utilizado na cobrança. Condicional para Token de Bandeira ELO.
     */
    protected ?AuthenticationMethodTypeEnum $type = null;

    /**
     * Identificador único gerado em cenário de sucesso de autenticação do cliente.
     * 80 caracteres.
     * Exemplo: BwABBylVaQAAAAFwllVpAAAAAAA=
     */
    protected ?string $cavv = null;

    /**
     * Indicador E-Commerce retornado quando ocorre uma autenticação. Corresponde ao resultado da autenticação.
     * 2 caracteres.
     * Exemplo: 01
     */
    protected ?string $eci = null;

    /**
     * Identificador de uma transação de um MPI - Recomendado para a bandeira VISA. Condicional para 3DS.
     * 80 caracteres.
     * Exemplo: BwABBylVaQAAAAFwllVpAAAAAAA=
     */
    protected ?string $xid = null;

    /**
     * Versão do protocolo 3DS utilizado na autenticação.
     * 10 caracteres.
     * Exemplo: 2.0.1
     */
    protected ?string $version = null;

    /**
     * ID da transação gerada pelo servidor de diretório durante uma autenticação - Recomendado para a bandeira
     * Mastercard. Condicional para 3DS.
     * 80 caracteres.
     * Exemplo: DIR_SERVER_TID
     */
    protected ?string $dstransId = null;

    /**
     * Status de uma autenticação 3DS.
     * 80 caracteres.
     * Exemplo: AUTHENTICATED
     */
    protected ?string $status = null;


    /* GETTERS/SETTERS */

    /**
     * @return AuthenticationMethodTypeEnum|null
     */
    public function getType(): ?AuthenticationMethodTypeEnum
    {
        return $this->type;
    }

    /**
     * @param AuthenticationMethodTypeEnum|null $type
     * @return AuthenticationMethodResource
     */
    public function setType(?AuthenticationMethodTypeEnum $type): AuthenticationMethodResource
    {
        $this->type = $type;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getCavv(): ?string
    {
        return $this->cavv;
    }

    /**
     * @param string|null $cavv
     * @return AuthenticationMethodResource
     */
    public function setCavv(?string $cavv): AuthenticationMethodResource
    {
        $this->cavv = $cavv;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getEci(): ?string
    {
        return $this->eci;
    }

    /**
     * @param string|null $eci
     * @return AuthenticationMethodResource
     */
    public function setEci(?string $eci): AuthenticationMethodResource
    {
        $this->eci = $eci;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getXid(): ?string
    {
        return $this->xid;
    }

    /**
     * @param string|null $xid
     * @return AuthenticationMethodResource
     */
    public function setXid(?string $xid): AuthenticationMethodResource
    {
        $this->xid = $xid;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getVersion(): ?string
    {
        return $this->version;
    }

    /**
     * @param string|null $version
     * @return AuthenticationMethodResource
     */
    public function setVersion(?string $version): AuthenticationMethodResource
    {
        $this->version = $version;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getDstransId(): ?string
    {
        return $this->dstransId;
    }

    /**
     * @param string|null $dstransId
     * @return AuthenticationMethodResource
     */
    public function setDstransId(?string $dstransId): AuthenticationMethodResource
    {
        $this->dstransId = $dstransId;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getStatus(): ?string
    {
        return $this->status;
    }

    /**
     * @param string|null $status
     * @return AuthenticationMethodResource
     */
    public function setStatus(?string $status): AuthenticationMethodResource
    {
        $this->status = $status;
        return $this;
    }
}
