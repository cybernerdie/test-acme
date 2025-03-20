<?php

namespace AcmeWidgetCo\Repositories;

use AcmeWidgetCo\Contracts\SpecialOfferRepositoryInterface;
use AcmeWidgetCo\DTOs\SpecialOfferDTO;
use AcmeWidgetCo\Enums\OfferTypeEnum;

class SpecialOfferRepository implements SpecialOfferRepositoryInterface
{
    /**
     * @return SpecialOfferDTO[]
     */
    public function getActiveOffers(): array
    {
        return [
            new SpecialOfferDTO(
                code: 'BOGOH_R01',
                name: 'Buy One Get One Half',
                type: OfferTypeEnum::BUY_ONE_GET_ONE_HALF,
                targetProductCodes: ['R01'],
                quantityRequirement: 2
            ),
        ];
    }
}
