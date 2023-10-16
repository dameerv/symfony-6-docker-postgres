<?php

namespace App\Dto;

use App\Validator as AppAssert;
use Symfony\Component\Validator\Constraints as Assert;

class PurchaseRequest extends Request
{
    public function __construct(
        #[Assert\NotBlank]
        #[Assert\NotNull]
        #[Assert\GreaterThan(0)]
        #[Assert\Type('integer')]
        ?int $product,
        #[AppAssert\TaxNumber]
        #[Assert\NotBlank]
        #[Assert\NotNull]
        ?string $taxNumber,
        ?string $couponCode,
        private ?string $paymentProcessor = null
    ) {
        parent::__construct($product, $taxNumber, $couponCode);
    }

    public function getPaymentProcessor(): ?string
    {
        return $this->paymentProcessor;
    }
}
