<?php

namespace AcmeWidgetCo\Contracts;

use AcmeWidgetCo\DTOs\SpecialOfferDTO;
use AcmeWidgetCo\Core\ProductCollection;
use Money\Money;

interface DiscountStrategyInterface
{
    public function apply(ProductCollection $products, SpecialOfferDTO $offer): Money;
}
