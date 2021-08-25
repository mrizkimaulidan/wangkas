<?php

namespace App\Providers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        // 
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Response::macro('success', function ($data, $status_code) {
            return response()->json([
                'status' => $status_code,
                'message' => 'Data berhasil diambil!',
                'data' => $data
            ], $status_code);
        });

        Redirector::macro('success', function (string $route, string $message) {
            return redirect()->route($route)->with('success', $message);
        });

        Redirector::macro('warning', function (string $route, string $message) {
            return redirect()->route($route)->with('warning', $message);
        });

        Redirector::macro('error', function (string $route, string $message) {
            return redirect()->route($route)->with('error', $message);
        });
    }
}
