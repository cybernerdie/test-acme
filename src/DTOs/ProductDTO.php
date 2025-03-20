<?php

namespace AcmeWidgetCo\DTOs;

use Money\Money;

class ProductDTO
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

    /**
     * @return array{code: string, name: string, price: numeric-string}
     */
    public function toArray(): array
    {
        return [
            'code' => $this->getCode(),
            'name' => $this->getName(),
            'price' => $this->getPrice()->getAmount(),
        ];
    }
}
