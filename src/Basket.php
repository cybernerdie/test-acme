<?php

namespace AcmeWidgetCo;

use Money\Money;
use AcmeWidgetCo\Core\ProductCollection;
use AcmeWidgetCo\Services\ProductService;
use AcmeWidgetCo\Services\DeliveryChargeService;
use AcmeWidgetCo\Exceptions\ProductNotFoundException;
use AcmeWidgetCo\Repositories\SpecialOfferRepository;
use AcmeWidgetCo\Services\SpecialOfferDiscountService;

class Basket
{
    public function __construct(
        private ProductCollection $products,

        private DeliveryChargeService $deliveryChargeService,

        private SpecialOfferDiscountService $specialOfferDiscountService,

        private ProductService $productService,

        private SpecialOfferRepository $specialOfferRepository
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
        if ($this->products->isEmpty()) {
            return Money::USD(0);
        }
    
        return array_reduce(
            $this->products->getItems(),
            fn (Money $subtotal, $product) => $subtotal->add($product->getPrice()),
            Money::USD(0)
        );
    }
    

    private function calculateDiscount(): Money
    {
        $specialOffers = $this->specialOfferRepository->getActiveOffers();

        if (empty($specialOffers)) {
            return Money::USD(0);
        }

        return $this->specialOfferDiscountService->apply(products: $this->products, specialOffers: $specialOffers);
    }
}
