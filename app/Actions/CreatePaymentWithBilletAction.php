<?php

namespace App\Actions;

use App\Exceptions\ErrorOnPaymentException;
use App\Services\Asaas\AsaasService;
use App\Services\Asaas\Entities\Payment;
use App\Services\Asaas\Requests\CreateChargeDTO;
use Exception;

class CreatePaymentWithBilletAction
{
    public function __construct(protected int $value)
    {

    }

    public function handle(): Payment
    {
        try {
            /** @var Payment */
            $payment = (new AsaasService())->payments()->post(new CreateChargeDTO(
                customer: auth()->user()->customer,
                billingType: 'BOLETO',
                value: $this->value,
                dueDate: now()->addDays(2)->format('Y-m-d')
            ));
            return $payment;

        } catch(ErrorOnPaymentException $exception) {
			toastr()->error($exception->getMessage());
			return redirect()->back();
        } catch(Exception $exception) {
			logger()->critical($exception->getMessage());
        }
    }

}
