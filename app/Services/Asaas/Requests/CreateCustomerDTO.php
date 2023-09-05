<?php

namespace App\Services\Asaas\Requests;

class CreateCustomerDTO
{
    public function __construct(private string $name, private string $cpf)
    {

    }

    public function toArray()
    {
        return [
            'name'    => $this->name,
            'cpfCnpj' => $this->cpf,
        ];
    }

}
