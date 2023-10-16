<?php

namespace App\Discount;

use App\Entity\Coupon;

interface DiscountManagerInterface
{
    public function calculatePriceWithDiscount(float $price, Coupon $coupon): float;
}