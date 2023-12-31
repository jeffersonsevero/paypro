<?php

namespace App\Http\Controllers;

use App\Actions\{CreatePaymentWithBilletAction, CreatePaymentWithCardAction, CreatePaymentWithPixAction};
use App\Exceptions\ErrorOnPaymentException;
use App\Http\Requests\{CreatePaymentRequest, HandlePaymentWithCardRequest};
use App\Services\Asaas\Entities\Payment;
use Exception;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class PaymentController extends Controller
{
    public function handle(CreatePaymentRequest $request): RedirectResponse
    {

        $value = toOnlyDigits($request->get('price'));

        if($request->get('payment-type') === 'billet') {

            $payment = (new CreatePaymentWithBilletAction($value))->handle();

            return redirect()->to(route('payment.success', ['payment' => $payment]));

        } elseif($request->get('payment-type') === 'pix') {
            $payment = (new CreatePaymentWithPixAction($value))->handle();

            return redirect()->to(route('payment.success', ['payment' => $payment]));
        } elseif($request->get('payment-type') === 'card') {
            return redirect()->to(route('payment.checkout', ['value' => $value]));
        }
    }

    public function checkout(): View
    {
        $data = array_merge(request()->all(), config('checkout'));

        return view('payments.checkout', $data);
    }

    public function paymentWithCreditCard(HandlePaymentWithCardRequest $request)
    {
        try {
            $name      = $request->get('name');
            $serielize = collect($request->all())->except('name')->map(function ($data) {
                return toOnlyDigits($data);
            });

            $serielize->prepend($name, 'name');
            /** @var Payment */
            $payment = (new CreatePaymentWithCardAction($serielize->toArray()))->handle();

            if($payment->id) {
                toastr()->success('Cobrança efetuada com sucesso!');

                return redirect()->to(route('dashboard'));
            }

        } catch(ErrorOnPaymentException $exception) {
            toastr()->error($exception->getMessage());

            return redirect()->back();
        } catch(Exception $exception) {
            toastr()->error('Ooops, ocorreu algum erro interno');
            logger()->emergency($exception->getMessage());
        }
    }

    public function success(): View
    {
        return view('payments.success', request()->all());
    }

}
