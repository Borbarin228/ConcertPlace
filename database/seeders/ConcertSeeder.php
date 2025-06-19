<?php

namespace Database\Seeders;

use App\Models\Concert;
use Illuminate\Database\Seeder;

class ConcertSeeder extends Seeder
{
    public function run(): void
    {
        Concert::create([
            'city' => 'Moscow',
            'place' => 'Kremlin Palace',
            'category_id' => 1,
            'start_at' => '2024-05-01',
            'is_accepted' => true
        ]);

        Concert::create([
            'city' => 'St. Petersburg',
            'place' => 'Ice Palace',
            'category_id' => 1,
            'start_at' => '2024-06-15',
            'is_accepted' => true
        ]);

        Concert::create([
            'city' => 'Kazan',
            'place' => 'Tatneft Arena',
            'category_id' => 1,
            'start_at' => '2024-07-20',
            'is_accepted' => false
        ]);
    }
} 