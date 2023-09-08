<?php

namespace App\Http\Controllers;

use App\Actions\CreatePaymentWithBilletAction;
use App\Http\Requests\CreatePaymentRequest;
use App\Services\Asaas\AsaasService;
use App\Services\Asaas\Entities\Payment;
use App\Services\Asaas\Requests\CreateChargeDTO;
use Illuminate\Contracts\View\View;

class PaymentController extends Controller
{
    public function handle(CreatePaymentRequest $request)
    {
        if($request->get('payment-type') === 'billet') {

            $payment = (new CreatePaymentWithBilletAction($request->get('price')))->handle();
            return redirect()->to(route('payment.success', ['payment' => $payment]));

        }
    }


    public function success(): View
    {
        return view('payments.success', request()->all());
    }

}
