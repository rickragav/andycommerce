<?php

namespace AndyCommerce\Core\Providers;

use AndyCommerce\Core\Services\BrandCoreService;
use AndyCommerce\Core\CategoryCoreService;
use AndyCommerce\Core\Services\ProductCoreService;
use Illuminate\Support\ServiceProvider;

class CoreServiceProvider extends ServiceProvider
{
    public function boot()
    {
        // Include the helper file
        if (file_exists($file = __DIR__ . '/../Helper/helpers.php')) {
            require $file;
        }

         // Load migrations if any
         $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
    }

    public function register()
    {
        // $this->app->bind('andycommerce-core', function () {

        //     return new CategoryCoreService;

        // });

        // $this->app->bind('brand-core', function () {
        //     return new BrandCoreService;
        // });

        // $this->app->bind('product-core', function () {
        //     return new ProductCoreService;
        // });
    }
}
