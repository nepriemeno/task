<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Http\Response;

final class ProductController
{
    public function getAll(): Response
    {
        return response()->view('products');
    }
}
