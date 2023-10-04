<?php

namespace App\Request\Converter;

use App\Request\Request;

interface RequestConverterInterface
{
    public function convertFromArray(array $data): Request;
}
