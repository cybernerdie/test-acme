<?php

namespace AcmeWidgetCo\Models;

use Money\Money;

class Product
{
    public function __construct(
        private string $code,
        private string $name,
        private Money $price
    ) {}

    public function getCode(): string
    {
        return $this->code;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getPrice(): Money
    {
        return $this->price;
    }
}
