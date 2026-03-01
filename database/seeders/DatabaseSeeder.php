<?php

namespace Database\Seeders;

use App\Models\TaskManager;
use App\Models\User;
use App\Models\Task;
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
            $managers = TaskManager::factory(fake()->numberBetween(1, 4))->create([
                'user_id' => $user->id,
            ]);

            foreach ($managers as $manager) {
                Task::factory(fake()->numberBetween(2, 6))->create([
                    'task_manager_id' => $manager->id,
                ]);
            }
        }
    }
}
