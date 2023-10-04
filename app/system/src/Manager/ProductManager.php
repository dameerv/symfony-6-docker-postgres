<?php

namespace App\Manager;

use App\Discount\DiscountManagerInterface;
use App\Entity\Coupon;
use App\Entity\Product;
use App\Entity\Tax;
use Doctrine\ORM\EntityManagerInterface;

class ProductManager
{
    public function __construct(
        private readonly EntityManagerInterface   $entityManager,
        private readonly DiscountManagerInterface $discountManager,
    ) {
    }

    public function getProductById(int $productID): ?Product
    {
        return $this->entityManager->getRepository(Product::class)->find($productID);
    }

    public function calculatePrice(Product $product, Tax $tax, ?Coupon $coupon = null): array
    {
        $price = $product->getPrice();
        $response = ['basePrice' => $price];

        if ($coupon !== null) {
            $price = $this->discountManager->calculatePriceWithDiscount(
                $product->getPrice(),
                $coupon->getValue(),
                $coupon->getType()
            );

            $discount = $product->getPrice() - $price;
            $response['priceWithDiscount'] = $price;
            $response['discount'] = $discount;
        }

        $taxValue = $price / 100 * $tax->getValue();
        $response['price'] = $price + $taxValue;
        $response['tax'] = sprintf('%u (%u%%)', $taxValue, $tax->getValue());

        return $response;
    }
}
