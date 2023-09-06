<?php

use App\Listeners\CreateCustomerPaymentGateway;
use App\Models\User;
use Illuminate\Auth\Events\Registered;

it('should create customer in payment gateway', function () {

    $customerCode = 'cus_0000054212313';

    mockResponse(json_encode([
        'id'      => $customerCode,
        'name'    => 'Name test',
        'cpfCnpj' => '00000000000',
    ]), 200);

    $user = User::factory()->createOne([
        'name'     => 'Name test',
        'cpf'      => '00000000000',
    ]);

    (new CreateCustomerPaymentGateway())->handle(new Registered($user));

    expect($user->customer)->toBe($customerCode);

});
