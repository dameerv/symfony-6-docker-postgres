<?php

namespace App\Discount;

use App\Entity\Coupon;
use Psr\Log\LoggerInterface;

class DiscountManager implements DiscountManagerInterface
{
    /**
     * @param DiscountCalculatorInterface[] $discountCalculators
     */
    public function __construct(
        private readonly array  $discountCalculators,
        private LoggerInterface $logger,
    ) {
    }

    /**
     * @throws \Exception
     */
    public function calculatePriceWithDiscount(float $price, Coupon $coupon): float
    {
        return $this->getDiscountCalculatorByType($coupon->getType())->calculatePriceWithDiscount($price, $coupon->getValue());
    }

    private function getDiscountCalculatorByType(string $couponType): DiscountCalculatorInterface
    {
        foreach ($this->discountCalculators as $discountCalculator) {
            if ($discountCalculator->getTypeName() === $couponType) {
                return $discountCalculator;
            }
        }

        $this->logger->error('Discount calculator is not found');

        throw new \Exception('Sometimes things work differently than we want. We are already aware of the problem.');
    }
}
