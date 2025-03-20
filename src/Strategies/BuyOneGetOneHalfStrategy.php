<?php

namespace AcmeWidgetCo\Strategies;

use AcmeWidgetCo\Contracts\DiscountStrategyInterface;
use AcmeWidgetCo\DTOs\SpecialOfferDTO;
use AcmeWidgetCo\Core\ProductCollection;
use Money\Money;

class BuyOneGetOneHalfStrategy implements DiscountStrategyInterface
{
    public function apply(ProductCollection $products, SpecialOfferDTO $offer): Money
    {
        $items = $offer->targetProductCodes
            ? array_filter(
                $products->getItems(),
                fn ($product) => in_array($product->getCode(), $offer->targetProductCodes)
            )
            : $products->getItems();

        $count = count($items);

        if ($count < $offer->quantityRequirement) {
            return Money::USD(0);
        }

        usort($items, fn ($a, $b) => $a->getPrice()->compare($b->getPrice()));

        return $items[0]->getPrice()->multiply('0.5');
    }
}
