<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        \App\Models\User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@gmail.com',
            'phone' => '01234',
            'isVerified' => 1,
            'password' => 'password',
        ]);

        $this->call([
            AdminsTableSeeder::class,
            DivisionSeeder::class,
            DistrictSeeder::class,
        ]);

        \App\Models\Seller::factory(50)->create();
        \App\Models\User::factory(20)->create();
        \App\Models\Brand::factory(20)->create();
        \App\Models\Category::factory(20)->create();
        \App\Models\SubCategory::factory(20)->create();
        \App\Models\Product::factory(100)->create();
        \App\Models\Slider::factory(7)->create();



    }
}
