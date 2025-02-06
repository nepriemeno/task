<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\Product;
use App\Models\Tag;
use App\Repositories\ProductRepository;
use App\Repositories\TagRepository;
use Exception;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

final class ProductImportService implements ImportInterface
{
    private array $products = [];
    private array $tags = [];

    public function __construct(
        private readonly ProductRepository $productRepository,
        private readonly TagRepository $tagRepository,
    ) {
    }

    public function add(array $values): void
    {
        $sku = $values['sku'];

        $this->addProduct(
            $sku,
            $values['description'],
            $values['size'],
            $values['photo'],
            $values['updated_at'],
        );

        foreach ($values['tags'] as $tag) {
            $this->addTag($sku, $tag['title']);
        }
    }

    public function write(): void
    {
        DB::beginTransaction();

        try {
            Cache::flush();
            Tag::truncate();
            DB::statement('SET FOREIGN_KEY_CHECKS=0;');
            Product::truncate();
            DB::statement('SET FOREIGN_KEY_CHECKS=1;');
            $this->productRepository->bulkInsert($this->products);
            $this->tagRepository->bulkInsert($this->tags);
            DB::commit();
        } catch (Exception) {
            DB::rollBack();
        }
    }

    private function addProduct(
        string $sku,
        string $description,
        string $size,
        string $photo,
        string $updatedAt,
    ): void {
        $this->products[] = [
            'sku' => $sku,
            'description' => $description,
            'size' => $size,
            'photo' => $photo,
            'updated_at' => $updatedAt,
        ];
    }

    private function addTag(
        string $sku,
        string $title,
    ): void {
        $this->tags[] = [
            'sku' => $sku,
            'title' => $title,
        ];
    }
}
