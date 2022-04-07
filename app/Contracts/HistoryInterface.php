<?php

namespace App\Contracts;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

/**
 * An interface for history feature.
 * For supporting soft deletes feature when some Controller implement it.
 */
interface HistoryInterface
{
    public function index(): View|JsonResponse;
    public function restore(int $id): RedirectResponse;
    public function destroy(int $id): RedirectResponse;
}
