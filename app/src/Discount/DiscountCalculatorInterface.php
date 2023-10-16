<?php

namespace App\Discount;

use App\Entity\Coupon;
use App\Entity\Product;

interface DiscountCalculatorInterface
{
    public function calculatePriceWithDiscount(float $price, float $discount): float;

    public function getTypeName(): string;
}
