<?php

namespace Database\Seeders;

use App\Models\Task;
use Illuminate\Database\Seeder;

class TaskSeeder extends Seeder
{
    public function run(): void
    {
        $tasks = [
            ['title' => 'Set up CI/CD pipeline', 'description' => 'Configure GitHub Actions to run tests and deploy automatically on every push to main.', 'status' => 'done', 'due_date' => '2026-03-10'],
            ['title' => 'Design database schema', 'description' => 'Define all tables, relationships and indexes for the new platform.', 'status' => 'done', 'due_date' => '2026-03-15'],
            ['title' => 'Implement user authentication', 'description' => 'Add login, registration and password reset using Laravel Breeze.', 'status' => 'done', 'due_date' => '2026-03-20'],
            ['title' => 'Write unit tests for task model', 'description' => null, 'status' => 'in_progress', 'due_date' => '2026-04-10'],
            ['title' => 'Build dashboard UI', 'description' => 'Create a summary page showing task counts grouped by status.', 'status' => 'in_progress', 'due_date' => '2026-04-12'],
            ['title' => 'Add email notifications', 'description' => 'Send a reminder email when a task is approaching its due date.', 'status' => 'in_progress', 'due_date' => '2026-04-18'],
            ['title' => 'Integrate file attachments', 'description' => 'Allow users to upload files to a task using Laravel Storage.', 'status' => 'pending', 'due_date' => '2026-04-25'],
            ['title' => 'Implement task search', 'description' => null, 'status' => 'pending', 'due_date' => '2026-04-30'],
            ['title' => 'Add pagination to API', 'description' => 'Ensure all list endpoints return paginated responses with metadata.', 'status' => 'pending', 'due_date' => '2026-05-05'],
            ['title' => 'Write API documentation', 'description' => 'Document all endpoints using OpenAPI/Swagger.', 'status' => 'pending', 'due_date' => '2026-05-10'],
            ['title' => 'Optimize database queries', 'description' => 'Review slow queries using Laravel Telescope and add missing indexes.', 'status' => 'pending', 'due_date' => null],
            ['title' => 'Deploy to production', 'description' => 'Set up the server, configure environment variables and run first production deploy.', 'status' => 'pending', 'due_date' => '2026-05-20'],
        ];

        foreach ($tasks as $task) {
            Task::create($task);
        }
    }
}