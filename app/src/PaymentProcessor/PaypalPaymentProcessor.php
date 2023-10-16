<?php

namespace App\PaymentProcessor;

use Psr\Log\LoggerInterface;
use Systemeio\TestForCandidates\PaymentProcessor\PaypalPaymentProcessor as BaseProcessor;
use Exception;

class PaypalPaymentProcessor extends BaseProcessor implements PaymentProcessorInterface
{
    public function __construct(private readonly LoggerInterface $logger)
    {
    }

    public function makePayment(float $price): bool
    {
        try {
            $this->pay($price);
            $this->logger->info('Made paypal payment. Bla-bla-bla');
        } catch (Exception $exception) {
            $this->logger->error('Failed to make payment. Details: ' . $exception->getMessage());

            return false;
        }

        return true;
    }
}
