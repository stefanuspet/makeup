<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PortfolioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('portfolio')->insert([
            'img_path' => 'img/portfolio/bridal1.jpg',
            'title' => 'Akad| Reception| Wedding Ceremony',
            'description' => 'bridal',
            'service_id' => 1,
        ]);
        DB::table('portfolio')->insert([
            'img_path' => 'img/portfolio/bridal2.jpg',
            'title' => 'Akad| Reception| Wedding Ceremony',
            'description' => 'bridal',
            'service_id' => 1,
        ]);
        DB::table('portfolio')->insert([
            'img_path' => 'img/portfolio/bridal3.jpg',
            'title' => 'Akad| Reception| Wedding Ceremony',
            'description' => 'bridal',
            'service_id' => 1,
        ]);
        DB::table('portfolio')->insert([
            'img_path' => 'img/portfolio/bridal4.jpg',
            'title' => 'Akad| Reception| Wedding Ceremony',
            'description' => 'bridal',
            'service_id' => 1,
        ]);
        DB::table('portfolio')->insert([
            'img_path' => 'img/portfolio/bridal5.jpg',
            'title' => 'Akad| Reception| Wedding Ceremony',
            'description' => 'bridal',
            'service_id' => 1,
        ]);
        DB::table('portfolio')->insert([
            'img_path' => 'img/portfolio/Regular1.jpg',
            'title' => 'Party| Graduation',
            'description' => 'regular',
            'service_id' => 2,
        ]);
        DB::table('portfolio')->insert([
            'img_path' => 'img/portfolio/Regular2.jpg',
            'title' => 'Party| Graduation',
            'description' => 'regular',
            'service_id' => 2,
        ]);
        DB::table('portfolio')->insert([
            'img_path' => 'img/portfolio/Regular3.jpg',
            'title' => 'Party| Graduation',
            'description' => 'regular',
            'service_id' => 2,
        ]);
        DB::table('portfolio')->insert([
            'img_path' => 'img/portfolio/Regular4.jpg',
            'title' => 'Party| Graduation',
            'description' => 'regular',
            'service_id' => 2,
        ]);
        DB::table('portfolio')->insert([
            'img_path' => 'img/portfolio/Special1.jpg',
            'title' => 'Engagement| Quran Recitation',
            'description' => 'regular',
            'service_id' => 3,
        ]);
        DB::table('portfolio')->insert([
            'img_path' => 'img/portfolio/Special2.jpg',
            'title' => 'Engagement| Quran Recitation',
            'description' => 'regular',
            'service_id' => 3,
        ]);
        DB::table('portfolio')->insert([
            'img_path' => 'img/portfolio/Special3.jpg',
            'title' => 'Engagement| Quran Recitation',
            'description' => 'regular',
            'service_id' => 3,
        ]);
        DB::table('portfolio')->insert([
            'img_path' => 'img/portfolio/Special4.jpg',
            'title' => 'Engagement| Quran Recitation',
            'description' => 'regular',
            'service_id' => 3,
        ]);
    }
}
