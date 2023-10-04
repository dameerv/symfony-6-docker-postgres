<?php

namespace App\Controller;

use App\Manager\CouponManager;
use App\Manager\ProductManager;
use App\Manager\TaxManager;
use App\Request\PriceRequest;
use Doctrine\ORM\NonUniqueResultException;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class PriceController extends AbstractController
{
    public function __construct(
        private readonly TaxManager     $taxManager,
        private readonly ProductManager $productManager,
        private readonly CouponManager  $couponManager,
    ) {
    }

    /**
     * @throws NonUniqueResultException
     * @throws \Exception
     */
    #[Route('/calculate-price', name: 'app_calculate_price')]
    public function index(PriceRequest $request): JsonResponse
    {
        $tax = $this->taxManager->getTaxByCountryCode(substr($request->getTaxNumber(), 0, 2));

        $product = $this->productManager->getProductById($request->getProduct());
        if ($product === null) {
            return $this->json([
                'success' => false,
                'errors' => 'Product is not found',
            ], 400);
        }

        $coupon = $this->couponManager->getByCode($request->getCouponCode());
        $price = $this->productManager->calculatePrice($product, $tax, $coupon);

        return $this->json([
            'success' => true,
            'data' => $price
        ]);
    }
}
