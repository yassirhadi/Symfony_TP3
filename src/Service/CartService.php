<?php
// src/Service/CartService.php
namespace App\Service;

use App\Entity\CartItem;
use Symfony\Component\HttpFoundation\RequestStack;

class CartService
{
    private RequestStack $requestStack;
    private const CART_SESSION_KEY = 'shopping_cart';

    public function __construct(RequestStack $requestStack)
    {
        $this->requestStack = $requestStack;
    }

    public function addItem(CartItem $item): void
    {
        $session = $this->requestStack->getSession();
        $cart = $session->get(self::CART_SESSION_KEY, []);

        $cart[] = $item->toArray();
        $session->set(self::CART_SESSION_KEY, $cart);
    }

    public function getCart(): array
    {
        $session = $this->requestStack->getSession();
        return $session->get(self::CART_SESSION_KEY, []);
    }

    public function clearCart(): void
    {
        $this->requestStack->getSession()->remove(self::CART_SESSION_KEY);
    }

    public function getCartTotal(): float
    {
        $cart = $this->getCart();
        $total = 0;

        foreach ($cart as $item) {
            $total += $item['totalPrice'] ?? 0;
        }

        return $total;
    }
}
