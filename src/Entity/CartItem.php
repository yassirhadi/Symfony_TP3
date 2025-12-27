<?php
namespace App\Entity;

use Symfony\Component\Validator\Constraints as Assert;

class CartItem
{
    #[Assert\Positive(message: 'La quantité doit être positive')]
    #[Assert\LessThanOrEqual(value: 10, message: 'La quantité ne peut pas dépasser 10')]
    #[Assert\NotBlank(message: 'La quantité est requise')]
    private ?int $quantity = 1;

    #[Assert\Choice(
        choices: ['black', 'white', 'silver'],
        message: 'Couleur invalide'
    )]
    #[Assert\NotBlank(message: 'La couleur est requise')]
    private ?string $color = 'black';

    private ?float $unitPrice = 129.99;

    // Getters et Setters
    public function getQuantity(): ?int
    {
        return $this->quantity;
    }

    public function setQuantity(int $quantity): static
    {
        $this->quantity = $quantity;
        return $this;
    }

    public function getColor(): ?string
    {
        return $this->color;
    }

    public function setColor(string $color): static
    {
        $this->color = $color;
        return $this;
    }

    public function getUnitPrice(): ?float
    {
        return $this->unitPrice;
    }

    public function getTotalPrice(): float
    {
        return $this->quantity * $this->unitPrice;
    }

    public function toArray(): array
    {
        return [
            'quantity' => $this->quantity,
            'color' => $this->color,
            'unitPrice' => $this->unitPrice,
            'totalPrice' => $this->getTotalPrice(),
        ];
    }
}
