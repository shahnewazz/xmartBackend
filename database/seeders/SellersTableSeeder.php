<?php

namespace Database\Seeders;

use App\Models\Seller;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SellersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Seller::create([
            'name' => 'seller',
            'email' => 'seller@gmail.com',
            'phone' => '01234',
            'password' => Hash::make('password'),
        ]);
    }
}
