<?php

namespace AcmeWidgetCo\Contracts;

use AcmeWidgetCo\DTOs\SpecialOfferDTO;

interface SpecialOfferRepositoryInterface
{
    /**
     * Get all active special offers.
     *
     * @return SpecialOfferDTO[]
     */
    public function getActiveOffers(): array;
}
