<?php

namespace App\Discount;

use App\Entity\Coupon;
use App\Entity\Product;

class PercentDiscountCalculator implements DiscountCalculatorInterface
{
    private const NAME = 'percent';
    public function calculateDiscount(int $price, int $discount): int
    {
        return $price - ($price / 100 * $discount);
    }

    public function getTypeName(): string
    {
        return self::NAME;
    }
}
