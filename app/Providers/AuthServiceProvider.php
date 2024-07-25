<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use App\Models\Admin;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Illuminate\Auth\Access\Response;


class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        //
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
//        Gate::define('add_user', function(Admin $admin){
//            return $admin->hasAnyPermission('add_user')
//                ? Response::allow()
//                : Response::deny('You must be an creator to add users.');
//        });
//
//        Gate::define('edit_user', function(Admin $admin){
//            return $admin->hasAnyPermission('edit_user')
//                ? Response::allow()
//                : Response::deny('You must be an creator to edit users.');
//        });
//
//        Gate::define('delete_user', function(Admin $admin){
//            return $admin->hasAnyPermission('delete_user')
//                ? Response::allow()
//                : Response::deny('You must be an creator to delete users.');
//        });
    }
}
