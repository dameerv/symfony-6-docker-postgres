<?php

namespace App\Manager;

use App\Enum\PaymentProcessorName;
use App\PaymentProcessor\PaymentProcessorInterface;
use App\PaymentProcessor\PaypalPaymentProcessor;
use App\PaymentProcessor\StripePaymentProcessor;
use Psr\Log\LoggerInterface;

readonly class PurchaseHandler
{
    public function __construct(private LoggerInterface $logger)
    {
    }

    public function purchase(PaymentProcessorName $purchaseProcessorName, float $price): bool
    {
        $purchaseProcessor = $this->getProcessor($purchaseProcessorName);

        return $purchaseProcessor->makePayment($price);
    }

    private function getProcessor(PaymentProcessorName $paymentProcessorName): PaymentProcessorInterface
    {
        return match ($paymentProcessorName) {
            PaymentProcessorName::Paypal => new PaypalPaymentProcessor($this->logger),
            PaymentProcessorName::Stripe => new StripePaymentProcessor($this->logger),
        };
    }
}
