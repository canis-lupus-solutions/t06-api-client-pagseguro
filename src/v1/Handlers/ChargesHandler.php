<?php
declare(strict_types=1);

namespace CanisLupus\ApiClients\PagSeguro\v1\Handlers;

use CanisLupus\ApiClients\PagSeguro\v1\Enums\MethodEnum;
use CanisLupus\ApiClients\PagSeguro\v1\Enums\PaymentMethodEnum;
use CanisLupus\ApiClients\PagSeguro\v1\Exceptions\PagSeguroApiException;
use CanisLupus\ApiClients\PagSeguro\v1\PagSeguroApiConfig;
use CanisLupus\ApiClients\PagSeguro\v1\PagSeguroApiHandler;
use Exception;

class ChargesHandler extends PagSeguroApiHandler
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
     * @param int $creditCardBin
     * @param int $value
     * @param int $maxInstallments
     * @param int $maxInstallmentsNoInterest
     * @return array
     * @throws PagSeguroApiException
     */
    public function calculateFees(
        int $creditCardBin,
        int $value,
        int $maxInstallments,
        int $maxInstallmentsNoInterest
    ): array
    {
        try {
            $creditCardPaymentMethod = PaymentMethodEnum::CREDIT_CARD;

            $queryString = '?payment_methods=' . $creditCardPaymentMethod->value;
            $queryString .= '&credit_card_bin=' . $creditCardBin;
            $queryString .= '&value=' . $value;
            $queryString .= '&max_installments=' . $maxInstallments;
            $queryString .= '&max_installments_no_interest=' . $maxInstallmentsNoInterest;

            $result = $this->call(MethodEnum::GET, 'charges/fees/calculate' . $queryString);

            $feesData = [
                'paymentMethod' => $creditCardPaymentMethod->value,
            ];

            $plans = [];
            foreach ($result['payment_methods'] as $type => $brands) {
                foreach ($brands as $brandName => $installmentPlans) {
                    $feesData['cardBrand'] = $brandName;

                    foreach ($installmentPlans['installment_plans'] as $plan) {
                        $plans[] = [
                            'installments' => $plan['installments'],
                            'installmentValue' => $plan['installment_value'],
                            'isInterestFree' => $plan['interest_free'],
                            'totalValue' => $plan['amount']['value'],
                            'feesValue' => $plan['amount']['fees']['buyer']['interest']['total'] ?? 0,
                        ];
                    }
                }
            }
            $feesData['plans'] = $plans;

            return $feesData;

        } catch (Exception $e) {
            throw new PagSeguroApiException($e->getMessage());
        }
    }
}
