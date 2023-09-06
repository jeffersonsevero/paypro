<?php

namespace App\Services\Asaas\Endpoints;

trait HasPayments
{
    public function payments(): Payments
    {
        return new Payments();
    }

}
