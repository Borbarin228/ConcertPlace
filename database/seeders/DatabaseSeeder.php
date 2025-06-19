<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // Сначала создаем пользователя
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => bcrypt('password'),
            'description' => 'Test user',
            'is_admin' => false
        ]);

        // Затем запускаем сидеры в правильном порядке
        $this->call([
            TicketCategorySeeder::class,   // Сначала категории билетов
            ConcertSeeder::class,          // Потом концерты
            ConcertCategorySeeder::class,  // Связи между концертами и категориями
            TicketSeeder::class,           // И наконец билеты
        ]);
    }
}
