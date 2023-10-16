<?php
declare(strict_types=1);

namespace CanisLupus\ApiClients\PagSeguro\v1\Resources\Orders;

use CanisLupus\ApiClients\PagSeguro\v1\Enums\ChargeStatusEnum;
use CanisLupus\ApiClients\PagSeguro\v1\Resources\Common\AmountResource;
use CanisLupus\ApiClients\PagSeguro\v1\Resources\Common\LinkResource;
use CanisLupus\ApiClients\PagSeguro\v1\Resources\Common\PaymentMethodResource;
use CanisLupus\ApiClients\PagSeguro\v1\Resources\Common\PaymentResponseResource;
use CanisLupus\ApiClients\PagSeguro\v1\Resources\Common\RecurringResource;
use CanisLupus\ApiClients\PagSeguro\v1\Resources\Common\SubMerchantResource;
use CanisLupus\ApiClients\PagSeguro\v1\Traits\Arrayable;
use DateTime;

/**
 * Este objeto é responsável por apresentar todos os dados disponíveis em uma cobrança, ou seja, na
 * iniciação de um pagamento.
 */
class ChargeResource
{
    use Arrayable;


    /**
     * Identificador do pedido PagBank.
     * 41 caracteres.
     * Exemplo: CHAR_67FC568B-00D8-431D-B2E7-755E3E6C66A0
     */
    protected ?string $id = null;

    /**
     * Identificador único atribuído para o pedido.
     * 1-64 caracteres.
     */
    protected ?ChargeStatusEnum $status = null;

    /**
     * Data e horário em que foi criada a cobrança.
     * Exemplo: 2023-02-08T15:15:12.000-03:00
     */
    protected ?DateTime $createdAt = null;

    /**
     * Data e horário em que a cobrança foi paga (capturada).
     * Exemplo: 2023-02-08T15:15:12.000-03:00
     */
    protected ?DateTime $paidAt = null;

    /**
     * Identificador único atribuído para a cobrança.
     * 1-64 caracteres.
     * Exemplo: Referência da cobrança
     */
    protected ?string $referenceId = null;

    /**
     * Descrição da cobrança.
     * 1-64 caracteres.
     * Exemplo: Descrição da cobrança
     */
    protected ?string $description = null;

    /**
     * Contém as informações do valor a ser cobrado.
     */
    protected ?AmountResource $amount = null;

    /**
     * Contém informações de resposta do provedor de pagamento..
     */
    protected ?PaymentResponseResource $paymentResponse = null;

    /**
     * Contém as informações do método de pagamento da cobrança.
     */
    protected ?PaymentMethodResource $paymentMethod = null;

    /**
     * Contém as informações da recorrência. Os clientes que possuem recorrência própria devem utilizar esse
     * parâmetro para indicar ao PagBank que a cobrança está relacionada a um pagamento recorrente.
     * A utilização desse parâmetro não está vinculada à API de Pagamento Recorrente do PagBank.
     */
    protected ?RecurringResource $recurring = null;

    /**
     * Contém os dados do sub lojista, usado por sub-adquirentes para transações com Cartão de Crédito.
     * Usado apenas por sub-adquirentes autorizados.
     */
    protected ?SubMerchantResource $subMerchant = null;

    /**
     * URLs que serão notificadas em toda alteração ocorrida na cobrança.
     * Necessário que seja em ambiente seguro com SSL (HTTPS).
     *
     * @var string[]
     */
    protected array $notificationUrl = [];

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
     * @return ChargeResource
     */
    public function setId(?string $id): ChargeResource
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return ChargeStatusEnum|null
     */
    public function getStatus(): ?ChargeStatusEnum
    {
        return $this->status;
    }

    /**
     * @param ChargeStatusEnum|null $status
     * @return ChargeResource
     */
    public function setStatus(?ChargeStatusEnum $status): ChargeResource
    {
        $this->status = $status;
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
     * @return ChargeResource
     */
    public function setCreatedAt(?DateTime $createdAt): ChargeResource
    {
        $this->createdAt = $createdAt;
        return $this;
    }

    /**
     * @return DateTime|null
     */
    public function getPaidAt(): ?DateTime
    {
        return $this->paidAt;
    }

    /**
     * @param DateTime|null $paidAt
     * @return ChargeResource
     */
    public function setPaidAt(?DateTime $paidAt): ChargeResource
    {
        $this->paidAt = $paidAt;
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
     * @return ChargeResource
     */
    public function setReferenceId(?string $referenceId): ChargeResource
    {
        $this->referenceId = $referenceId;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * @param string|null $description
     * @return ChargeResource
     */
    public function setDescription(?string $description): ChargeResource
    {
        $this->description = $description;
        return $this;
    }

    /**
     * @return AmountResource|null
     */
    public function getAmount(): ?AmountResource
    {
        return $this->amount;
    }

    /**
     * @param AmountResource|null $amount
     * @return ChargeResource
     */
    public function setAmount(?AmountResource $amount): ChargeResource
    {
        $this->amount = $amount;
        return $this;
    }

    /**
     * @return PaymentResponseResource|null
     */
    public function getPaymentResponse(): ?PaymentResponseResource
    {
        return $this->paymentResponse;
    }

    /**
     * @param PaymentResponseResource|null $paymentResponse
     * @return ChargeResource
     */
    public function setPaymentResponse(?PaymentResponseResource $paymentResponse): ChargeResource
    {
        $this->paymentResponse = $paymentResponse;
        return $this;
    }

    /**
     * @return PaymentMethodResource|null
     */
    public function getPaymentMethod(): ?PaymentMethodResource
    {
        return $this->paymentMethod;
    }

    /**
     * @param PaymentMethodResource|null $paymentMethod
     * @return ChargeResource
     */
    public function setPaymentMethod(?PaymentMethodResource $paymentMethod): ChargeResource
    {
        $this->paymentMethod = $paymentMethod;
        return $this;
    }

    /**
     * @return RecurringResource|null
     */
    public function getRecurring(): ?RecurringResource
    {
        return $this->recurring;
    }

    /**
     * @param RecurringResource|null $recurring
     * @return ChargeResource
     */
    public function setRecurring(?RecurringResource $recurring): ChargeResource
    {
        $this->recurring = $recurring;
        return $this;
    }

    /**
     * @return SubMerchantResource|null
     */
    public function getSubMerchant(): ?SubMerchantResource
    {
        return $this->subMerchant;
    }

    /**
     * @param SubMerchantResource|null $subMerchant
     * @return ChargeResource
     */
    public function setSubMerchant(?SubMerchantResource $subMerchant): ChargeResource
    {
        $this->subMerchant = $subMerchant;
        return $this;
    }

    /**
     * @return array
     */
    public function getNotificationUrl(): array
    {
        return $this->notificationUrl;
    }

    /**
     * @param array $notificationUrl
     * @return ChargeResource
     */
    public function setNotificationUrl(array $notificationUrl): ChargeResource
    {
        $this->notificationUrl = $notificationUrl;
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
     * @return ChargeResource
     */
    public function setLinks(array $links): ChargeResource
    {
        $this->links = $links;
        return $this;
    }
}
