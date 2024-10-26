<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Mpdf\Mpdf;

class PdfServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('pdf', function ($app) {
            return new Mpdf();
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
