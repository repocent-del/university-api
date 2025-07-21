# Professors & Courses REST API

A modern, Dockerized Laravel 12 REST API for managing professors and their courses. Built with professional best practices, authentication, API resources, testing, seeders, and consistent error handling.

---

## 🚀 Technologies Used

-   **Laravel 12**
-   **PHP 8.4**
-   **MySQL 8**
-   **Docker & Docker Compose**
-   **Laravel Sanctum** (API authentication)
-   **PHPUnit** (Feature tests)
-   **Factories & Seeders**

---

## ⚡️ Getting Started

### 1. Clone & Configure

```bash
git clone <your-repo-url>
cd <your-repo-folder>
cp .env.example .env

# Edit .env for DB and app configuration if needed
```

### 2. Start Service

```bash
docker-compose up -d --build
```

### 3. Install Composer Dependencies & App Key

```bash
docker-compose run --rm app composer install
docker-compose run --rm app php artisan key:generate
```

### 4. Run Migrations and Seeders

```bash
docker-compose run --rm app php artisan migrate --seed
```

### Database Seeding

```bash
docker-compose run --rm app php artisan db:seed
```

### Authentication Workflow

-   Register: POST `/api/v1/register`

-   Login: POST `/api/v1/login`

-   On success, receive a Bearer token.

-   Logout: POST `/api/v1/logout` (token required)

All Professor and Course endpoints require authentication via Bearer token.

### API Endpoints

| Method | Endpoint                  | Description            | Auth Required |
| ------ | ------------------------- | ---------------------- | ------------- |
| POST   | `/api/v1/register`        | Register new user      | No            |
| POST   | `/api/v1/login`           | Login and get token    | No            |
| POST   | `/api/v1/logout`          | Logout current user    | Yes           |
| GET    | `/api/v1/courses`         | List all courses       | Yes           |
| GET    | `/api/v1/courses/{id}`    | Get a course by ID     | Yes           |
| POST   | `/api/v1/courses`         | Create a new course    | Yes           |
| PUT    | `/api/v1/courses/{id}`    | Update a course        | Yes           |
| DELETE | `/api/v1/courses/{id}`    | Delete a course        | Yes           |
| GET    | `/api/v1/professors`      | List all professors    | Yes           |
| GET    | `/api/v1/professors/{id}` | Get a professor by ID  | Yes           |
| POST   | `/api/v1/professors`      | Create a new professor | Yes           |
| PUT    | `/api/v1/professors/{id}` | Update a professor     | Yes           |
| DELETE | `/api/v1/professors/{id}` | Delete a professor     | Yes           |

### cURL Examples

**Register**

```bash
curl -X POST http://localhost:8000/api/v1/register \
  -H "Accept: application/json" \
  -d "name=John Doe" \
  -d "email=john@example.com" \
  -d "password=secret123" \
  -d "password_confirmation=secret123"
```

**Login**

```bash
curl -X GET http://localhost:8000/api/v1/courses \
  -H "Authorization: Bearer <YOUR_TOKEN>" \
  -H "Accept: application/json"
```

**Create a Professor**

```bash
curl -X POST http://localhost:8000/api/v1/professors \
  -H "Authorization: Bearer <YOUR_TOKEN>" \
  -H "Accept: application/json" \
  -d "firstname=Alice" \
  -d "lastname=Smith" \
  -d "degree=PhD" \
  -d "join_at=2022-01-01" \
  -d "email=alice@example.com" \
  -d "address=123 Main St" \
  -d "phone=5551234"
```

### Running Tests

```bash
docker-compose run --rm app php artisan test
```

### Project Structure

-   app/Models - Eloquent models

-   app/Http/Controllers/Api/V1 - API controllers

-   database/factories - Model factories

-   database/seeders - Seeder classes

-   tests/Feature/Api/V1 - Feature/API tests

-   routes/api.php - API routes
