<?php

namespace App\Listeners;

use App\Models\User;
use App\Services\Asaas\AsaasService;
use App\Services\Asaas\Entities\Customer;
use App\Services\Asaas\Requests\CreateCustomerDTO;
use Illuminate\Auth\Events\Registered;

class CreateCustomerPaymentGateway
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(Registered $event): void
    {

        /** @var User $user */
        $user = $event->user;

        if(is_null($user->customer)) {
			/** @var Customer */
            $customer       = (new AsaasService())->customers()->post(new CreateCustomerDTO($user->name, $user->cpf));
            $user->customer = $customer->id;
            $user->save();
        }

    }
}
