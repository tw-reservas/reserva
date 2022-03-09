<?php

namespace App\Providers;

use App\Adapters\RestCpsAdapter;
use App\Services\CpsServices;
use Illuminate\Support\ServiceProvider;
use Illuminate\Routing\UrlGenerator;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public $bindings  = [
        CpsServices::class => RestCpsAdapter::class,
    ];

    public function register()
    {
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(UrlGenerator $url)
    {
    }
}
