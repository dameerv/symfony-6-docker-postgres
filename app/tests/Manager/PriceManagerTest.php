<?php

namespace App\Tests\Manager;

use App\Discount\DiscountManager;
use App\Discount\FixDiscountCalculator;
use App\Discount\PercentDiscountCalculator;
use App\Dto\PriceResponseData;
use App\Entity\Country;
use App\Entity\Coupon;
use App\Entity\Product;
use App\Entity\Tax;
use App\Manager\PriceManager;
use PHPUnit\Framework\TestCase;
use Psr\Log\NullLogger;

class PriceManagerTest extends TestCase
{

    public function testGetPriceResponseWithCoupon()
    {
        $product = new Product();

        $product
            ->setPrice(100)
            ->setName('Iphone');

        $country = new Country();
        $tax = new Tax();
        $tax
            ->setTaxNumber('DE123456789')
            ->setValue(16)
            ->setCountry($country);

        $coupon = new Coupon();
        $coupon->setCode('D15')
            ->setType('fix')
            ->setValue(5);

        $priceResponseData = $this->getPriceResponse($product, $tax, $coupon);

        $this->assertIsFloat($priceResponseData->price);
        $this->assertIsFloat($priceResponseData->basePrice);
        $this->assertIsFloat($priceResponseData->discount);
        $this->assertIsFloat($priceResponseData->priceWithDiscount);
        $this->assertIsString($priceResponseData->tax);

        $this->assertEquals(110.2, $priceResponseData->price);
        $this->assertEquals(100.0, $priceResponseData->basePrice);
        $this->assertEquals(5.0, $priceResponseData->discount);
        $this->assertEquals(95.0, $priceResponseData->priceWithDiscount);
        $this->assertEquals('15 (16%)', $priceResponseData->tax);
    }

    public function testGetPriceResponseWithoutCoupon()
    {
        $product = new Product();

        $product
            ->setPrice(100)
            ->setName('Iphone');

        $country = new Country();
        $tax = new Tax();
        $tax
            ->setTaxNumber('DE123456789')
            ->setValue(16)
            ->setCountry($country);

        $priceResponseData = $this->getPriceResponse($product, $tax);

        $this->assertIsFloat($priceResponseData->price);
        $this->assertIsFloat($priceResponseData->basePrice);
        $this->assertNull($priceResponseData->discount);
        $this->assertIsFloat($priceResponseData->priceWithDiscount);
        $this->assertIsString($priceResponseData->tax);

        $this->assertEquals(116.0, $priceResponseData->price);
        $this->assertEquals(100.0, $priceResponseData->basePrice);
        $this->assertEquals(100.0, $priceResponseData->priceWithDiscount);
        $this->assertEquals('16 (16%)', $priceResponseData->tax);
    }

    public function getPriceResponse(Product $product, Tax $tax, ?Coupon $coupon = null): PriceResponseData
    {
        $logger = new NullLogger();
        $discountManager = new DiscountManager([
            new FixDiscountCalculator($logger),
            new PercentDiscountCalculator($logger)
        ],
            $logger
        );
        $priceManager = new PriceManager($discountManager);

        return $priceManager->getPriceResponse($product, $tax, $coupon);
    }
}
