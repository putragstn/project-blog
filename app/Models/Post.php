<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    // Jika nama tabel bukan 'categories', tentukan nama tabel secara eksplisit
    // protected $table = 'my_categories'; 

    // Tentukan kolom-kolom yang bisa diisi
    // protected $fillable = [
    //     'user_id',
    //     'category_id',
    //     'title',
    //     'subheading',
    //     'content',
    //     'image',
    //     'slug',
    //     'published_at'
    // ];

    protected $guarded = ['id'];

    // Relasi dengan User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi dengan Category
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
