<?php

use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Event;

use function Pest\Laravel\assertDatabaseHas;
use function Pest\Laravel\assertDatabaseMissing;

test('registration screen can be rendered', function () {
    $response = $this->get('/register');

    $response->assertStatus(200);
});

test('new users can register', function () {

    mockResponse([
            "object" => "customer",
            "id" => "cus_13bFHumeyglN",
            "dateCreated" => "08/03/2017",
            "name" => "Test User",
            "email" => "test@example.com",
            "phone" => "4738010919",
            "mobilePhone" => "4799376637",
            "address" => "Av. Paulista",
            "addressNumber" => "150",
            "complement" => "Sala 201",
            "province" => "Centro",
            "postalCode" => "01310000",
            "cpfCnpj" => "00000000000",
            "personType" => "FISICA",
            "deleted" => false,
            "additionalEmails" => "marcelo.almeida2@gmail.com,marcelo.almeida3@gmail.com",
            "externalReference" => "12987382",
            "notificationDisabled" => false,
            "city" => 15873,
            "state" => "SP",
            "country" => "Brasil",
            "observations" => "ótimo pagador, nenhum problema até o momento"

    ], 200);

    $response = $this->post('/register', [
        'name'     => 'Test User',
        'email'    => 'test@example.com',
        'cpf'      => '000.000.000-00',
        'password' => 'password',
    ]);

    $this->assertAuthenticated();
    assertDatabaseHas('users', ['cpf' => '00000000000' ]);
    $response->assertRedirect(RouteServiceProvider::HOME);
});

it('should return error when cpf is invalid', function () {

    $json = '{
		"errors": [
			{
				"code": "invalid_cpfCnpj",
				"description": "O CPF ou CNPJ informado é inválido."
			}
		]
	}';
    mockResponse($json, 400);

    $response = $this->post('/register', [
        'name'     => 'Test User',
        'email'    => 'test@example.com',
        'cpf'      => '000.000.000-00',
        'password' => 'password',
    ]);
    assertDatabaseMissing('users', ['email' => 'test@example.com']);


});
