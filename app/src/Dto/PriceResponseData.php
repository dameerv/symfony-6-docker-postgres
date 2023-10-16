<?php

namespace App\Dto;

class PriceResponseData
{
    public function __construct(
        public float $basePrice,
        public float $price,
        public string $tax,
        public ?float $discount = null,
        public ?float $priceWithDiscount = null,
    ) {
    }
}
