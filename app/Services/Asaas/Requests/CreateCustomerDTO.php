<?php

namespace App\Services\Asaas\Requests;

class CreateCustomerDTO
{
    public function __construct(private string $name, private string $cpf)
    {

    }

    /** @return array<string> */
    public function toArray(): array
    {
        return [
            'name'    => $this->name,
            'cpfCnpj' => $this->cpf,
        ];
    }

}
