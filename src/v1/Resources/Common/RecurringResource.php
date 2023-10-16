<?php
declare(strict_types=1);

namespace CanisLupus\ApiClients\PagSeguro\v1\Resources\Common;

use CanisLupus\ApiClients\PagSeguro\v1\Enums\RecurringTypeEnum;

class RecurringResource
{
    /**
     * Indica se a cobrança é proveniente de uma recorrência.
     */
    protected RecurringTypeEnum $type;


    /**
     * @param RecurringTypeEnum $type
     */
    public function __construct(RecurringTypeEnum $type)
    {
        $this->type = $type;
    }


    /* GETTERS/SETTERS */

    /**
     * @return RecurringTypeEnum
     */
    public function getType(): RecurringTypeEnum
    {
        return $this->type;
    }

    /**
     * @param RecurringTypeEnum $type
     * @return RecurringResource
     */
    public function setType(RecurringTypeEnum $type): RecurringResource
    {
        $this->type = $type;
        return $this;
    }
}
