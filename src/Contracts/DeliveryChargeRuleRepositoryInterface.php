<?php

namespace AcmeWidgetCo\Contracts;

use AcmeWidgetCo\DTOs\DeliveryChargeDTO;

interface DeliveryChargeRuleRepositoryInterface
{
    /**
     * Fetch delivery charge rules.
     *
     * @return DeliveryChargeDTO[]
     */
    public function getRules(): array;
}
