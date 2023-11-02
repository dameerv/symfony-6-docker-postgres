<?php

namespace App\Discount;

use Psr\Log\LoggerInterface;

readonly class PercentDiscountCalculator implements DiscountCalculatorInterface
{
    private const NAME = 'percent';

    public function __construct(private LoggerInterface $logger)
    {
    }

    public function calculatePriceWithDiscount(float $price, float $discount): float
    {
        if ($discount > 100) {
            $message = sprintf('The discount percent cannot be greater than 100%%. Discount: %u', $discount);
            $this->logger->error($message);

            throw new \Exception($message);
        }

        return $price - ($price / 100 * $discount);
    }

    public function getTypeName(): string
    {
        return self::NAME;
    }
}
