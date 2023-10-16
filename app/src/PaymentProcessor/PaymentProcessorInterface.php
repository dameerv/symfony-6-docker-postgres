<?php

namespace App\PaymentProcessor;

interface PaymentProcessorInterface
{
    public function makePayment(float $price): bool;
}