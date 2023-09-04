<?php
namespace App\Services\Asaas\Entities;

class Customer
{
	public readonly string $id;
	public readonly string $name;
	public readonly string $cpfCnpj;


	public function __construct(array $data)
	{
		$this->id = data_get($data, 'id');
		$this->name = data_get($data, 'name');
		$this->cpfCnpj = data_get($data, 'cpfCnpj');
	}

}
