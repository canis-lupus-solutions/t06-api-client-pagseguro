<?php
declare(strict_types=1);

namespace CanisLupus\ApiClients\PagSeguro\v1\Handlers;

use CanisLupus\ApiClients\PagSeguro\v1\Enums\ChargeStatusEnum;
use CanisLupus\ApiClients\PagSeguro\v1\Enums\MethodEnum;
use CanisLupus\ApiClients\PagSeguro\v1\Enums\PaymentMethodEnum;
use CanisLupus\ApiClients\PagSeguro\v1\Enums\RelEnum;
use CanisLupus\ApiClients\PagSeguro\v1\Exceptions\PagSeguroApiException;
use CanisLupus\ApiClients\PagSeguro\v1\PagSeguroApiConfig;
use CanisLupus\ApiClients\PagSeguro\v1\PagSeguroApiHandler;
use CanisLupus\ApiClients\PagSeguro\v1\Resources\Common\AmountResource;
use CanisLupus\ApiClients\PagSeguro\v1\Resources\Common\BoletoResource;
use CanisLupus\ApiClients\PagSeguro\v1\Resources\Common\CardResource;
use CanisLupus\ApiClients\PagSeguro\v1\Resources\Common\HolderResource;
use CanisLupus\ApiClients\PagSeguro\v1\Resources\Common\InstructionLinesResource;
use CanisLupus\ApiClients\PagSeguro\v1\Resources\Common\LinkResource;
use CanisLupus\ApiClients\PagSeguro\v1\Resources\Common\PaymentMethodResource;
use CanisLupus\ApiClients\PagSeguro\v1\Resources\Common\PaymentResponseResource;
use CanisLupus\ApiClients\PagSeguro\v1\Resources\Common\RawDataResource;
use CanisLupus\ApiClients\PagSeguro\v1\Resources\Common\SummaryResource;
use CanisLupus\ApiClients\PagSeguro\v1\Resources\Orders\ChargeResource;
use DateTime;
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


    /**
     * @param string $chargeId
     * @return ChargeResource
     * @throws PagSeguroApiException
     */
    public function view(string $chargeId): ChargeResource
    {
        try {
            $result = $this->call(MethodEnum::GET, 'charges/' . $chargeId, null, ['Content-Type' => 'application/json']);

            return $this->hidrateResource($result);

        } catch (Exception $e) {
            throw new PagSeguroApiException($e->getMessage());
        }
    }


    /* SUPPORT METHODS */

    /**
     * @param array $data
     * @return ChargeResource
     * @throws Exception
     */
    public static function hidrateResource(array $data): ChargeResource
    {
        $charge = new ChargeResource();
        $charge->setId($data['id'] ?? null);
        $charge->setReferenceId($data['reference_id'] ?? null);
        $charge->setStatus(ChargeStatusEnum::tryFrom($data['status']));
        $charge->setCreatedAt(new DateTime($data['created_at']));
        $charge->setDescription($data['description'] ?? null);

        if (isset($data['paid_at'])) {
            $charge->setPaidAt(new DateTime($data['paid_at']));
        }

        if (isset($data['amount'])) {
            $amountData = $data['amount'];
            $amount = new AmountResource($amountData['value'], $amountData['currency']);

            if (isset($amountData['summary'])) {
                $summaryData = $amountData['summary'];
                $summary = new SummaryResource($summaryData['total'], $summaryData['paid'], $summaryData['refunded']);
                $amount->setSummary($summary);
            }

            $charge->setAmount($amount);
        }

        if (isset($data['payment_response'])) {
            $paymentResponseData = $data['payment_response'];
            $paymentResponse = new PaymentResponseResource();
            $paymentResponse->setCode($paymentResponseData['code'] ?? null);
            $paymentResponse->setMessage($paymentResponseData['message'] ?? null);
            $paymentResponse->setReference($paymentResponseData['reference'] ?? null);

            if (isset($paymentResponseData['raw_data'])) {
                $rawDataData = $paymentResponseData['raw_data'];
                $rawData = new RawDataResource();
                $rawData->setAuthorizationCode($rawDataData['authorization_code'] ?? null);
                $rawData->setNsu($rawDataData['nsu'] ?? null);
                $rawData->setReasonCode($rawDataData['reason_code'] ?? null);

                $paymentResponse->setRawData($rawData);
            }

            $charge->setPaymentResponse($paymentResponse);
        }

        if (isset($data['payment_method'])) {
            $paymentMethodData = $data['payment_method'];
            $paymentMethod = new PaymentMethodResource(PaymentMethodEnum::from($paymentMethodData['type']));
            $paymentMethod->setInstallments($paymentMethodData['installments'] ?? null);
            $paymentMethod->setCapture($paymentMethodData['capture'] ?? true);
            $paymentMethod->setSoftDescriptor($paymentMethodData['soft_descriptor'] ?? null);

            if (isset($paymentMethodData['card'])) {
                $cardData = $paymentMethodData['card'];
                $card = new CardResource();
                $card->setBrand($cardData['brand'] ?? null);
                $card->setFirstDigits($cardData['first_digits'] ?? null);
                $card->setLastDigits($cardData['last_digits'] ?? null);
                $card->setExpMonth($cardData['exp_month'] ?? null);
                $card->setExpYear($cardData['exp_year'] ?? null);
                $card->setStore($cardData['store'] ?? null);

                if (isset($cardData['holder'])) {
                    $holderData = $cardData['holder'];
                    $holder = new HolderResource($holderData['name']);
                    $holder->setTaxId($holderData['tax_id'] ?? null);

                    $card->setHolder($holder);
                }

                $paymentMethod->setCard($card);
            }

            if (isset($paymentMethodData['boleto'])) {
                $boletoData = $paymentMethodData['boleto'];
                $boleto = new BoletoResource();
                $boleto->setId($boletoData['id'] ?? null);
                $boleto->setBarcode($boletoData['barcode'] ?? null);
                $boleto->setFormattedBarcode($boletoData['formatted_barcode'] ?? null);
                $boleto->setDueDate($boletoData['due_date'] ?? null);
                $boleto->setInstructionLines(
                    (new InstructionLinesResource())
                        ->setLine1($boletoData['instruction_lines']['line_1'] ?? null)
                        ->setLine2($boletoData['instruction_lines']['line_2'] ?? null)
                );

                if (isset($boletoData['holder'])) {
                    $holderData = $boletoData['holder'];
                    $holder = new HolderResource($holderData['name']);
                    $holder->setTaxId($holderData['tax_id'] ?? null);
                    $holder->setEmail($holderData['email'] ?? null);

                    $boleto->setHolder($holder);
                }

                $paymentMethod->setBoleto($boleto);
            }

            $charge->setPaymentMethod($paymentMethod);
        }

        if (isset($data['links'])) {
            $links = [];
            foreach ($data['links'] as $linkData) {
                $links[] = new LinkResource(
                    RelEnum::from($linkData['rel']),
                    $linkData['href'],
                    $linkData['media'],
                    MethodEnum::from($linkData['type'])
                );
            }

            $charge->setLinks($links);
        }

        return $charge;
    }
}
