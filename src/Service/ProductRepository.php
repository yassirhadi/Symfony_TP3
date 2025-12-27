<?php
// src/Service/ProductRepository.php
namespace App\Service;

class ProductRepository implements ProductRepositoryInterface
{
    private array $products = [
        1 => [
            'id' => 1,
            'name' => 'Premium Wireless Headphones',
            'price' => 129.99,
            'description' => 'Experience superior sound quality with our premium wireless headphones.',
            'features' => [
                'Brand: AudioTech',
                'Color: Matte Black',
                'Connectivity: Bluetooth 5.0',
                'Battery Life: 30 hours',
            ]
        ]
    ];

    public function findProductById(int $id): ?array
    {
        return $this->products[$id] ?? null;
    }

    public function findAllProducts(): array
    {
        return $this->products;
    }

    public function getProductPrice(int $productId): float
    {
        $product = $this->findProductById($productId);
        return $product['price'] ?? 0.0;
    }
}
