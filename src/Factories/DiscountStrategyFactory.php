<?php

namespace AcmeWidgetCo\Factories;

use AcmeWidgetCo\Contracts\DiscountStrategyInterface;
use AcmeWidgetCo\DTOs\SpecialOfferDTO;
use AcmeWidgetCo\Enums\OfferTypeEnum;
use AcmeWidgetCo\Strategies\BuyOneGetOneHalfStrategy;

class DiscountStrategyFactory
{

    public function make(SpecialOfferDTO $offer): DiscountStrategyInterface
    {
        return match ($offer->type) {
            OfferTypeEnum::BUY_ONE_GET_ONE_HALF => resolve(BuyOneGetOneHalfStrategy::class),
        };
    }
}
