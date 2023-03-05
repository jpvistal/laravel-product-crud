<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {


        \App\Models\User::factory()->create([
            'name' => 'Default Admin',
            'email' => 'admin@admin.com',
            'password' => bcrypt('password'),
            'username' => 'defaultadmin'

        ]);

        \App\Models\User::factory(3)->create();

        \App\Models\Category::factory(5)->create();

        \App\Models\Product::factory(20)->create();



    }
}
