<?php

namespace App\Discount;

use App\Entity\Coupon;
use App\Entity\Product;
use Psr\Log\LoggerInterface;

class FixDiscountCalculator implements DiscountCalculatorInterface
{
    private const NAME = 'fix';

    public function __construct(private LoggerInterface $logger)
    {
    }

    public function calculateDiscount(int $price, int $discount): int
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
