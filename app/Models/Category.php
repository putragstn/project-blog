<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    // Jika nama tabel bukan 'categories', tentukan nama tabel secara eksplisit
    // protected $table = 'my_categories'; 

    // Tentukan kolom-kolom yang bisa diisi
    protected $fillable = [
        'categories_name',
    ];

    // Tentukan kolom yang tidak bisa diisi jika diperlukan
    // protected $guarded = ['id']; // Jika hanya kolom id yang tidak bisa diisi
}
