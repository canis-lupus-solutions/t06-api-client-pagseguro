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
use CanisLupus\ApiClients\PagSeguro\v1\Resources\Common\AddressResource;
use CanisLupus\ApiClients\PagSeguro\v1\Resources\Common\AmountResource;
use CanisLupus\ApiClients\PagSeguro\v1\Resources\Common\CardResource;
use CanisLupus\ApiClients\PagSeguro\v1\Resources\Common\CustomerResource;
use CanisLupus\ApiClients\PagSeguro\v1\Resources\Common\HolderResource;
use CanisLupus\ApiClients\PagSeguro\v1\Resources\Common\ItemResource;
use CanisLupus\ApiClients\PagSeguro\v1\Resources\Common\LinkResource;
use CanisLupus\ApiClients\PagSeguro\v1\Resources\Common\PaymentMethodResource;
use CanisLupus\ApiClients\PagSeguro\v1\Resources\Common\PaymentResponseResource;
use CanisLupus\ApiClients\PagSeguro\v1\Resources\Common\RawDataResource;
use CanisLupus\ApiClients\PagSeguro\v1\Resources\Common\ShippingResource;
use CanisLupus\ApiClients\PagSeguro\v1\Resources\Common\SummaryResource;
use CanisLupus\ApiClients\PagSeguro\v1\Resources\Orders\ChargeResource;
use CanisLupus\ApiClients\PagSeguro\v1\Resources\Orders\OrderResource;
use DateTime;
use Exception;

class OrdersHandler extends PagSeguroApiHandler
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
     * @param array|OrderResource $order
     * @return OrderResource
     * @throws PagSeguroApiException
     */
    public function create(mixed $order): OrderResource
    {
        try {
            if (is_array($order)) {
                return $this->hidrateResource($this->call(MethodEnum::POST, 'orders', $order));
            } else if (is_a($order, OrderResource::class)) {
                return $this->hidrateResource($this->call(MethodEnum::POST, 'orders', $order->toArray()));
            } else {
                throw new PagSeguroApiException('Invalid Order data format');
            }
        } catch (Exception $e) {
            throw new PagSeguroApiException($e->getMessage());
        }
    }


    /* SUPPORT METHODS */

    /**
     * @param array $data
     * @return OrderResource
     * @throws Exception
     */
    public static function hidrateResource(array $data): OrderResource
    {
        $order = new OrderResource();
        $order->setId($data['id'] ?? null);
        $order->setReferenceId($data['reference_id'] ?? null);
        $order->setCreatedAt(new DateTime($data['created_at']));
        $order->setNotificationUrls($data['notification_urls'] ?? []);

        if (isset($data['customer'])) {
            $customerData = $data['customer'];
            $customer = new CustomerResource($customerData['name'], $customerData['email'], $customerData['tax_id']);
            $order->setCustomer($customer);
        }

        if (isset($data['items'])) {
            $items = [];
            foreach ($data['items'] as $itemData) {
                $items[] = new ItemResource(
                    $itemData['reference_id'], $itemData['name'], $itemData['quantity'], $itemData['unit_amount']
                );
            }

            $order->setItems($items);
        }

        if (isset($data['shipping']['address'])) {
            $shippingAddressData = $data['shipping']['address'];
            $shipping = new ShippingResource((new AddressResource())
                ->setStreet($shippingAddressData['street'] ?? null)
                ->setNumber($shippingAddressData['number'] ?? null)
                ->setComplement($shippingAddressData['complement'] ?? null)
                ->setLocality($shippingAddressData['locality'] ?? null)
                ->setCity($shippingAddressData['city'] ?? null)
                ->setRegion($shippingAddressData['region'] ?? null)
                ->setRegionCode($shippingAddressData['region_code'] ?? null)
                ->setCountry($shippingAddressData['country'] ?? null)
                ->setPostalCode($shippingAddressData['postal_code'] ?? null)
            );
            $order->setShipping($shipping);
        }

        if (isset($data['charges'])) {
            $charges = [];
            foreach ($data['charges'] as $chargeData) {
                $charge = new ChargeResource();
                $charge->setId($chargeData['id'] ?? null);
                $charge->setReferenceId($chargeData['reference_id'] ?? null);
                $charge->setStatus(ChargeStatusEnum::tryFrom($chargeData['status']));
                $charge->setCreatedAt(new DateTime($chargeData['created_at']));
                $charge->setDescription($chargeData['description'] ?? null);

                if (isset($chargeData['paid_at'])) {
                    $charge->setPaidAt(new DateTime($chargeData['paid_at']));
                }

                if (isset($chargeData['amount'])) {
                    $amountData = $chargeData['amount'];
                    $amount = new AmountResource($amountData['value'], $amountData['currency']);

                    if (isset($amountData['summary'])) {
                        $summaryData = $amountData['summary'];
                        $summary = new SummaryResource($summaryData['total'], $summaryData['paid'], $summaryData['refunded']);
                        $amount->setSummary($summary);
                    }

                    $charge->setAmount($amount);
                }

                if (isset($chargeData['payment_response'])) {
                    $paymentResponseData = $chargeData['payment_response'];
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

                if (isset($chargeData['payment_method'])) {
                    $paymentMethodData = $chargeData['payment_method'];
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

                    $charge->setPaymentMethod($paymentMethod);
                }

                if (isset($chargeData['links'])) {
                    $links = [];
                    foreach ($chargeData['links'] as $linkData) {
                        $links[] = new LinkResource(
                            RelEnum::from($linkData['rel']),
                            $linkData['href'],
                            $linkData['media'],
                            MethodEnum::from($linkData['type'])
                        );
                    }

                    $charge->setLinks($links);
                }

                $charges[] = $charge;
            }

            $order->setCharges($charges);
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

            $order->setLinks($links);
        }

        return $order;
    }
}
