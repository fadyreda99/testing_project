<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourseOrder extends Model
{
    use HasFactory;
    protected $table = 'course_orders';

    protected $guarded = [];
}
