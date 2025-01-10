<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Cashier\Cashier;

class Cart extends Model
{
    use HasFactory;
    protected $guarded = [];

    protected $with = ['courses'];

    public function courses()
    {
        return $this->belongsToMany(Course::class);
    }

    public function total()
    {
        // return $this->courses->sum('price');
        return Cashier::formatAmount($this->courses->sum('price'), env('CASHIER_CURRENCY'));
    }
}
