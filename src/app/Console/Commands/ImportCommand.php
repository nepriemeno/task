<?php

declare(strict_types=1);

namespace App\Console\Commands;

use App\Services\ImportInterface;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

abstract class ImportCommand extends Command
{
    public function __construct(
        private readonly ImportInterface $importService,
        private readonly string $path,
    ) {
        parent::__construct();
    }

    public function handle(): void
    {
        foreach (json_decode(File::get(storage_path($this->path)), true) as $datum)
        {
            $this->importService->add($datum);
        }

        $this->importService->write();
    }
}
