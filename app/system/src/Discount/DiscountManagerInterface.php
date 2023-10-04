<?php

namespace App\Discount;

interface DiscountManagerInterface
{
    public function calculatePriceWithDiscount(int $price, int $discount, string $discountType): int;
}