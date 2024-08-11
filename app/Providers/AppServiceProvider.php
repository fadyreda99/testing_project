<?php

namespace App\Providers;

use App\Models\Admin;
use App\Observers\AdminObserver;
use Illuminate\Support\Collection;
use Illuminate\Support\ServiceProvider;

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
    }
}
