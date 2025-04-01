<?php

namespace App\Models;

use App\Models\Scopes\StripeCoursesScope;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Attributes\ScopedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Cashier\Cashier;

#[ScopedBy(StripeCoursesScope::class)]
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
}
