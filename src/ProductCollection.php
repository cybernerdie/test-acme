<?php

namespace AcmeWidgetCo;

use AcmeWidgetCo\Models\Product;

class ProductCollection
{
    /** @var Product[] */
    private array $items = [];

    /**
     * @param Product[] $items
     */
    public function __construct(array $items = [])
    {
        $this->items = $items;
    }

    public function add(Product $product): void
    {
        $this->items[] = $product;
    }

    /**
     * @return Product[]
     */
    public function getItems(): array
    {
        return $this->items;
    }

    public function filter(callable $callback): ProductCollection
    {
        $filteredItems = array_filter($this->items, $callback);
        $collection = new self();
        foreach ($filteredItems as $item) {
            $collection->add($item);
        }
        return $collection;
    }

    public function count(): int
    {
        return count($this->items);
    }

    public function isEmpty(): bool
    {
        return empty($this->items);
    }

    public function first(): ?Product
    {
        return $this->items[0] ?? null;
    }
}
