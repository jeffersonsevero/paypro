<?php

namespace App\Services\Asaas\Entities;

class Payment
{
    public ?string $customer;

    public ?string $id;

    public ?string $billingType;

    public ?string $errors;

    public ?string $dueDate;

    public ?string $bankSlipUrl;

    public ?string $status;

    public ?int $value;

    public function __construct(mixed $data)
    {
        $this->customer    = data_get($data, 'customer');
        $this->billingType = data_get($data, 'billingType');
        $this->dueDate     = data_get($data, 'dueDate');
        $this->value       = data_get($data, 'value');
        $this->bankSlipUrl = data_get($data, 'bankSlipUrl');
        $this->status      = data_get($data, 'status');
        $this->id          = data_get($data, 'id');
        $this->errors      = data_get($data, 'errors');
    }

}
