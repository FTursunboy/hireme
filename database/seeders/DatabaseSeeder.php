<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

         Role::query()->insert([
             ['name' => 'admin', 'guard_name' => 'web'],
             ['name' => 'moderator', 'guard_name' => 'web'],
             ['name' => 'performer', 'guard_name' => 'web'],
             ['name' => 'customer', 'guard_name' => 'web']
         ]);


        \App\Models\User::create([
            'name' => 'Test User',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('password'),
        ])->assignRole('admin');
        \App\Models\User::create([
            'name' => 'Test moderator',
            'email' => 'moderator@gmail.com',
            'password' => Hash::make('password'),
        ])->assignRole('admin');

        Artisan::call('db:seed CategorySeeder');
    }
}
