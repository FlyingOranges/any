<?php

namespace App\Providers;

use App\Services\Admin\Impl\OrderServiceImpl;
use App\Services\Admin\OrderService;
use Illuminate\Http\Request;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
        /**
         * 视图composer共享数据
         */
        view()->composer(
            'layouts.partials.' . getTheme() . '-sidebar', 'App\Http\ViewComposers\MenuComposer'
        );
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(OrderService::class, OrderServiceImpl::class);
    }
}
