<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\Product;
use App\Models\Stock;

final class StockRepository
{
    public function bulkInsert(array $stocks): void
    {
        $products = Product::select([Product::FIELD_ID, Product::FIELD_SKU])
            ->whereIn(Product::FIELD_SKU, array_column($stocks, 'sku'))
            ->get()
            ->keyBy(Product::FIELD_SKU);

        foreach ($stocks as $key => &$stock) {
            $sku = $stock['sku'];

            if (isset($products[$sku])) {
                $stock['product_id'] = $products[$sku]->id;
                unset($stock['sku']);
                continue;
            }

            unset($stocks[$key]);
        }

        Stock::insert($stocks);
    }
}
