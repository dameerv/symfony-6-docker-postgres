<?php

namespace App\PaymentProcessor;

use Psr\Log\LoggerInterface;
use Systemeio\TestForCandidates\PaymentProcessor\StripePaymentProcessor as BaseProcessor;

class StripePaymentProcessor extends BaseProcessor implements PaymentProcessorInterface
{
    public function __construct(private LoggerInterface $logger)
    {
    }

    public function makePayment(float $price): bool
    {
        if($this->processPayment($price)) {
            $this->logger->info('Made stripe payment. Bla-bla-bla');

            return true;
        }

        $this->logger->error('Failed to make payment.');

        return false;
    }
}
