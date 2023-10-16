<?php

namespace App\Dto;

use App\Validator as AppAssert;
use Symfony\Component\Validator\Constraints as Assert;

abstract class Request implements PriceRequestInterface
{
    public function __construct(
        #[Assert\NotBlank]
        #[Assert\NotNull]
        #[Assert\GreaterThan(0)]
        #[Assert\Type('integer')]
        readonly private ?int $product,
        #[AppAssert\TaxNumber]
        #[Assert\NotBlank]
        #[Assert\NotNull]
        readonly private ?string $taxNumber,
        #[Assert\Type('string')]
        #[Assert\NotBlank]
        readonly private ?string $couponCode,
    ) {
    }

    public function getProduct(): ?int
    {
        return $this->product;
    }

    public function getTaxNumber(): ?string
    {
        return $this->taxNumber;
    }

    public function getCouponCode(): ?string
    {
        return $this->couponCode;
    }
}
