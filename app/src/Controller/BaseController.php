<?php

namespace App\Controller;

use App\Dto\PriceResponseData;
use App\Dto\Request;
use App\Entity\Product;
use App\Exception\ProductNotFoundException;
use App\Manager\CouponManager;
use App\Manager\PriceManager;
use App\Manager\ProductManager;
use App\Manager\TaxManager;
use Doctrine\ORM\NonUniqueResultException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

abstract class BaseController extends AbstractController
{
    public function __construct(
        private readonly TaxManager $taxManager,
        private readonly ProductManager $productManager,
        private readonly CouponManager $couponManager,
        private readonly PriceManager $priceManager,
    ) {
    }

    /**
     * @throws ProductNotFoundException
     * @throws NonUniqueResultException
     */
    protected function getPriceResponse(Request $request): PriceResponseData
    {
        $tax = $this->taxManager->getTaxByCountryCode(
            substr($request->getTaxNumber(), 0, 2)
        );
        $product = $this->getProduct($request->getProduct());
        $coupon = $this->couponManager->getByCode($request->getCouponCode());

        return $this->priceManager->getPriceResponse($product, $tax, $coupon);
    }

    /**
     * @throws ProductNotFoundException
     */
    protected function getProduct(int $productId): Product
    {
        $product = $this->productManager->getProductById($productId);
        if (null === $product) {
            throw new ProductNotFoundException($productId);
        }

        return $product;
    }
}
