<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    // protected $guarded = ['id_post'];
    protected $fillable = [
        'id_user',
        'id_category',
        'title',
        'image',
        'location',
        'rating',
        'description',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'id');
    }
}
