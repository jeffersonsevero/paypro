<?php

class CreateChargeAction
{
    public function __construct(
        private readonly string $price,
        private readonly string $paymentType,
    ) {

    }

    public function handle(): self
    {
        logger($this->paymentType);
        logger($this->price);

        return $this;
    }

}
