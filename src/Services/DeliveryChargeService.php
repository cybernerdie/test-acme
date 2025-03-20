<?php

namespace AcmeWidgetCo\Services;

use Money\Money;
use AcmeWidgetCo\Rules\DeliveryChargeRule;

class DeliveryChargeService
{
    /** @var DeliveryChargeRule[] */
    private array $rules;

    public function __construct()
    {
        $this->rules = [
            new DeliveryChargeRule(Money::USD(5000), Money::USD(495)), // $50.00 threshold, $4.95 charge
            new DeliveryChargeRule(Money::USD(9000), Money::USD(295)), // $90.00 threshold, $2.95 charge
        ];
    }

    public function calculate(Money $total): Money
    {
        foreach ($this->rules as $rule) {
            if ($total->lessThan($rule->getThreshold())) {
                return $rule->getCharge();
            }
        }
        return Money::USD(0);
    }
}