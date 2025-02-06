<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\Product;
use App\Models\Tag;

final class TagRepository
{
    public function bulkInsert(array $tags): void
    {
        $products = Product::select([Product::FIELD_ID, Product::FIELD_SKU])
            ->whereIn(Product::FIELD_SKU, array_column($tags, 'sku'))
            ->get()
            ->keyBy(Product::FIELD_SKU);

        foreach ($tags as $key => &$tag) {
            $sku = $tag['sku'];

            if (isset($products[$sku])) {
                $tag['product_id'] = $products[$tag['sku']]->id;
                unset($tag['sku']);
                continue;
            }

            unset($tags[$key]);
        }

        Tag::insert($tags);
    }
}
