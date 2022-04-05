<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GoodVariety extends Model
{
    use HasFactory;

    protected $fillable = [
        'good_id',
        'variety_name',
        'is_available',
    ];

}
