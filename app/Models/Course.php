<?php

namespace App\Models;

use App\Models\Scopes\StripeCoursesScope;
use App\Observers\CourseObserver;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Attributes\ScopedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;
use Laravel\Cashier\Cashier;

#[ScopedBy(StripeCoursesScope::class)]
#[ObservedBy(CourseObserver::class)]
class Course extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function carts()
    {
        return $this->belongsToMany(Cart::class);
    }

    public function price()
    {
        return Cashier::formatAmount($this->price, env('CASHIER_CURRENCY'));
    }

    public function orders()
    {
        return $this->belongsToMany(Order::class, 'course_orders', 'course_id', 'order_id');
    }

    public function scopeStripeCourses(Builder $query)
    {
        return $query->where('stripe_price_id', '!=', null);
    }

    // protected static function booted(): void
    // {
    //     static::creating(function (Course $course){
    //         Log::channel('daily')->info('Creating course: ' . $course->name);
    //     });

    //     static::created(function (Course $course){
    //         Log::channel('daily')->info('Created course: ' . $course->name);
    //     });

    // }
  
}
