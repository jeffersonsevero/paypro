<?php

namespace App\Services\Asaas\Endpoints;

use App\Exceptions\ErrorOnCreateCustomerException;
use App\Services\Asaas\Entities\Customer;
use App\Services\Asaas\Requests\{CreateCustomerDTO, CreateCustomerRequest};

class Customers extends BaseEndpoint
{
    public function post(CreateCustomerDTO $data): Customer
    {

        $json = $this->service->api->post('/customers', $data->toArray())->json();

        if(isset($json['errors'])) {
            throw new ErrorOnCreateCustomerException($json['errors'][0]['description'], 400);

        }

        return $this->transform(
            $json,
            Customer::class
        )->first();

    }

}
