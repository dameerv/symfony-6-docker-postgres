<?php

namespace App\Manager;

use App\Discount\DiscountManagerInterface;
use App\Dto\PriceResponseData;
use App\Entity\Coupon;
use App\Entity\Product;
use App\Entity\Tax;

readonly class PriceManager
{
    public function __construct(
        private DiscountManagerInterface $discountManager,
    ) {
    }

    public function getPriceResponse(Product $product, Tax $tax, Coupon $coupon = null): PriceResponseData
    {
        $priceWithDiscount = $coupon ? $this->discountManager->calculatePriceWithDiscount(
            $product->getPrice(),
            $coupon
        ) : $product->getPrice();

        $discount = $coupon ? $product->getPrice() - $priceWithDiscount : null;

        $taxValue = $priceWithDiscount / 100 * $tax->getValue();

        return new PriceResponseData(
            basePrice: $product->getPrice(),
            price: $priceWithDiscount + $taxValue,
            tax: sprintf('%u (%u%%)', $taxValue, $tax->getValue()),
            discount: $discount ?: null,
            priceWithDiscount: $priceWithDiscount,
        );
    }
}
