<?php

namespace App\Discount;

interface DiscountCalculatorInterface
{
    public function calculatePriceWithDiscount(float $price, float $discount): float;

    public function getTypeName(): string;
}
