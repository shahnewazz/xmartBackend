<?php

namespace Database\Seeders;

use App\Models\Division;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DivisionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Division::insert(
            [
                [
                    "id" => 1,
                    "name" => "Dhaka",
                    "bn_name" => "ঢাকা"
                ],
                [
                    "id" => 2,
                    "name" => "Chittagong",
                    "bn_name" => "চট্টগ্রাম"
                ],
                [
                    "id" => 3,
                    "name" => "Rajshahi",
                    "bn_name" => "রাজশাহী"
                ],
                [
                    "id" => 4,
                    "name" => "Khulna",
                    "bn_name" => "খুলনা"
                ],
                [
                    "id" => 5,
                    "name" => "Barisal",
                    "bn_name" => "বরিশাল"
                ],
                [
                    "id" => 6,
                    "name" => "Rangpur",
                    "bn_name" => "রংপুর"
                ],
                [
                    "id" => 7,
                    "name" => "Sylhet",
                    "bn_name" => "সিলেট"
                ],
                [
                    "id" => 8,
                    "name" => "Mymensingh",
                    "bn_name" => "ময়মনসিংহ"
                ]
            ]
        );
    }
}
