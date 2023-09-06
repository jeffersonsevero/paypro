<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePaymentRequest;

class PaymentController extends Controller
{
    public function handle(CreatePaymentRequest $request)
    {
        dd($request->all());
    }

}
