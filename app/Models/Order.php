<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $table = 'orders';
    protected $guarded = [];


    public function courses()
    {
        return $this->belongsToMany(Course::class, 'course_orders', 'order_id', 'course_id');
    }

    public function admin()
    {
        return $this->belongsTo(Admin::class);
    }
}
