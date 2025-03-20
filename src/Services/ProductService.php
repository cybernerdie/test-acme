<?php

namespace AcmeWidgetCo\Services;

use Money\Money;
use AcmeWidgetCo\DTOs\ProductDTO;
use AcmeWidgetCo\Core\ProductCollection;

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
            new ProductDTO('R01', 'Red Widget', Money::USD(3295)), // $32.95
            new ProductDTO('G01', 'Green Widget', Money::USD(2495)), // $24.95
            new ProductDTO('B01', 'Blue Widget', Money::USD(795)),  // $7.95
        ]);
    }

    /**
     * Find a product by code.
     *
     * @param string $productCode
     * @return Product|null
     */
    public function findByCode(string $productCode): ?ProductDTO
    {
        return $this->getProducts()
            ->filter(fn (ProductDTO $product) => $product->getCode() === $productCode)
            ->first();
    }
}
