<?php

namespace App\Services\Asaas\Endpoints;

use App\Services\Asaas\Entities\Customer;
use App\Services\Asaas\Requests\{CreateCustomerDTO, CreateCustomerRequest};

class Customers extends BaseEndpoint
{
    public function post(CreateCustomerDTO $data)
    {
        $json = $this->service->api->post('/customers', $data->toArray())->json();

        return $this->transform(
            $json,
            Customer::class
        );

    }

}
