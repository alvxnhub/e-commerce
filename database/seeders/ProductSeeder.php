<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       Product::create([
    'name' => 'MCC Official Uniform',
    'description' => 'This is a sample product.',
    'price' => 499.991,
    'image' => 'mcc-uniform.png',
    ]);

    }
}
