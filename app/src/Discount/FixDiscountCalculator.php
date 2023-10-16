<?php

namespace App\Discount;

use Psr\Log\LoggerInterface;

readonly class FixDiscountCalculator implements DiscountCalculatorInterface
{
    private const NAME = 'fix';

    public function __construct(private LoggerInterface $logger)
    {
    }

    public function calculatePriceWithDiscount(float $price, float $discount): float
    {
        if ($discount > $price) {
            $message = sprintf('The discount cannot be greater than the price. Discount: %s, Price: %s', $discount, $price);
            $this->logger->error($message);

            throw new \Exception($message);
        }

        return $price - $discount;
    }

    public function getTypeName(): string
    {
        return self::NAME;
    }
}
