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
        Product::create([
    'name' => 'MCC P.E Uniform',
    'description' => 'This is just a sample product.',
    'price' => 449.991,
    'image' => 'mcc-pe.png',
    ]);
        Product::create([
    'name' => 'MCC NSTP Uniform',
    'description' => 'This is another sample product.',
    'price' => 349.991,
    'image' => 'mcc-nstp.png',
    ]);

    }
}
