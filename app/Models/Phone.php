<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Phone extends Model
{
    use HasFactory;

    protected $fillable = ['phone', 'user_id'];

    public function user()
    {
        return $this->belongsTo(User::class)->withDefault(['name' => 'unknown']);
    }

    public function serial(){
        return $this->hasOne(Serial::class);
    }
}
