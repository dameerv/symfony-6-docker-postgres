<?php

namespace App\Discount;

use App\Entity\Coupon;
use App\Entity\Product;

interface DiscountCalculatorInterface
{
    public function calculateDiscount(int $price, int $discount): int;

    public function getTypeName(): string;
}
