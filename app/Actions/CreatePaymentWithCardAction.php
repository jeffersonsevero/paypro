<?php

namespace App\Actions;

use App\Services\Asaas\AsaasService;
use App\Services\Asaas\Entities\{Payment, PixQrCode};
use App\Services\Asaas\Requests\CreateChargeDTO;

class CreatePaymentWithCardAction
{
    public function __construct(protected array $payload)
    {

    }

    public function handle()
    {
		/** @var Payment */
        $payment = (new AsaasService())->payments()
            ->withCreditCard(
                $this->payload['name'],
                $this->payload['number'],
                $this->payload['expiry-month'],
                $this->payload['expiry-year'],
                $this->payload['ccv'],
            )
            ->withHolderInfos(
                name: $this->payload['name'],
                email: auth()->user()->email,
                cpfCnpj: auth()->user()->cpf,
                postalCode: $this->payload['cep'],
                addressNumber: $this->payload['home-number'],
                phone:$this->payload['phone-number']
            )
            ->post(new CreateChargeDTO(
                customer: auth()->user()->customer,
                billingType: 'CREDIT_CARD',
                value: $this->payload['value'],
                dueDate: now()->addDays(2)->format('Y-m-d')
            ));

        return $payment;

    }

}
