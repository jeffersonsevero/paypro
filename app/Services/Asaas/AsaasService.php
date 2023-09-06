<?php

namespace App\Services\Asaas;

use App\Services\Asaas\Endpoints\HasCustomers;
use App\Services\Asaas\Endpoints\HasPayments;
use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Http;

class AsaasService
{
    use HasCustomers;
	use HasPayments;

    public PendingRequest $api;

    public function __construct()
    {
        $this->api = Http::withHeaders([
            'Accept'       => 'application/json',
            'Content-Type' => 'application/json',
            'access_token' => config('services.asaas.key'),
        ])->baseUrl(config('services.asaas.url'));
    }

}
