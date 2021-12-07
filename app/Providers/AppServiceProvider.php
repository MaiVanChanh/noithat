<?php

namespace App\Providers;

use App\Models\Admin;
use App\Models\Category;
use App\Models\Coupon;
use App\Models\Customer;
use App\Models\Introduce;
use App\Models\Material;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Pagination\Paginator ;
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
        Paginator::useBootstrap();
        
    }
}
