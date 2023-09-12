<?php

namespace App\Actions;

use App\Models\User;
use App\Services\Asaas\AsaasService;
use App\Services\Asaas\Entities\Customer;
use App\Services\Asaas\Requests\CreateCustomerDTO;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\{Auth, Hash};

class RegisterUserAction
{
    public function __construct(
        protected array $payload
    ) {

    }

    public function handle(): void
    {
        /** @var Customer */
        $response = (new AsaasService())->customers()->post(new CreateCustomerDTO(name: $this->payload['name'], cpf: $this->payload['cpf']));
        $user     = User::query()->create([
            'name'     => $this->payload['name'],
            'email'    => $this->payload['email'],
            'cpf'      => $this->payload['cpf'],
            'customer' => $response->id,
            'password' => Hash::make($this->payload['password']),
        ])->first();

        event(new Registered($user));

        Auth::login($user);
    }

}
