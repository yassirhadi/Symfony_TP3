<?php
// src/Service/ProductRepositoryInterface.php
namespace App\Service;

interface ProductRepositoryInterface
{
    public function findProductById(int $id): ?array;
    public function findAllProducts(): array;
    public function getProductPrice(int $productId): float;
}
