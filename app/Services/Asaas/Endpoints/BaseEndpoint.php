<?php
namespace App\Services\Asaas\Endpoints;

use App\Services\Asaas\AsaasService;
use Illuminate\Support\Collection;

class BaseEndpoint
{

    protected AsaasService $service;

    public function __construct()
    {
        $this->service = new AsaasService();
    }

    protected function transform(mixed $json, string $entity): Collection
    {
        return collect($json)
            ->map(fn ($data) => new $entity($data));
    }


}
