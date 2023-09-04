<?php
namespace App\Services\Asaas\Endpoints;

trait HasCustomers
{

    public function customers(): Customers
    {
        return new Customers();
    }

}
