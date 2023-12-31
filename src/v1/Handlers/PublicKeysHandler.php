<?php
declare(strict_types=1);

namespace CanisLupus\ApiClients\PagSeguro\v1\Handlers;

use CanisLupus\ApiClients\PagSeguro\v1\Enums\MethodEnum;
use CanisLupus\ApiClients\PagSeguro\v1\Exceptions\PagSeguroApiException;
use CanisLupus\ApiClients\PagSeguro\v1\PagSeguroApiConfig;
use CanisLupus\ApiClients\PagSeguro\v1\PagSeguroApiHandler;
use CanisLupus\ApiClients\PagSeguro\v1\Resources\PublicKeys\PublicKeyResource;
use Exception;

class PublicKeysHandler extends PagSeguroApiHandler
{
    /**
     * @param PagSeguroApiConfig $config
     */
    public function __construct(
        PagSeguroApiConfig $config
    )
    {
        parent::__construct($config);
    }


    /* ACTIONS */

    /**
     * @param string $type
     * @return PublicKeyResource
     * @throws PagSeguroApiException
     */
    public function create(string $type = 'card'): PublicKeyResource
    {
        return $this->hidrateResource($this->call(MethodEnum::POST, 'public-keys', ['type' => $type]));
    }

    /**
     * @return PublicKeyResource
     * @throws PagSeguroApiException
     */
    public function view(): PublicKeyResource
    {
        try {
            $result = $this->call(MethodEnum::GET, 'public-keys/card');

            return $this->hidrateResource($result);

        } catch (Exception $e) {
            throw new PagSeguroApiException($e->getMessage());
        }
    }


    /* SUPPORT METHODS */

    /**
     * @param array $data
     * @return PublicKeyResource
     */
    public static function hidrateResource(array $data): PublicKeyResource
    {
        return new PublicKeyResource($data['public_key'], $data['created_at']);
    }
}
