<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UserManagement extends Model
{
    use HasFactory;

    // Jika nama tabel bukan 'categories', tentukan nama tabel secara eksplisit
    // protected $table = 'my_categories'; 

    // Tentukan kolom-kolom yang bisa diisi
    protected $fillable = [
        'name',
        'email',
        'role',
        'image',
        'password'
    ];
}
