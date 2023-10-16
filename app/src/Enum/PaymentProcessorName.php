<?php

namespace App\Enum;

enum PaymentProcessorName: string
{
    case Paypal = 'paypal';
    case Stripe = 'stripe';
}
