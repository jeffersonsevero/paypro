<?php

use App\Models\User;

use function Pest\Laravel\{actingAs, post};

it('should create a payment with card', function () {

    $customer    = 'cus_13789238921';
    $user        = User::factory()->createOne(['customer' => $customer]);
    $price       = 200;
    $apiResponse = [
        "object"        => "payment",
        "id"            => "pay_9046488561386984",
        "dateCreated"   => "2023-09-12",
        "customer"      => $customer,
        "paymentLink"   => null,
        "value"         => $price,
        "netValue"      => 97.52,
        "originalValue" => null,
        "interestValue" => null,
        "description"   => null,
        "billingType"   => "CREDIT_CARD",
        "confirmedDate" => "2023-09-12",
        "creditCard"    => [
            "creditCardNumber" => "8829",
            "creditCardBrand"  => "MASTERCARD",
            "creditCardToken"  => "4678836d-a1d5-4283-8840-293d99c5dfdf",
        ],
        "pixTransaction"         => null,
        "status"                 => "CONFIRMED",
        "dueDate"                => "2023-09-12",
        "originalDueDate"        => "2023-09-12",
        "paymentDate"            => null,
        "clientPaymentDate"      => "2023-09-12",
        "installmentNumber"      => null,
        "invoiceUrl"             => "https://sandbox.asaas.com/i/9046488561386984",
        "invoiceNumber"          => "03947368",
        "externalReference"      => null,
        "deleted"                => false,
        "anticipated"            => false,
        "anticipable"            => false,
        "creditDate"             => "2023-10-16",
        "estimatedCreditDate"    => "2023-10-16",
        "transactionReceiptUrl"  => "https://sandbox.asaas.com/comprovantes/7037274447771947",
        "nossoNumero"            => null,
        "bankSlipUrl"            => null,
        "lastInvoiceViewedDate"  => null,
        "lastBankSlipViewedDate" => null,
        "postalService"          => false,
        "custody"                => null,
        "refunds"                => null,
    ];

    mockResponse($apiResponse, 200);

    actingAs($user);

    $response = post(route('credit.card'), [
        'name'         => $user->name,
        'number'       => '0000000000000000',
        'cep'          => '89223-005',
        'expiry-month' => '05',
        'expiry-year'  => '2024',
        'ccv'          => '318',
        'phone-number' => '4738010919',
        'home-number'  => '200',
        'value'        => $price,
    ]);

    $response->assertStatus(302);
    $response->assertRedirect(route('dashboard'));

});
