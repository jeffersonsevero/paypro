<?php

namespace App\Services\Asaas\Entities;

class PixQrCode
{
    public ?bool $success;

    public ?string $encodedImage;

    public ?string $payload;

    public ?string $expirationDate;

    public function __construct(mixed $data)
    {
        $this->success        = data_get($data, 'success');
        $this->encodedImage   = data_get($data, 'encodedImage');
        $this->payload        = data_get($data, 'payload');
        $this->expirationDate = data_get($data, 'expirationDate');
    }

}
