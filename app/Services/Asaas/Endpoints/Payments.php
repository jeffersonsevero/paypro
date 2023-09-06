<?php

namespace App\Services\Asaas\Endpoints;

use App\Exceptions\ErrorOnPaymentException;
use App\Services\Asaas\Entities\Charge;
use App\Services\Asaas\Entities\Customer;
use App\Services\Asaas\Entities\Payment;
use App\Services\Asaas\Entities\PixQrCode;
use App\Services\Asaas\Requests\CreateChargeDTO;
use App\Services\Asaas\Requests\CreateChargeWithBilletDTO;
use App\Services\Asaas\Requests\CreateCustomerDTO;
use App\Services\Asaas\Requests\CreateCustomerRequest;

class Payments extends BaseEndpoint
{

    protected ?array $creditCard = [];
    protected ?array $holderInfos = [];


    public function withCreditCard(
		string $holderName,
		string $number,
		string $expiryMonth,
		string $expiryYear,
		string $ccv,

	): self
    {
		$this->creditCard = [
			'holderName' => $holderName,
			'number' => $number,
			'expiryMonth' => $expiryMonth,
			'expiryYear' => $expiryYear,
			'ccv' => $ccv,
		];
		return $this;
    }


	public function withHolderInfos
	(
		string $name,
		string $email,
		string $cpfCnpj,
		string $postalCode,
		string $addressNumber,
		string $phone,
	): self
	{
		$this->holderInfos = [
			'name' => $name,
			'email' => $email,
			'cpfCnpj' => $cpfCnpj,
			'postalCode' => $postalCode,
			'addressNumber' => $addressNumber,
			'phone' => $phone,
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
		if($this->creditCardFieldsAreFilled()){
			$data['creditCard'] = $this->creditCard;
			$data['creditCardHolderInfo'] = $this->holderInfos;
		}
        $json = $this->service->api->post('/payments', $data)->json();

		if($json['errors']){
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
