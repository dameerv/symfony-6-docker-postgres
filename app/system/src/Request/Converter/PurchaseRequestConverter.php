<?php

namespace App\Request\Converter;

use App\Request\PurchaseRequest;
use App\Request\Request;

class PurchaseRequestConverter implements RequestConverterInterface
{
    public function convertFromArray(array $data): Request
    {
        $request =  new PurchaseRequest();

        return $request
            ->setProduct((int)$data['product']??null)
            ->setTaxNumber($data['taxNumber']??null)
            ->setCouponCode($data['couponCode']??null)
            ->setPaymentProcessor($data['paymentProcessor']??null)
            ;
    }
}
