<?php

namespace AcmeWidgetCo\Services;

use AcmeWidgetCo\DTOs\SpecialOfferDTO;
use AcmeWidgetCo\Core\ProductCollection;
use AcmeWidgetCo\Factories\DiscountStrategyFactory;
use Money\Money;

class SpecialOfferDiscountService
{
    public function __construct(
        private DiscountStrategyFactory $strategyFactory
    ) {}

    /**
     * Apply special offers
     * 
     * @param ProductCollection $products
     * @param SpecialOfferDTO[] $specialOffers
     */
    public function apply(ProductCollection $products, array $specialOffers): Money
    {
        $discount = Money::USD(0);

        foreach ($specialOffers as $offer) {
            if (!$offer->getIsActive()) {
                continue;
            }

            $strategy = $this->strategyFactory->make($offer);
            $result = $strategy->apply($products, $offer);

            if (!$result->isZero()) {
                $discount = $discount->add($result);
            }
        }

        return $discount;
    }
}
