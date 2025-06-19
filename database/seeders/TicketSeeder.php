<?php

namespace Database\Seeders;

use App\Models\Ticket;
use App\Models\Concert;
use App\Models\User;
use App\Models\Ticket_Category;
use Illuminate\Database\Seeder;

class TicketSeeder extends Seeder
{
    public function run(): void
    {
        // Получаем существующие данные
        $user = User::first();
        $concerts = Concert::all();
        $categories = Ticket_Category::all();

        if (!$user || $concerts->isEmpty() || $categories->isEmpty()) {
            return; // Не можем создать билеты без необходимых данных
        }

        // Создаем билеты для каждого концерта
        foreach ($concerts as $concert) {
            foreach ($categories as $category) {
                // Создаем несколько билетов для каждой категории
                for ($i = 1; $i <= 3; $i++) {
                    Ticket::create([
                        'user_id' => $user->id,
                        'number' => rand(1000, 9999), // Случайный номер билета
                        'concert_id' => $concert->id,
                        'category_id' => $category->id
                    ]);
                }
            }
        }
    }
} 