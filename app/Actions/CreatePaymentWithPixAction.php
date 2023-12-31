<?php

namespace App\Actions;

use App\Exceptions\ErrorOnPaymentException;
use App\Services\Asaas\AsaasService;
use App\Services\Asaas\Entities\{Payment, PixQrCode};
use App\Services\Asaas\Requests\CreateChargeDTO;
use Exception;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class CreatePaymentWithPixAction
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
                billingType: 'PIX',
                value: $this->value,
                dueDate: now()->addDays(2)->format('Y-m-d')
            ));

            /** @var PixQrCode */
            $pixQrCode = (new AsaasService())->payments()->getPixQrCode($payment->id);
            $imageName = Str::random(10) . '.png';
            Storage::disk('public')->put($imageName, base64_decode($pixQrCode->encodedImage));
            $url                = url('/storage/' . $imageName);
            $payment->qrCodeURL = $url;
            $payment->payload   = $pixQrCode->payload;

            return $payment;

        } catch(ErrorOnPaymentException $exception) {
            toastr()->error($exception->getMessage());

            return redirect()->back();
        } catch(Exception $exception) {

        }
    }

}
