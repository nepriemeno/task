<?php

declare(strict_types=1);

namespace App\Console\Commands;

use App\Services\ProductImportService;

final class ImportProductCommand extends ImportCommand
{
    protected $signature = 'app:import-product';
    protected $description = 'Import products with tags from a JSON file';

    public function __construct(private readonly ProductImportService $productImportService)
    {
        parent::__construct($this->productImportService, 'app/public/products.json');
    }
}
