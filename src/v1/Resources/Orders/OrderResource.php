<?php
declare(strict_types=1);

namespace CanisLupus\ApiClients\PagSeguro\v1\Resources\Orders;

use CanisLupus\ApiClients\PagSeguro\v1\Resources\Common\CustomerResource;
use CanisLupus\ApiClients\PagSeguro\v1\Resources\Common\ItemResource;
use CanisLupus\ApiClients\PagSeguro\v1\Resources\Common\LinkResource;
use CanisLupus\ApiClients\PagSeguro\v1\Resources\Common\QrCodeResource;
use CanisLupus\ApiClients\PagSeguro\v1\Resources\Common\ShippingResource;
use CanisLupus\ApiClients\PagSeguro\v1\Traits\Arrayable;
use DateTime;

/**
 * Esse objeto representa o fechamento do carrinho de compras.
 * Contém informações que identifica o que está sendo adquirido, o comprador, endereço de entrega e
 * demais informações relevantes.
 */
class OrderResource
{
    use Arrayable;


    /**
     * Identificador do pedido PagBank.
     * 41 caracteres.
     * Exemplo: ORDE_F87334AC-BB8B-42E2-AA85-8579F70AA328
     */
    protected ?string $id = null;

    /**
     * Identificador único atribuído para o pedido.
     * 1-200 caracteres.
     * Exemplo: ex-00001
     */
    protected ?string $referenceId = null;

    protected ?DateTime $createdAt = null;

    /**
     * Contém informações do cliente que fará pagamentos usando o serviço PagBank.
     */
    protected ?CustomerResource $customer = null;

    /**
     * Contém as informações dos itens inseridos no pedido.
     *
     * @var ItemResource[]
     */
    protected array $items = [];

    /**
     * Contém as informações de entrega do pedido.
     */
    protected ?ShippingResource $shipping = null;

    /**
     * Objeto contendo os QR Codes vinculados a um pedido.
     * Ao informar o amount, o QR code será gerado automaticamente e pode ser pago com aplicativos de outras
     * instituições (Pix). Para que o QR Code aceite o pagamento Pix, o vendedor precisa ter pelo menos uma
     * chave de endereçamento ativa vinculada a sua conta PagBank. Caso o vendedor tenha mais de uma chave de
     * endereçamento cadastrada no PagBank, priorizaremos a utilização da chave de endereçamento aleatória.
     *
     * @var QrCodeResource[]
     */
    protected array $qrCodes = [];

    /**
     * Contém as URLs que receberão as notificações do pedido (por ora, somente aceitamos uma url apenas. Aceitaremos mais URLs em breve)
     *
     * @var string[]
     */
    protected array $notificationUrls = [];

    /**
     * Representa todos os dados disponíveis em uma cobrança, ou seja, na iniciação de um pagamento.
     *
     * @var ChargeResource[]
     */
    protected array $charges = [];

    /**
     * Contém as informações de links relacionados ao recurso.
     *
     * @var LinkResource[]
     */
    protected array $links = [];


    /* GETTERS/SETTERS */

    /**
     * @return string|null
     */
    public function getId(): ?string
    {
        return $this->id;
    }

    /**
     * @param string|null $id
     * @return OrderResource
     */
    public function setId(?string $id): OrderResource
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getReferenceId(): ?string
    {
        return $this->referenceId;
    }

    /**
     * @param string|null $referenceId
     * @return OrderResource
     */
    public function setReferenceId(?string $referenceId): OrderResource
    {
        $this->referenceId = $referenceId;
        return $this;
    }

    /**
     * @return DateTime|null
     */
    public function getCreatedAt(): ?DateTime
    {
        return $this->createdAt;
    }

    /**
     * @param DateTime|null $createdAt
     * @return OrderResource
     */
    public function setCreatedAt(?DateTime $createdAt): OrderResource
    {
        $this->createdAt = $createdAt;
        return $this;
    }

    /**
     * @return CustomerResource|null
     */
    public function getCustomer(): ?CustomerResource
    {
        return $this->customer;
    }

    /**
     * @param CustomerResource|null $customer
     * @return OrderResource
     */
    public function setCustomer(?CustomerResource $customer): OrderResource
    {
        $this->customer = $customer;
        return $this;
    }

    /**
     * @return array
     */
    public function getItems(): array
    {
        return $this->items;
    }

    /**
     * @param array $items
     * @return OrderResource
     */
    public function setItems(array $items): OrderResource
    {
        $this->items = $items;
        return $this;
    }

    /**
     * @return ShippingResource|null
     */
    public function getShipping(): ?ShippingResource
    {
        return $this->shipping;
    }

    /**
     * @param ShippingResource|null $shipping
     * @return OrderResource
     */
    public function setShipping(?ShippingResource $shipping): OrderResource
    {
        $this->shipping = $shipping;
        return $this;
    }

    /**
     * @return array
     */
    public function getQrCodes(): array
    {
        return $this->qrCodes;
    }

    /**
     * @param array $qrCodes
     * @return OrderResource
     */
    public function setQrCodes(array $qrCodes): OrderResource
    {
        $this->qrCodes = $qrCodes;
        return $this;
    }

    /**
     * @return array
     */
    public function getNotificationUrls(): array
    {
        return $this->notificationUrls;
    }

    /**
     * @param array $notificationUrls
     * @return OrderResource
     */
    public function setNotificationUrls(array $notificationUrls): OrderResource
    {
        $this->notificationUrls = $notificationUrls;
        return $this;
    }

    /**
     * @return array
     */
    public function getCharges(): array
    {
        return $this->charges;
    }

    /**
     * @param array $charges
     * @return OrderResource
     */
    public function setCharges(array $charges): OrderResource
    {
        $this->charges = $charges;
        return $this;
    }

    /**
     * @return array
     */
    public function getLinks(): array
    {
        return $this->links;
    }

    /**
     * @param array $links
     * @return OrderResource
     */
    public function setLinks(array $links): OrderResource
    {
        $this->links = $links;
        return $this;
    }
}
