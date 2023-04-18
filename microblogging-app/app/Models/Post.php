<?php

namespace App\Models;

use Conner\Likeable\Likeable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory, Likeable;
    protected $fillable = [
        'description',
        'img_url',
        'user_id',
    ];
    public function user()
    {
    return $this->belongsTo(User::class);
    }
    
}
