<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Response;

class ResponseServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * To standardize the api response in format mention in readme.md
     *
     * @return void
     */
    public function boot()
    {
        Response::macro('api', function ($status, $message, $data) {
            return response()->json([
                'status' => $status,
                'message' => $message,
                'data' => $data,
            ]);
        });
    }
}
