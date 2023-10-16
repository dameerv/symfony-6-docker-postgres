<?php

namespace App\Exception;

use Throwable;

class ProductNotFoundException extends \Exception
{
    public function __construct(int $productId, string $message = "", int $code = 0, ?Throwable $previous = null)
    {
        $message = sprintf('Product with id %d is not found.', $productId);
        parent::__construct($message, $code, $previous);
    }
}
