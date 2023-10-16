<?php
declare(strict_types=1);

namespace CanisLupus\ApiClients\PagSeguro\v1\Resources\Common;

use CanisLupus\ApiClients\PagSeguro\v1\Enums\PaymentMethodEnum;
use CanisLupus\ApiClients\PagSeguro\v1\Traits\Arrayable;
use DateTime;

class PaymentMethodResource
{
    use Arrayable;


    /**
     * Indica o método de pagamento usado na cobrança.
     */
    protected PaymentMethodEnum $type;

    /**
     * Quantidade de parcelas. Obrigatório para o método de pagamento Cartão de Crédito.
     * Exemplo: 06
     */
    protected ?int $installments = null;

    /**
     * Parâmetro que indica se uma transação de Cartão de Crédito deve ser apenas pré-autorizada
     * (reserva o valor da cobrança no cartão do cliente de 6 á 29 dias) ou se a transação deve ser
     * capturada automaticamente (cobrança realizada em apenas um passo). Obrigatório para o método de
     * pagamento Cartão de Crédito. Função indisponível para o método de pagamento Cartão de Débito e Token de
     * Bandeira (débito).
     */
    protected bool $capture = true;

    /**
     * Data e horário limite para que seja feita a captura em uma transação com o status AUTHORIZED.
     */
    protected ?DateTime $captureBefore = null;

    /**
     * Parâmetro responsável pelo que será exibido como Nome na Fatura do cliente. Aplicável no momento apenas para
     * Cartão de crédito. Não permite caracteres especiais (acentuações serão substituídas por caracteres sem acentos,
     * demais caracteres especiais serão removidos).
     * 0-17 caracteres.
     * Exemplo: IntegraçãoPagBank
     */
    protected ?string $softDescriptor = null;

    /**
     * Contém os dados de Cartão de Crédito, Cartão de Débito e Token de Bandeira.
     * Obrigatório para o método de pagamento Cartão de Crédito, Cartão de Débito e Token de Bandeira.
     */
    protected ?CardResource $card = null;

    /**
     * Contém os dados de Cartão de Crédito, Cartão de Débito e Token de Bandeira.
     * Obrigatório para o método de pagamento Cartão de Crédito, Cartão de Débito e Token de Bandeira.
     */
    protected ?TokenDataResource $tokenData = null;

    /**
     * Contém os dados adicionais de autenticação vinculados à uma transação.
     * Obrigatório quando payment_method.type = DEBIT_CARD.
     */
    protected ?AuthenticationMethodResource $authenticationMethod = null;

    /**
     * Contém os dados para geração do Boleto.
     */
    protected ?BoletoResource $boleto = null;


    /**
     * @param PaymentMethodEnum $type
     */
    public function __construct(PaymentMethodEnum $type)
    {
        $this->type = $type;
    }


    /* GETTERS/SETTERS */

    /**
     * @return PaymentMethodEnum
     */
    public function getType(): PaymentMethodEnum
    {
        return $this->type;
    }

    /**
     * @param PaymentMethodEnum $type
     * @return PaymentMethodResource
     */
    public function setType(PaymentMethodEnum $type): PaymentMethodResource
    {
        $this->type = $type;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getInstallments(): ?int
    {
        return $this->installments;
    }

    /**
     * @param int|null $installments
     * @return PaymentMethodResource
     */
    public function setInstallments(?int $installments): PaymentMethodResource
    {
        $this->installments = $installments;
        return $this;
    }

    /**
     * @return bool
     */
    public function isCapture(): bool
    {
        return $this->capture;
    }

    /**
     * @param bool $capture
     * @return PaymentMethodResource
     */
    public function setCapture(bool $capture): PaymentMethodResource
    {
        $this->capture = $capture;
        return $this;
    }

    /**
     * @return DateTime|null
     */
    public function getCaptureBefore(): ?DateTime
    {
        return $this->captureBefore;
    }

    /**
     * @param DateTime|null $captureBefore
     * @return PaymentMethodResource
     */
    public function setCaptureBefore(?DateTime $captureBefore): PaymentMethodResource
    {
        $this->captureBefore = $captureBefore;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getSoftDescriptor(): ?string
    {
        return $this->softDescriptor;
    }

    /**
     * @param string|null $softDescriptor
     * @return PaymentMethodResource
     */
    public function setSoftDescriptor(?string $softDescriptor): PaymentMethodResource
    {
        $this->softDescriptor = $softDescriptor;
        return $this;
    }

    /**
     * @return CardResource|null
     */
    public function getCard(): ?CardResource
    {
        return $this->card;
    }

    /**
     * @param CardResource|null $card
     * @return PaymentMethodResource
     */
    public function setCard(?CardResource $card): PaymentMethodResource
    {
        $this->card = $card;
        return $this;
    }

    /**
     * @return TokenDataResource|null
     */
    public function getTokenData(): ?TokenDataResource
    {
        return $this->tokenData;
    }

    /**
     * @param TokenDataResource|null $tokenData
     * @return PaymentMethodResource
     */
    public function setTokenData(?TokenDataResource $tokenData): PaymentMethodResource
    {
        $this->tokenData = $tokenData;
        return $this;
    }

    /**
     * @return AuthenticationMethodResource|null
     */
    public function getAuthenticationMethod(): ?AuthenticationMethodResource
    {
        return $this->authenticationMethod;
    }

    /**
     * @param AuthenticationMethodResource|null $authenticationMethod
     * @return PaymentMethodResource
     */
    public function setAuthenticationMethod(?AuthenticationMethodResource $authenticationMethod): PaymentMethodResource
    {
        $this->authenticationMethod = $authenticationMethod;
        return $this;
    }

    /**
     * @return BoletoResource|null
     */
    public function getBoleto(): ?BoletoResource
    {
        return $this->boleto;
    }

    /**
     * @param BoletoResource|null $boleto
     * @return PaymentMethodResource
     */
    public function setBoleto(?BoletoResource $boleto): PaymentMethodResource
    {
        $this->boleto = $boleto;
        return $this;
    }
}
