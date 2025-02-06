<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Repositories\ProductRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

final readonly class ProductApiController
{
    public function __construct(private ProductRepository $productRepository)
    {
    }

    public function getAll(Request $request): JsonResponse
    {
        $description = $request->input('description');

        return response()->json(
            $this->getFromCache('getAll', $description, function ($description) {
                if ($description !== null) {
                    return $this->productRepository->getByDescription($description);
                }

                return $this->productRepository->getAll();
            }),
        );
    }

    public function get(int $id): JsonResponse
    {
        return response()->json(
            $this->getFromCache('get', $id, function ($id) {
                return $this->productRepository->get($id);
            }),
        );
    }

    private function getFromCache(string $prefix, mixed $key, $getResponseFunction): mixed
    {
        return Cache::remember("$prefix.$key", 6000, function () use ($key, $getResponseFunction) {
            return $getResponseFunction($key);
        });
    }
}
