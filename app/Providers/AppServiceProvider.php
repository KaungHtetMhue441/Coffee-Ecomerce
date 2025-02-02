<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;
use Laravel\Cashier\Cashier;
use App\Repositories\ProductRepository;
use App\Repositories\ProductRepositoryImpl;
use App\Repositories\OrderStatusRepository;
use App\Repositories\OrderStatusRepositoryImpl;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(ProductRepository::class, ProductRepositoryImpl::class);
        $this->app->bind(OrderStatusRepository::class, OrderStatusRepositoryImpl::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useBootstrapFive();
        Cashier::useCustomerModel(User::class);
        Cashier::calculateTaxes();
    }
}
