<?php

namespace Database\Seeders;

use App\Models\TaskManager;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Known user
        $testUser = User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'is_active' => true,
        ]);

        // Other users
        $users = User::factory(20)->create();

        // TaskManagers for Test User
        TaskManager::factory(3)->create([
            'user_id' => $testUser->id,
        ]);

        // TaskManagers for each fake user
        foreach ($users as $user) {
            TaskManager::factory(fake()->numberBetween(1, 4))->create([
                'user_id' => $user->id,
            ]);
        }
    }
}
