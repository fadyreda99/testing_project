<?php

namespace App\Providers;

use App\Models\Admin;
use App\Models\Cart;
use App\Observers\AdminObserver;
use Illuminate\Support\Collection;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades;
use Illuminate\View\View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Admin::observe(AdminObserver::class);
        $collection = Collection::macro('toUpperCasing', function () {
            return $this->map(function ($item) {
                return strtoupper($item);
            });
        });

        Facades\View::composer('*', function (View $view) {
            $cart = Cart::where('session_id', session()->getId())->first();
            $view->with('cart', $cart);
        });
    }
}
