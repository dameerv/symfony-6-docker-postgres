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
        private readonly EntityManagerInterface   $entityManager
    ) {
    }

    public function getProductById(int $productID): ?Product
    {
        return $this->entityManager->getRepository(Product::class)->find($productID);
    }
}
