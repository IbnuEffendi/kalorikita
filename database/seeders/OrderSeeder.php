<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrderSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('orders')->insert([
            [
                'user_id' => 2,
                'paket_option_id' => 1,
                'start_date' => now(),
                'end_date' => now()->addDays(7),
                'total_hari' => 7,
                'total_box' => 7,
                'box_terpakai' => 3,
                'food_preference' => 'non_vegan',
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
