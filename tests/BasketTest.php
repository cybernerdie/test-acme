<?php

namespace AcmeWidgetCo\Tests;

use Money\Money;
use AcmeWidgetCo\Basket;
use PHPUnit\Framework\TestCase;
use AcmeWidgetCo\Exceptions\ProductNotFoundException;

class BasketTest extends TestCase
{
    public function testBasketTotals(): void
    {
        $basket = new Basket();
        $basket->add('B01');
        $basket->add('G01');
        $this->assertEquals(Money::USD(3785), $basket->total());

        $basket = new Basket();
        $basket->add('R01');
        $basket->add('R01');
        $this->assertEquals(Money::USD(5437), $basket->total());

        $basket = new Basket();
        $basket->add('R01');
        $basket->add('G01');
        $this->assertEquals(Money::USD(6085), $basket->total());

        $basket = new Basket();
        $basket->add('B01');
        $basket->add('B01');
        $basket->add('R01');
        $basket->add('R01');
        $basket->add('R01');
        $this->assertEquals(Money::USD(9827), $basket->total());
    }

    public function testAddingNonExistentProductThrowsException(): void
    {
        $this->expectException(ProductNotFoundException::class);

        $basket = new Basket();
        $basket->add('X99');
    }

    public function testEmptyBasketReturnsZeroTotal(): void
    {
        $basket = new Basket();
        $this->assertEquals(Money::USD(0), $basket->total());
    }
}
