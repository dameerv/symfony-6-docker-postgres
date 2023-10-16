<?php

namespace App\Tests\Discount;

use App\Discount\PercentDiscountCalculator;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpKernel\Log\Logger;

class PercentDiscountCalculatorTest extends TestCase
{
    /**
     * @throws \Exception
     */
    public function testPercentDiscountCalculator()
    {
        $logger = new Logger();

        $percentDiscountCalculator = new PercentDiscountCalculator($logger);

        $this->assertEquals('percent', $percentDiscountCalculator->getTypeName());
        $this->assertEquals(95, $percentDiscountCalculator->calculatePriceWithDiscount(100, 5));
        $this->expectException(\Exception::class);
        $this->expectExceptionMessage('The discount percent cannot be greater than 100%. Discount: 105');
        $percentDiscountCalculator->calculatePriceWithDiscount(100, 105);
    }
}
