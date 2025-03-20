<?php

namespace AcmeWidgetCo;

use AcmeWidgetCo\Actions\GetActiveSpecialOffersAction;
use AcmeWidgetCo\Exceptions\ProductNotFoundException;
use AcmeWidgetCo\Services\DeliveryChargeService;
use AcmeWidgetCo\Services\ProductService;
use AcmeWidgetCo\Services\SpecialOfferDiscountService;
use Money\Money;

class Basket
{
    public function __construct(
        private ProductCollection $products,
        private DeliveryChargeService $deliveryChargeService,

        private GetActiveSpecialOffersAction $getActiveSpecialOffersAction,

        private SpecialOfferDiscountService $specialOfferDiscountService,

        private ProductService $productService,
    ) {}

    public function add(string $productCode): void
    {
        $product = $this->productService->findByCode($productCode);

        if (! $product) {
            throw new ProductNotFoundException($productCode);
        }

        $this->products->add($product);
    }

    public function total(): Money
    {
        if ($this->products->isEmpty()) {
            return Money::USD(0);
        }

        $subtotal       = $this->calculateSubtotal();
        $discount       = $this->calculateDiscount();
        $total          = $subtotal->subtract($discount);
        $deliveryCharge = $this->deliveryChargeService->calculate($total);

        return $total->add($deliveryCharge);
    }

    private function calculateSubtotal(): Money
    {
        $subtotal = Money::USD(0);

        foreach ($this->products->getItems() as $product) {
            $subtotal = $subtotal->add($product->getPrice());
        }

        return $subtotal;
    }

    private function calculateDiscount(): Money
    {
        $specialOffers = $this->getActiveSpecialOffersAction->execute();

        if (empty($specialOffers)) {
            return Money::USD(0);
        }

        return $this->specialOfferDiscountService->apply(products: $this->products, specialOffers: $specialOffers);
    }
}
