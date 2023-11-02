<?php

namespace App\Controller;

use App\Dto\PriceRequest;
use Doctrine\ORM\NonUniqueResultException;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class PriceController extends BaseController
{
    /**
     * @throws NonUniqueResultException
     * @throws \Exception
     */
    #[Route('/calculate-price', name: 'app_calculate_price')]
    public function __invoke(PriceRequest $request): JsonResponse
    {
        return $this->json([
            'success' => true,
            'data' => $this->getPriceResponse($request),
        ]);
    }
}
