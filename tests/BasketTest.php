<?php

namespace AcmeWidgetCo\Tests;

use Money\Money;
use AcmeWidgetCo\Basket;
use PHPUnit\Framework\TestCase;
use AcmeWidgetCo\Exceptions\ProductNotFoundException;

class BasketTest extends TestCase
{
    private Basket $basket;

    public function setUp(): void
    {
        $this->basket = resolve(Basket::class);
    }

    public function testAddingTwoProductsCalculatesCorrectTotal(): void
    {
        $this->basket->add('B01');
        $this->basket->add('G01');
        $this->assertEquals(Money::USD(3785), $this->basket->total());
    }

    public function testAddingTwoSameProductsCalculatesCorrectTotal(): void
    {
        $this->basket->add('R01');
        $this->basket->add('R01');
        $this->assertEquals(Money::USD(5437), $this->basket->total());
    }

    public function testAddingMultipleProductsCalculatesCorrectTotal(): void
    {
        $this->basket->add('R01');
        $this->basket->add('G01');
        $this->assertEquals(Money::USD(6085), $this->basket->total());
    }

    public function testAddingSeveralProductsCalculatesCorrectTotal(): void
    {
        $this->basket->add('B01');
        $this->basket->add('B01');
        $this->basket->add('R01');
        $this->basket->add('R01');
        $this->basket->add('R01');
        $this->assertEquals(Money::USD(9827), $this->basket->total());
    }

    public function testAddingNonExistentProductThrowsException(): void
    {
        $this->expectException(ProductNotFoundException::class);
        $this->basket->add('X99');
    }

    public function testEmptyBasketReturnsZeroTotal(): void
    {
        $this->assertEquals(Money::USD(0), $this->basket->total());
    }
}
