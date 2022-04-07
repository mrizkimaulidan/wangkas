<?php

namespace App\Contracts;

use Illuminate\Http\JsonResponse;

interface ApiInterface
{
    public function show(int $id): JsonResponse;
    public function edit(int $id): JsonResponse;
}
