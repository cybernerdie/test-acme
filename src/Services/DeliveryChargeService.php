<?php

namespace AcmeWidgetCo\Services;

use Money\Money;
use AcmeWidgetCo\Repositories\DeliveryChargeRuleRepository;

class DeliveryChargeService
{
    public function __construct(
        private DeliveryChargeRuleRepository $ruleRepository
    ) {}

    public function calculate(Money $total): Money
    {
        foreach ($this->ruleRepository->getRules() as $rule) {
            if ($total->lessThan($rule->getThreshold())) {
                return $rule->getCharge();
            }
        }
        return Money::USD(0);
    }
}