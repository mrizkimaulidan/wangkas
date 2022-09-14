<?php

namespace App\Contracts;

use Illuminate\Http\JsonResponse;

/**
 * An interface for REST API feature.
 */
interface ApiInterface
{
    public function show(int $id): JsonResponse;
    public function edit(int $id): JsonResponse;
}
