<?php

namespace Database\Seeders;

use App\Models\Concert;
use App\Models\Ticket_Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ConcertCategorySeeder extends Seeder
{
    public function run(): void
    {
        $concerts = Concert::all();
        $categories = Ticket_Category::all();

        if ($concerts->isEmpty() || $categories->isEmpty()) {
            return;
        }

        // Связываем каждый концерт со всеми категориями
        foreach ($concerts as $concert) {
            foreach ($categories as $category) {
                DB::table('concert_category')->insert([
                    'concert_id' => $concert->id,
                    'ticket_category_id' => $category->id,
                ]);
            }
        }
    }
} 