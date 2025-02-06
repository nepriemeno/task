<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Collection;

final class ProductRepository
{
    public function bulkInsert(array $products): void
    {
        Product::insert($products);
    }

    public function getAll(): Collection
    {
        return Product::with([Product::FIELD_TAGS, Product::FIELD_STOCKS])->get();
    }

    public function get(int $id): ?Product
    {
        return Product::with([Product::FIELD_TAGS, Product::FIELD_STOCKS])->find($id);
    }

    public function getByDescription(string $description): Collection
    {
        return Product::with([Product::FIELD_TAGS, Product::FIELD_STOCKS])
            ->whereLike(Product::FIELD_DESCRIPTION, '%' . $description . '%')
            ->get();
    }
}
