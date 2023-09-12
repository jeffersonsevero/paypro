<?php

use App\Models\User;

use function Pest\Laravel\{actingAs, post};

it('should create a payment with billet', function () {

    $customer    = 'cus_13789238921';
    $user        = User::factory()->createOne(['customer' => $customer]);
    $price       = 200;
    $apiResponse = [
        "object"                => "payment",
        "id"                    => "pay_080225913252",
        "dateCreated"           => "2017-03-10",
        "customer"              => $customer,
        "paymentLink"           => null,
        "dueDate"               => "2017-06-10",
        "value"                 => $price,
        "netValue"              => 95,
        "billingType"           => "BOLETO",
        "canBePaidAfterDueDate" => true,
        "pixTransaction"        => null,
        "status"                => "PENDING",
        "description"           => "Pedido 056984",
        "externalReference"     => "056984",
        "originalValue"         => null,
        "interestValue"         => null,
        "originalDueDate"       => "2017-06-10",
        "paymentDate"           => null,
        "clientPaymentDate"     => null,
        "installmentNumber"     => null,
        "transactionReceiptUrl" => null,
        "nossoNumero"           => "6453",
        "invoiceUrl"            => "https://www.asaas.com/i/080225913252",
        "bankSlipUrl"           => "https://www.asaas.com/b/pdf/080225913252",
        "invoiceNumber"         => "00005101",

    ];

    mockResponse($apiResponse, 200);

    actingAs($user);

    $response = post(route('payment.handle', ['payment-type' => 'billet', 'price' => $price]));
    $response->assertStatus(302);
    $response->assertRedirectContains(route('payment.success'));

});
