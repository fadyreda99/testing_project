<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CK extends Model
{
    use HasFactory;

    protected $table = 'test_ck';

    protected $fillable = [
        'desc',
    ];
}
