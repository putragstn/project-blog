<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Category;
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
                'name'              => 'Superadmin',
                'email'             => 'superadmin@gmail.com',
                'email_verified_at' => now(),
                'password'          => static::$password ??= Hash::make('password'),
                'role'              => 'superadmin',
                'remember_token'    => Str::random(10),
                'status'            => 'verified',
                'updated_at'        => now(),
                'created_at'        => now()
            ],
            
            //admin
            [
                'name'              => 'Admin',
                'email'             => 'admin@gmail.com',
                'email_verified_at' => now(),
                'password'          => static::$password ??= Hash::make('password'),
                'role'              => 'admin',
                'remember_token'    => Str::random(10),
                'status'            => 'verified',
                'updated_at'        => now(),
                'created_at'        => now()
            ],

            //user
            [
                'name'              => 'User',
                'email'             => 'user@gmail.com',
                'email_verified_at' => now(),
                'password'          => static::$password ??= Hash::make('password'),
                'role'              => 'user',
                'remember_token'    => Str::random(10),
                'status'            => 'verified',
                'updated_at'        => now(),
                'created_at'        => now()
            ],

            // test - not verified
            [
                'name'              => 'Test',
                'email'             => 'test@gmail.com',
                'email_verified_at' => now(),
                'password'          => static::$password ??= Hash::make('password'),
                'role'              => 'user',
                'remember_token'    => Str::random(10),
                'status'            => 'not_verified',
                'updated_at'        => now(),
                'created_at'        => now()
            ],

            // user block
            [
                'name'              => 'Block',
                'email'             => 'block@gmail.com',
                'email_verified_at' => now(),
                'password'          => static::$password ??= Hash::make('password'),
                'role'              => 'user',
                'remember_token'    => Str::random(10),
                'status'            => 'block',
                'updated_at'        => now(),
                'created_at'        => now()
            ]
        ]);



        DB::table('categories')->insert([

            [ 
                'categories_name' => 'Teknologi',
                'updated_at'        => now(),
                'created_at'        => now() 
            ],
            [ 
                'categories_name' => 'Military',
                'updated_at'        => now(),
                'created_at'        => now() 
            ],
            [ 
                'categories_name' => 'Psikologi',
                'updated_at'        => now(),
                'created_at'        => now() 
            ],
            [ 
                'categories_name' => 'Ekonomi',
                'updated_at'        => now(),
                'created_at'        => now() 
            ],
            [ 
                'categories_name' => 'Politik',
                'updated_at'        => now(),
                'created_at'        => now() 
            ],
            [ 
                'categories_name' => 'Sejarah',
                'updated_at'        => now(),
                'created_at'        => now() 
            ],
            [ 
                'categories_name' => 'Cyber Security',
                'updated_at'        => now(),
                'created_at'        => now() 
            ]
        ]);
    }
}
