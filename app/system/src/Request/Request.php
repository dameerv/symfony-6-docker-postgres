<?php

namespace App\Request;

use App\Validator as AppAssert;
use Symfony\Component\Validator\Constraints as Assert;

abstract class Request
{
    #[Assert\NotBlank]
    #[Assert\NotNull]
    #[Assert\GreaterThan(0)]
    #[Assert\Type('integer')]
    private ?int $product;

    #[AppAssert\TaxNumber()]
    #[Assert\NotBlank]
    #[Assert\NotNull]
    private ?string $taxNumber;

    private ?string $couponCode;

    public function getProduct(): ?int
    {
        return $this->product;
    }

    public function setProduct(?int $product): Request
    {
        $this->product = $product;

        return $this;
    }

    public function getTaxNumber(): ?string
    {
        return $this->taxNumber;
    }

    public function setTaxNumber(?string $taxNumber): Request
    {
        $this->taxNumber = $taxNumber;

        return $this;
    }

    public function getCouponCode(): ?string
    {
        return $this->couponCode;
    }

    public function setCouponCode(?string $couponCode): Request
    {
        $this->couponCode = $couponCode;

        return $this;
    }
}
