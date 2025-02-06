<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\Stock;
use App\Repositories\StockRepository;
use Exception;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

final class StockImportService implements ImportInterface
{
    private array $stocks = [];

    public function __construct(private readonly StockRepository $stockRepository)
    {
    }

    public function add(array $values): void
    {
        $this->addStock(
            $values['sku'],
            $values['stock'],
            $values['city'],
        );
    }

    public function write(): void
    {
        DB::beginTransaction();

        try {
            Cache::flush();
            Stock::truncate();
            $this->stockRepository->bulkInsert($this->stocks);
            DB::commit();
        } catch (Exception) {
            DB::rollBack();
        }
    }

    private function addStock(string $sku, int $stock, string $city): void
    {
        $this->stocks[] = [
            'sku' => $sku,
            'stock' => $stock,
            'city' => $city,
        ];
    }
}
