<?php

namespace Database\Seeders;

use App\Models\Ticket_Category;
use App\Models\User;
use Illuminate\Database\Seeder;

class TicketCategorySeeder extends Seeder
{
    public function run(): void
    {
        // Создаем тестового пользователя для владельца категорий
        $user = User::first();
        
        if (!$user) {
            $user = User::create([
                'name' => 'Admin User',
                'login' => 'admin',
                'password' => bcrypt('password'),
                'description' => 'Admin user for ticket categories',
                'is_admin' => true
            ]);
        }

        Ticket_Category::create([
            'name' => 'VIP',
            'description' => 'VIP tickets with best seats',
            'owner_id' => $user->id,
            'price' => 1000.00
        ]);

        Ticket_Category::create([
            'name' => 'Standard',
            'description' => 'Standard tickets',
            'owner_id' => $user->id,
            'price' => 500.00
        ]);

        Ticket_Category::create([
            'name' => 'Economy',
            'description' => 'Economy tickets',
            'owner_id' => $user->id,
            'price' => 250.00
        ]);
    }
} 