# Laravel Project Management API

![Laravel](https://img.shields.io/badge/framework-Laravel-red)
![License](https://img.shields.io/badge/license-MIT-blue)

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
POST /api/login
GET /api/me

-   Projects v1/projects
-   Tasks v1/tasks

## 🧑💻 Setup

```bash
git clone https://github.com/sahanpasindu/laravel-project-management-api.git
cd laravel-project-management-api
composer install
cp .env.example .env
php artisan migrate
php artisan serve
```

## 🧪 API Testing

You can test the API quickly using our ready‑made Postman collection.

1. Open Postman → File → Import → Link File or Upload File
2. Choose this file: [`api-tests/postman_collection.json`](./api-tests/postman_collection.json)
3. Set the variable `{{base_url}}` to your running Laravel endpoint (`http://127.0.0.1:8000/`)

Includes:

-   Auth (register/login)
-   Project CRUD
-   Task CRUD
