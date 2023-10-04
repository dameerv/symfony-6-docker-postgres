<?php

namespace App\Request;

class PurchaseRequest extends Request
{
    private ?string $paymentProcessor = null;

    public function getPaymentProcessor(): ?string
    {
        return $this->paymentProcessor;
    }

    public function setPaymentProcessor(?string $paymentProcessor): PurchaseRequest
    {
        $this->paymentProcessor = $paymentProcessor;

        return $this;
    }
}
