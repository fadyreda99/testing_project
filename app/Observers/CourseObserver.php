<?php

namespace App\Observers;

use App\Models\Course;
use Illuminate\Support\Facades\Log;

class CourseObserver
{
    /**
     * Handle the Course "created" event.
     */
    public function created(Course $course): void
    {
        Log::channel('daily')->info('Created course from observer: ' . $course->name);
    }

    /**
     * Handle the Course "creating" event.
     */
    public function creating(Course $course): void
    {
        Log::channel('daily')->info('Creating course from observer: ' . $course->name);
    }

    /**
     * Handle the Course "updated" event.
     */
    public function updated(Course $course): void
    {
        //
    }

    /**
     * Handle the Course "deleted" event.
     */
    public function deleted(Course $course): void
    {
        //
    }

    /**
     * Handle the Course "restored" event.
     */
    public function restored(Course $course): void
    {
        //
    }

    /**
     * Handle the Course "force deleted" event.
     */
    public function forceDeleted(Course $course): void
    {
        //
    }
}
