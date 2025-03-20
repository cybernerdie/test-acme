<?php

namespace AcmeWidgetCo\DTOs;

use Money\Money;

class DeliveryChargeDTO
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