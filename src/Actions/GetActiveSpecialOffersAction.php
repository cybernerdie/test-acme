<?php

namespace AcmeWidgetCo\Actions;

use AcmeWidgetCo\Enums\OfferTypeEnum;
use AcmeWidgetCo\DTOs\SpecialOfferDTO;

class GetActiveSpecialOffersAction
{
    /**
     * Returns all active special offers
     * 
     * @return SpecialOfferDTO[]
     */
    public function execute(): array
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
