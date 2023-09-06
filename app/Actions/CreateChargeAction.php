<?php

class CreateChargeAction
{
    public function __construct(
        private readonly string $price,
        private readonly string $paymentType,
    ) {

    }

    public function handle()
    {

    }

}
