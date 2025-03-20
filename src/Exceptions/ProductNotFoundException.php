<?php

namespace AcmeWidgetCo\Exceptions;

class ProductNotFoundException extends \Exception
{
    public function __construct(string $productCode)
    {
        parent::__construct("Product with code {$productCode} not found");
    }
}

