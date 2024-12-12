<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdditionalServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('additional_services')->insert([
            'name' => 'Accessories| Hair do| Hijab do',
            'price' => 500000,
            'service_id' => 1,
        ]);
        DB::table('additional_services')->insert([
            'name' => 'Trial makeup',
            'price' => 0,
            'service_id' => 1,
        ]);
        DB::table('additional_services')->insert([
            'name' => 'Accessories',
            'price' => 0,
            'service_id' => 1,
        ]);
        DB::table('additional_services')->insert([
            'name' => 'Accessories| Hair do| Hijab do',
            'price' => 300000,
            'service_id' => 2,
        ]);
        DB::table('additional_services')->insert([
            'name' => 'Trial makeup',
            'price' => 0,
            'service_id' => 2,
        ]);
        DB::table('additional_services')->insert([
            'name' => 'Accessories',
            'price' => 0,
            'service_id' => 2,
        ]);
        DB::table('additional_services')->insert([
            'name' => 'Accessories| Hair do| Hijab do',
            'price' => 500000,
            'service_id' => 3,
        ]);
        DB::table('additional_services')->insert([
            'name' => 'Trial makeup',
            'price' => 0,
            'service_id' => 3,
        ]);
        DB::table('additional_services')->insert([
            'name' => 'Accessories',
            'price' => 0,
            'service_id' => 3,
        ]);
    }
}
