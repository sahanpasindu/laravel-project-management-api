# Laravel Project Management API

A full-featured project management backend built using Laravel 12 and Sanctum authentication.

## 🚀 Tech Stack

-   Laravel 12 (API mode)
-   Sanctum Authentication
-   PostgreSQL/MySQL
-   RESTful Architecture
-   Form Requests & API Resources
-   Custom Exception Handling (`withExceptions`)
-   Versioned API structure (`/api/v1`)

## ⚙️ Features

-   User authentication (register/login/logout)
-   Project CRUD (with owner-based access control)
-   Task management (coming soon)
-   JSON responses with Laravel Resource classes
-   Robust validation & error handling
-   Pagination-ready endpoints

## 🧠 Highlights

-   Modern Laravel 12 exception handling without `Handler.php`
-   Proper folder versioning and clean architecture
-   Built using good Git and REST API best practices

## 🔗 API Examples

POST /api/register

GET /api/v1/projects

## 🧑💻 Setup

```bash
git clone https://github.com/sahanpasindu/laravel-project-management-api.git
cd laravel-project-management-api
composer install
cp .env.example .env
php artisan migrate
php artisan serve
```
