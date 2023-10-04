<?php

namespace App\Request\Converter;

use App\Request\PriceRequest;
use App\Request\Request;

class PriceRequestConverter implements RequestConverterInterface
{
    public function convertFromArray(array $data): Request
    {
        $request = new PriceRequest();

        return $request
            ->setProduct((int)$data['product']??null)
            ->setTaxNumber($data['taxNumber']??null)
            ->setCouponCode($data['couponCode']??null)
            ;
    }
}
