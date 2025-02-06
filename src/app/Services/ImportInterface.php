<?php

declare(strict_types=1);

namespace App\Services;

interface ImportInterface
{
    public function add(array $values): void;
    public function write(): void;
}
