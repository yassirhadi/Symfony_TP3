<?php

namespace App\Tests\App\Cart\Promotion;

use App\Cart\Promotion\Promotion;
use App\DTO\Cart;
use App\DTO\PercentagePromotion;
use App\DTO\RegularPromotion;
use PHPUnit\Framework\TestCase;

class PromotionTest extends TestCase
{
    public function testComputeRegularPromotion(): void
    {
        $promotionManager = new Promotion();

        $regularPromotion = new RegularPromotion(200.00);
        $cart = new Cart(1500.00);

        $cart = $promotionManager->apply(promotion: $regularPromotion, cart: $cart);

        $this->assertEquals(1300.00, $cart->getTotalNetPrice());
    }

    public function testComputePercentagePromotion(): void
    {
        $promotionManager = new Promotion();

        $regularPromotion = new PercentagePromotion(20.00);
        $cart = new Cart(1500.00);

        $cart = $promotionManager->apply(promotion: $regularPromotion, cart: $cart);

        $this->assertEquals(1200.00, $cart->getTotalNetPrice());
    }
}
