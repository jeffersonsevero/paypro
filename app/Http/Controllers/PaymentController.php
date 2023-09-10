<?php

namespace App\Http\Controllers;

use App\Actions\{CreatePaymentWithBilletAction, CreatePaymentWithPixAction};
use App\Http\Requests\CreatePaymentRequest;
use Illuminate\Contracts\View\View;

class PaymentController extends Controller
{
    public function handle(CreatePaymentRequest $request)
    {
        if($request->get('payment-type') === 'billet') {

            $payment = (new CreatePaymentWithBilletAction($request->get('price')))->handle();

            return redirect()->to(route('payment.success', ['payment' => $payment]));

        } elseif($request->get('payment-type') === 'pix') {
            $payment = (new CreatePaymentWithPixAction($request->get('price')))->handle();

            return redirect()->to(route('payment.success', ['payment' => $payment]));
        }
    }

    public function success(): View
    {
        return view('payments.success', request()->all());
    }

}
