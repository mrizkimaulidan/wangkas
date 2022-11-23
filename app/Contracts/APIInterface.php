<?php

namespace App\Contracts;

use Illuminate\Http\JsonResponse;

/**
 * Interface untuk fitur REST API.
 */
interface APIInterface
{
    public function show(int $id): JsonResponse;
    public function edit(int $id): JsonResponse;
}
