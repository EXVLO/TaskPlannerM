<?php

namespace Database\Seeders;

use App\Models\Tag;
use App\Models\Task;
use App\Models\TaskEntry;
use App\Models\TaskManager;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // ----------------------------
        // Known user
        // ----------------------------

        $testUser = User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'is_active' => true,
        ]);

        // Create tags for test user
        $testTags = Tag::factory(fake()->numberBetween(3, 6))->create([
            'user_id' => $testUser->id,
        ]);

        $testManagers = TaskManager::factory(3)->create([
            'user_id' => $testUser->id,
        ]);

        foreach ($testManagers as $manager) {
            $tasks = Task::factory(fake()->numberBetween(2, 6))->create([
                'task_manager_id' => $manager->id,
            ]);

            foreach ($tasks as $task) {
                // Attach random tags to task
                $randomTags = $testTags->random(
                    min(fake()->numberBetween(1, 3), $testTags->count())
                );

                $task->tags()->attach(
                    $randomTags->pluck('id')->toArray()
                );

                // Create task entries
                $days = fake()->numberBetween(5, 15);

                for ($i = 0; $i < $days; $i++) {
                    TaskEntry::create([
                        'task_id' => $task->id,
                        'entry_date' => now()->subDays($i)->toDateString(),
                        'actual_value' => fake()->numberBetween(0, 10),
                    ]);
                }
            }
        }

        // ----------------------------
        // Fake users
        // ----------------------------

        $users = User::factory(20)->create();

        foreach ($users as $user) {
            // Create tags per user
            $tags = Tag::factory(fake()->numberBetween(3, 6))->create([
                'user_id' => $user->id,
            ]);

            $managers = TaskManager::factory(fake()->numberBetween(1, 4))->create([
                'user_id' => $user->id,
            ]);

            foreach ($managers as $manager) {
                $tasks = Task::factory(fake()->numberBetween(2, 6))->create([
                    'task_manager_id' => $manager->id,
                ]);

                foreach ($tasks as $task) {
                    // Attach random tags
                    $randomTags = $tags->random(
                        min(fake()->numberBetween(1, 3), $tags->count())
                    );

                    $task->tags()->attach(
                        $randomTags->pluck('id')->toArray()
                    );

                    // Create entries
                    $days = fake()->numberBetween(5, 15);

                    for ($i = 0; $i < $days; $i++) {
                        TaskEntry::create([
                            'task_id' => $task->id,
                            'entry_date' => now()->subDays($i)->toDateString(),
                            'actual_value' => fake()->numberBetween(0, 10),
                        ]);
                    }
                }
            }
        }
    }
}
