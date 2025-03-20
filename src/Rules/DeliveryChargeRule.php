<?php

namespace AcmeWidgetCo\Rules;

use Money\Money;

class DeliveryChargeRule
{
    public function __construct(
        private Money $threshold,
        private Money $charge
    ) {}

    public function getThreshold(): Money
    {
        return $this->threshold;
    }

    public function getCharge(): Money
    {
        return $this->charge;
    }
}