<?php

namespace App\Observers;

use App\Models\Admin;
use App\Notifications\CreatedNewAdmin;

class AdminObserver
{
    /**
     * Handle the Admin "created" event.
     */
    public function created(Admin $admin): void
    {
        $superAdmin = Admin::where('email', 'admin_super@admin.com')->first();
        $superAdmin->notify(new CreatedNewAdmin($admin->getRoleNames()[0] ?? ''));
//        $admin->name = $admin->name . ' observerHandling';
//        $admin->save();
    }

    /**
     * Handle the Admin "updated" event.
     */
    public function updated(Admin $admin): void
    {
        //
    }

    /**
     * Handle the Admin "deleted" event.
     */
    public function deleted(Admin $admin): void
    {
        //
    }

    /**
     * Handle the Admin "restored" event.
     */
    public function restored(Admin $admin): void
    {
        //
    }

    /**
     * Handle the Admin "force deleted" event.
     */
    public function forceDeleted(Admin $admin): void
    {
        //
    }
}
