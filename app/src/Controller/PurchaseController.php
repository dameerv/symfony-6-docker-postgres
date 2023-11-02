<?php

namespace App\Controller;

use App\Dto\PurchaseRequest;
use App\Enum\PaymentProcessorName;
use App\Exception\ProductNotFoundException;
use App\Manager\PurchaseHandler;
use Doctrine\ORM\NonUniqueResultException;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class PurchaseController extends BaseController
{
    /**
     * @throws ProductNotFoundException
     * @throws NonUniqueResultException
     * @throws \Exception
     */
    #[Route('/purchase', name: 'app_purchase', methods: 'POST')]
    public function index(PurchaseRequest $request, PurchaseHandler $paymentProcessorHandler): JsonResponse
    {
        $priceResponseData = $this->getPriceResponse($request);

        $success = $paymentProcessorHandler->purchase(
            PaymentProcessorName::tryFrom($request->getPaymentProcessor()),
            $priceResponseData->price
        );

        if (!$success) {
            throw new \Exception('Failed to make payment.');
        }

        return $this->json([
            'success' => true,
            'data' => $priceResponseData,
        ]);
    }
}
