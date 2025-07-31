
# 🛠️ Service Booking System API

This is a RESTful API built with **Laravel 8** for a **Service Booking System**. It allows users to register, login, browse services, and book them. Admins can manage services and view all bookings.

---

## 🚀 Features

- ✅ User registration and login (token-based using Laravel Sanctum)
- 📋 View active services
- 📅 Book a service (no duplicates or past dates allowed)
- 🔐 Admin panel for managing services and viewing all bookings

---

## ⚙️ Installation & Setup

### Prerequisites
- PHP >= 8.0
- Composer
- Laravel 8
- MySQL or any supported DB
- Postman (for testing)

### 🧪 How to Run from Git

```bash
# 1. Clone the repository
git clone https://github.com/asfaquralam1/service-booking-system

# 2. Navigate into the project directory
cd service-booking-system

# 3. Install PHP dependencies
composer install

# 4. Copy .env and generate app key
cp .env.example .env
php artisan key:generate

# 5. Configure your database in .env file

# 6. Run migrations
php artisan migrate

# 7. (Optional) Seed dummy data
php artisan db:seed

# 8. Start the development server
php artisan serve
```

Then open: [http://localhost:8000/api](http://localhost:8000/api)

---

## 🔐 Authentication

This API uses **Laravel Sanctum** for authentication.

- **Register:** `POST /api/register`
- **Login:** `POST /api/login`

Add the token in Postman or HTTP client as:

```
Authorization: Bearer {your_token}
```

---

## 🧪 How to Test the API

### 🔸 Option 1: Using Postman

1. Open Postman
2. Import the file: `service_booking_postman_collection.json`
3. Set environment variables:
   - `base_url` → `http://localhost:8000/api`
   - `token` → Paste your auth token here
4. Use the provided endpoints to test registration, login, booking, etc.

### 🔸 Option 2: Using Swagger

1. Open [https://editor.swagger.io](https://editor.swagger.io)
2. Click `File > Import File`
3. Upload `service_booking_openapi.json`

You’ll be able to explore and test the API interactively.

---

## 📘 API Documentation

- 🧾 **Swagger/OpenAPI:** `service_booking_openapi.json`
- 📦 **Postman Collection:** `service_booking_postman_collection.json`

These are included in the root of this project.

---

## 🧑‍💼 Admin Access

To access admin-only routes, update a user in the database:

```sql
UPDATE users SET is_admin = 1 WHERE email = 'admin@example.com';
```

---

## 📂 Project Structure

- `app/Http/Controllers/` - API Controllers
- `app/Services/` - Business logic services
- `routes/api.php` - API routes

---
