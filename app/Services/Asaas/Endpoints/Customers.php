<?php
namespace App\Services\Asaas\Endpoints;

use App\Services\Asaas\Entities\Customer;

class Customers extends BaseEndpoint
{


    public function post(array $data)
    {
		dd($this->service->api->post('/customers', $data)->json());
		dd($this->service->api->post('/customers', $data)->json('data'));
        $test = $this->transform(
            $this->service->api->post('/customers')->json($data),
            Customer::class
        )->first();

    }


}
