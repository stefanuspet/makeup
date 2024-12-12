<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('services')->insert([
            'title' => 'Bridal Makeup',
            'img' => 'img/portfolio/bridal1.jpg',
            'description' => 'Your beauty, our expertise: Creating unforgettable bridal makeup that captures your unique radiance on the most magical day of your life.',
            'duration' => '04:00',
            'price' => 1000000,
        ]);
        DB::table('services')->insert([
            'title' => 'Special Occasion',
            'img' => 'img/portfolio/special1.jpg',
            'description' => 'Your beauty, our expertise: Creating unforgettable bridal makeup that captures your unique radiance on the most magical day of your life.',
            'duration' => '03:00',
            'price' => 500000,
        ]);
        DB::table('services')->insert([
            'title' => 'Regular Makeup',
            'img' => 'img/portfolio/regular1.jpg',
            'description' => 'Your beauty, our expertise: Creating unforgettable bridal makeup that captures your unique radiance on the most magical day of your life.',
            'duration' => '02:00',
            'price' => 300000,
        ]);
    }
}
