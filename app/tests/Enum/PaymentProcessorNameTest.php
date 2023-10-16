<?php

namespace App\Tests\Enum;

use App\Enum\PaymentProcessorName;
use PHPUnit\Framework\TestCase;

class PaymentProcessorNameTest extends TestCase
{
    public function testPaymentProcessorNameEnum()
    {
        $this->assertEquals('Stripe', PaymentProcessorName::Stripe->name);
        $this->assertEquals('stripe', PaymentProcessorName::Stripe->value);
        $this->assertEquals('Paypal', PaymentProcessorName::Paypal->name);
        $this->assertEquals('paypal', PaymentProcessorName::Paypal->value);
    }
}
