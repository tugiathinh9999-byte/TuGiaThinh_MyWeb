<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    protected $table = 'brands';
    protected $primaryKey = 'brandid';
    protected $fillable = [
        'brandname',
        'slug',
        'description',
        'image',
        'status'
    ];
}


