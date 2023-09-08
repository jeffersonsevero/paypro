<?php

namespace App\Services\Asaas\Endpoints;

use App\Exceptions\ErrorOnPaymentException;
use App\Services\Asaas\Entities\{Charge, Customer, Payment, PixQrCode};
use App\Services\Asaas\Requests\{CreateChargeDTO, CreateChargeWithBilletDTO, CreateCustomerDTO, CreateCustomerRequest};

class Payments extends BaseEndpoint
{
	/** @var array<string> */
    protected ?array $creditCard = [];

	/** @var array<string> */
    protected ?array $holderInfos = [];

    public function withCreditCard(
        string $holderName,
        string $number,
        string $expiryMonth,
        string $expiryYear,
        string $ccv,
    ): self {
        $this->creditCard = [
            'holderName'  => $holderName,
            'number'      => $number,
            'expiryMonth' => $expiryMonth,
            'expiryYear'  => $expiryYear,
            'ccv'         => $ccv,
        ];

        return $this;
    }

    public function withHolderInfos(
        string $name,
        string $email,
        string $cpfCnpj,
        string $postalCode,
        string $addressNumber,
        string $phone,
    ): self {
        $this->holderInfos = [
            'name'          => $name,
            'email'         => $email,
            'cpfCnpj'       => $cpfCnpj,
            'postalCode'    => $postalCode,
            'addressNumber' => $addressNumber,
            'phone'         => $phone,
        ];

        return $this;
    }

    private function creditCardFieldsAreFilled(): bool
    {
        return sizeof($this->creditCard) > 1 && sizeof($this->holderInfos) > 1;
    }

    public function post(CreateChargeDTO $data): Payment
    {

        $data = $data->toArray();

        if($this->creditCardFieldsAreFilled()) {
            $data['creditCard']           = $this->creditCard;
            $data['creditCardHolderInfo'] = $this->holderInfos;
        }
        $json = $this->service->api->post('/payments', $data)->json();

        if(isset($json['errors'])) {
            throw new ErrorOnPaymentException($json['errors'][0]['description'], 401);
        }

        return $this->transform(
            $json,
            Payment::class
        )->first();

    }

    public function getPixQrCode(string $paymentId): PixQrCode
    {
        $json = $this->service->api->post("/payments/{$paymentId}/pixQrCode")->json();

        return $this->transform(
            $json,
            PixQrCode::class
        )->first();

    }

}
