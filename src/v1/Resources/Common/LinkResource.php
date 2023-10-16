<?php
declare(strict_types=1);

namespace CanisLupus\ApiClients\PagSeguro\v1\Resources\Common;

use CanisLupus\ApiClients\PagSeguro\v1\Enums\MethodEnum;
use CanisLupus\ApiClients\PagSeguro\v1\Enums\RelEnum;
use CanisLupus\ApiClients\PagSeguro\v1\Traits\Arrayable;

class LinkResource
{
    use Arrayable;


    /**
     * Indica o tipo do relacionamento ao recurso.
     */
    protected RelEnum $rel;

    /**
     * Endereço HTTP do recurso.
     * 5-2048 caracteres.
     * Exemplo: https://sandbox.api.pagseguro.com/charges/CHAR_D32A01A9-92A6-4755-B21D-7B6A1291F7AD
     */
    protected string $href;

    /**
     * Tipo de mídia ao qual o link responde ou aceita.
     * 11-64 caracteres.
     * Exemplo: application/json
     */
    protected string $media;

    /**
     * Método HTTP em uso.
     */
    protected MethodEnum $type;


    /**
     * @param RelEnum $rel
     * @param string $href
     * @param string $media
     * @param MethodEnum $type
     */
    public function __construct(RelEnum $rel, string $href, string $media, MethodEnum $type)
    {
        $this->rel = $rel;
        $this->href = $href;
        $this->media = $media;
        $this->type = $type;
    }


    /* GETTERS/SETTERS */

    /**
     * @return RelEnum
     */
    public function getRel(): RelEnum
    {
        return $this->rel;
    }

    /**
     * @param RelEnum $rel
     * @return LinkResource
     */
    public function setRel(RelEnum $rel): LinkResource
    {
        $this->rel = $rel;
        return $this;
    }

    /**
     * @return string
     */
    public function getHref(): string
    {
        return $this->href;
    }

    /**
     * @param string $href
     * @return LinkResource
     */
    public function setHref(string $href): LinkResource
    {
        $this->href = $href;
        return $this;
    }

    /**
     * @return string
     */
    public function getMedia(): string
    {
        return $this->media;
    }

    /**
     * @param string $media
     * @return LinkResource
     */
    public function setMedia(string $media): LinkResource
    {
        $this->media = $media;
        return $this;
    }

    /**
     * @return MethodEnum
     */
    public function getType(): MethodEnum
    {
        return $this->type;
    }

    /**
     * @param MethodEnum $type
     * @return LinkResource
     */
    public function setType(MethodEnum $type): LinkResource
    {
        $this->type = $type;
        return $this;
    }
}
