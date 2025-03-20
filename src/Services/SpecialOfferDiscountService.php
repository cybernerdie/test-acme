<?php

namespace AcmeWidgetCo\Services;

use AcmeWidgetCo\DTOs\SpecialOfferDTO;
use AcmeWidgetCo\Enums\OfferTypeEnum;
use AcmeWidgetCo\ProductCollection;
use Money\Money;

class SpecialOfferDiscountService
{
    /**
     * Apply special offers to the basket
     * 
     * @param ProductCollection $products
     * @param SpecialOfferDTO[] $specialOffers
     * @return Money
     */
    public function apply(ProductCollection $products, array $specialOffers): Money
    {
        $discount = Money::USD(0);

        foreach ($specialOffers as $offer) {
            if (!$offer->getIsActive()) {
                continue;
            }

            /** @var Money $result */
            $result = match ($offer->type) {
                OfferTypeEnum::BUY_ONE_GET_ONE_HALF => $this->applyBuyOneGetOneHalf($products, $offer),
            };

            if (!$result->isZero()) {
                $discount = $discount->add($result);
            }
        }

        return $discount;
    }

    /**
     * Apply Buy One Get One Half discount
     *
     * @param ProductCollection $products
     * @param SpecialOfferDTO $offer
     * @return Money
     */
    private function applyBuyOneGetOneHalf(ProductCollection $products, SpecialOfferDTO $offer): Money
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
