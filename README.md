# Softxpert Task

A Laravel 12 application for managing tasks with role-based access control (RBAC). It uses Laravel Sanctum for API authentication and Spatie Laravel Permission for managing user roles and permissions. Features include task creation, updates, dependency management, and filtering, with validation to prevent circular dependencies.

## Features
- **Authentication**: API token-based authentication via Laravel Sanctum.
- **Roles and Permissions**:
  - `manager`: Create, update, assign tasks, and manage dependencies.
  - `user`: View own tasks and update task status.
- **Task Management**: CRUD operations with filtering by status, due date, or assignee.
- **API Endpoints**: RESTful API under `/api/v1` (e.g., `GET /tasks`, `PUT /tasks/{id}`).

## Requirements
- **PHP**: 8.1 or higher
- **Composer**: 2.0 or higher
- **MySQL**: 8.0 or higher
- **Laravel**: 12.x

## Installation

### Clone the Repository
```bash
git clone https://github.com/sowidan1/softxpert.git
cd softxpert
```

### Install Dependencies
Install PHP dependencies via Composer:
```bash
composer install
```

### Environment Setup
Copy the example environment file and generate an application key:
```bash
cp .env.example .env
php artisan key:generate
```

### Environment Variables
Edit the `.env` file with the following settings:

#### Database Configuration
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=db_name
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

### Database Migration
Run migrations to set up the database schema:
```bash
php artisan migrate
```

seed the database with initial data:
```bash
php artisan db:seed
```

## Output
1. **Code Repository**: The code is hosted on GitHub: [https://github.com/sowidan1/SEO-era-task](https://github.com/sowidan1/Softxpert).
2. **Postman Collection**: Included in the repository as `Softxpert.postman_collection.json`.

## Contributing
Developed with ❤️ by [Osama Sowidan](https://github.com/sowidan1) - Software Engineer.

For contributions, please fork the repository, create a feature branch, and submit a pull request. Ensure all tests pass and follow the coding standards.
