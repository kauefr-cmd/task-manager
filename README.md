# Task Manager

A simple task management CRUD built with Laravel, Tailwind CSS and DaisyUI to improve my skills.

## Features

- List tasks with filters by status and sorting
- Create, view, edit and delete tasks
- Task statuses: **Pending**, **In Progress** and **Done**
- Completed tasks cannot be edited (business rule)
- Optional due date per task
- Light / Dark / System theme toggle
- REST API endpoints available at `/api/tasks`

## Requirements

- PHP 8.2+
- Composer
- Node.js 18+
- A database supported by Laravel (SQLite, MySQL, PostgreSQL)

## Installation

**1. Clone the repository**
```bash
git clone <repository-url>
cd crudwithlaravel
```

**2. Install PHP dependencies**
```bash
composer install
```

**3. Install JS dependencies**
```bash
npm install
```

**4. Set up environment**
```bash
cp .env.example .env
php artisan key:generate
```

**5. Configure the database**

Open `.env` and set your database credentials. For a quick local setup with SQLite:
```env
DB_CONNECTION=sqlite
```
Then create the database file:
```bash
touch database/database.sqlite
```

**6. Run migrations**
```bash
php artisan migrate
```

**7. Start the development servers**
```bash
npm run dev &
php artisan serve
```

Open [http://localhost:8000](http://localhost:8000) in your browser.

## API Endpoints

| Method | URL | Description |
|--------|-----|-------------|
| GET | `/api/tasks` | List tasks (supports `?status=` and `?sort=` filters) |
| POST | `/api/tasks` | Create a task |
| GET | `/api/tasks/{id}` | Get a single task |
| PUT | `/api/tasks/{id}` | Update a task |
| DELETE | `/api/tasks/{id}` | Delete a task |
