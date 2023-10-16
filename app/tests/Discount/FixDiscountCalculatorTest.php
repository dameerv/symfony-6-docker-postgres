<?php

namespace App\Tests\Discount;

use App\Discount\FixDiscountCalculator;
use PHPUnit\Framework\TestCase;
use Psr\Log\LoggerInterface;
use Symfony\Component\HttpKernel\Log\Logger;

class FixDiscountCalculatorTest extends TestCase
{
    /**
     * @throws \Exception
     */
    public function testFixDiscountCalculator()
    {
        $logger = new Logger();
        $fixDiscountCalculator = new FixDiscountCalculator($logger);

        $this->assertEquals('fix', $fixDiscountCalculator->getTypeName());
        $this->assertEquals(95, $fixDiscountCalculator->calculatePriceWithDiscount(100.0, 5.0));
        $this->expectException(\Exception::class);
        $fixDiscountCalculator->calculatePriceWithDiscount(100.0, 105.0);
    }
}
