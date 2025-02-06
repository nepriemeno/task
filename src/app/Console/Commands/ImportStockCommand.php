<?php

declare(strict_types=1);

namespace App\Console\Commands;

use App\Services\StockImportService;

final class ImportStockCommand extends ImportCommand
{
    protected $signature = 'app:import-stock';
    protected $description = 'Import stocks from a JSON file';

    public function __construct(private readonly StockImportService $stockImportService)
    {
        parent::__construct($this->stockImportService, 'app/public/stocks.json');
    }
}
