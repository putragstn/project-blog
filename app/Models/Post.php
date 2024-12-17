<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    // Jika nama tabel bukan 'categories', tentukan nama tabel secara eksplisit
    // protected $table = 'my_categories'; 

    // Tentukan kolom-kolom yang bisa diisi
    protected $fillable = [
        'user_id',
        'category_id',
        'title',
        'subheading',
        'content',
        'image',
        'slug',
        'published_at'
    ];
}
