<?php

namespace App\Services\Asaas\Requests;

class CreateChargeDTO
{
    public function __construct(
		private string $customer,
		private string $billingType,
		private int $value,
		private string $dueDate,
		)
    {

    }

    /** @return array<string> */
    public function toArray(): array
    {
        return [
            'customer'    => $this->customer,
            'billingType' => $this->billingType,
			'value' => $this->value,
			'dueDate' => $this->dueDate,

        ];
    }

}
