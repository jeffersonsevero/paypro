<?php

use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Event;

test('registration screen can be rendered', function () {
    $response = $this->get('/register');

    $response->assertStatus(200);
});

test('new users can register', function () {

    Event::fake();

    $response = $this->post('/register', [
        'name'     => 'Test User',
        'email'    => 'test@example.com',
        'cpf'      => '000.000.000-00',
        'password' => 'password',
    ]);

    Event::assertDispatched(Registered::class);

    $this->assertAuthenticated();
    $response->assertRedirect(RouteServiceProvider::HOME);
});
