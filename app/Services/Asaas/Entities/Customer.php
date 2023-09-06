<?php

namespace App\Services\Asaas\Entities;

class Customer
{
    public ?string $id;

    public ?string $name;

    public ?string $cpfCnpj;

    public function __construct(mixed $data)
    {
        $this->id      = data_get($data, 'id');
        $this->name    = data_get($data, 'name');
        $this->cpfCnpj = data_get($data, 'cpfCnpj');
    }

}
