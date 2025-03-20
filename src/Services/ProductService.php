<?php

namespace AcmeWidgetCo\Services;

use Money\Money;
use AcmeWidgetCo\Models\Product;
use AcmeWidgetCo\ProductCollection;

class ProductService
{
    /**
     * Get the list of available products.
     *
     * @return ProductCollection
     */
    public function getProducts(): ProductCollection
    {
        return new ProductCollection([
            new Product('R01', 'Red Widget', Money::USD(3295)), // $32.95
            new Product('G01', 'Green Widget', Money::USD(2495)), // $24.95
            new Product('B01', 'Blue Widget', Money::USD(795)),  // $7.95
        ]);
    }

    /**
     * Find a product by code.
     *
     * @param string $productCode
     * @return Product|null
     */
    public function findByCode(string $productCode): ?Product
    {
        return $this->getProducts()
            ->filter(fn (Product $product) => $product->getCode() === $productCode)
            ->first();
    }
}
