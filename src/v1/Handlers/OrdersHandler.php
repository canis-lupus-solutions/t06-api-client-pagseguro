<?php
declare(strict_types=1);

namespace CanisLupus\ApiClients\PagSeguro\v1\Handlers;

use CanisLupus\ApiClients\PagSeguro\v1\Enums\MethodEnum;
use CanisLupus\ApiClients\PagSeguro\v1\Enums\RelEnum;
use CanisLupus\ApiClients\PagSeguro\v1\Exceptions\PagSeguroApiException;
use CanisLupus\ApiClients\PagSeguro\v1\PagSeguroApiConfig;
use CanisLupus\ApiClients\PagSeguro\v1\PagSeguroApiHandler;
use CanisLupus\ApiClients\PagSeguro\v1\Resources\Common\AddressResource;
use CanisLupus\ApiClients\PagSeguro\v1\Resources\Common\CustomerResource;
use CanisLupus\ApiClients\PagSeguro\v1\Resources\Common\ItemResource;
use CanisLupus\ApiClients\PagSeguro\v1\Resources\Common\LinkResource;
use CanisLupus\ApiClients\PagSeguro\v1\Resources\Common\ShippingResource;
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
                $charges[] = ChargesHandler::hidrateResource($chargeData);;
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
