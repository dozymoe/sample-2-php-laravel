<?php

namespace App\Providers;

use App\Contracts as C;
use App\Repositories as R;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(C\ProductRepository::class,
            R\ProductRepositoryEloquent::class);
        $this->app->bind(C\ProductCategoryRepository::class,
            R\ProductCategoryRepositoryEloquent::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
