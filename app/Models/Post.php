<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $table = 'posts';
    protected $primaryKey = 'id';
    protected $fillable = [
        'title',
        'slug',
        'content',
        'userid',
        'status'
    ];
    public function user()
    {
        return $this->belongsTo(User::class, 'userid', 'userid');
    }
}



