<?php
declare(strict_types=1);

namespace CanisLupus\ApiClients\PagSeguro\v1\Enums;

enum ChargeStatusEnum: string
{
    /**
     * Indica que a cobrança está pré-autorizada.
     */
    case AUTHORIZED = 'AUTHORIZED';

    /**
     * Indica que a cobrança está paga (capturada).
     */
    case PAID = 'PAID';

    /**
     * Indica que o comprador optou por pagar com um Cartão de Crédito e o PagBank está analisando o risco da transação.
     */
    case IN_ANALYSIS = 'IN_ANALYSIS';

    /**
     * Indica que a cobrança foi negada pelo PagBank ou Emissor.
     */
    case DECLINED = 'DECLINED';

    /**
     * Indica que a cobrança foi cancelada.
     */
    case CANCELED = 'CANCELED';

    case WAITING = 'WAITING';
}
