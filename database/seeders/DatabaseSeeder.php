<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{

    protected static ?string $password;
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        DB::table('users')->insert([
            
            // superadmin
            [
                'name' =>  'Superadmin',
                'email' => 'superadmin@gmail.com',
                'email_verified_at' => now(),
                'password' => static::$password ??= Hash::make('password'),
                'role' => 'superadmin',
                'remember_token' => Str::random(10),
                'updated_at' => now(),
                'created_at' => now()
            ],
            
            //admin
            [
                'name' =>  'Admin',
                'email' => 'admin@gmail.com',
                'email_verified_at' => now(),
                'password' => static::$password ??= Hash::make('password'),
                'role' => 'admin',
                'remember_token' => Str::random(10),
                'updated_at' => now(),
                'created_at' => now()
            ],

            //user
            [
                'name' =>  'User',
                'email' => 'user@gmail.com',
                'email_verified_at' => now(),
                'password' => static::$password ??= Hash::make('password'),
                'role' => 'user',
                'remember_token' => Str::random(10),
                'updated_at' => now(),
                'created_at' => now()
            ]
        ]);
    }
}
