<?php

namespace AcmeWidgetCo\Repositories;

use Money\Money;
use AcmeWidgetCo\DTOs\DeliveryChargeDTO;
use AcmeWidgetCo\Contracts\DeliveryChargeRuleRepositoryInterface;

class DeliveryChargeRuleRepository implements DeliveryChargeRuleRepositoryInterface
{
    /**
     * @return DeliveryChargeRule[]
     */
    public function getRules(): array
    {
        return [
            new DeliveryChargeDTO(Money::USD(5000), Money::USD(495)),
            new DeliveryChargeDTO(Money::USD(9000), Money::USD(295)),
        ];
    }
}
