
# Meskellil Ecommerce

Meskellil is a modern Laravel-based ecommerce platform designed for flexibility, scalability, and ease of use. Built with Laravel 12 and Blade, it provides a robust backend and a clean server-rendered frontend for managing products, orders, and users, making it ideal for online retail businesses of any size.

---

## 🧭 Table of Contents

* [Getting Started](#getting-started)
* [Installation](#installation)
* [Quick Setup](#quick-setup-and-run)
* [Project Structure](#project-structure)
* [Contributors](#contributors)

---

## 🚀 Getting Started

Make sure your system has the following installed:

### Prerequisites

* **PHP**: ^8.2
* **Composer**: ^2.8
* **MySQL/MariaDB**
* **Git**

---

## 🛠 Installation

### Step 1: Clone the Repository

```bash
git clone https://github.com/Aissa-Gue/meskellil_ecommerce_v2.git
cd meskellil_ecommerce_v2
```


### Step 2: Install Dependencies

```bash
composer install
```

### Step 3: Configure Environment

```bash
cp .env.example .env
php artisan key:generate
```

Edit `.env` to match your database and mail settings.

### Step 4: Create Storage Link

```bash
php artisan storage:link
```

### Step 5: Run Migrations and Seeds

```bash
php artisan migrate
php artisan db:seed
```



### Step 6: Launch Server

```bash
php artisan serve
```

Visit [http://127.0.0.1:8000](http://127.0.0.1:8000)

---

## ⚡ Quick Setup and Run

### Windows:

```bash
@echo off && git clone https://github.com/Aissa-Gue/meskellil_ecommerce_v2.git & cd meskellil_ecommerce_v2 & composer install & copy .env.example .env & php artisan key:generate & php artisan storage:link & php artisan migrate & php artisan db:seed & start cmd /k "php artisan serve"
```

### Linux:

```bash
#!/bin/bash
git clone https://github.com/Aissa-Gue/meskellil_ecommerce_v2.git
cd meskellil_ecommerce_v2
composer install
cp .env.example .env
php artisan key:generate
php artisan storage:link
php artisan migrate
php artisan db:seed
php artisan serve
```

---

## 🧬 Project Structure (Key Elements)

```
meskellil_ecommerce_v2/
│
├── app/                   # Laravel application logic
│   ├── Models/            # Eloquent models
│   ├── Http/Controllers/  # Controllers
│   ├── Services/          # Business logic services
│   └── QueryFilters/      # Query filter classes
│
├── resources/
│   └── views/             # Blade templates
│
├── routes/
│   └── web.php            # Web routes
│
├── database/
│   ├── migrations/        # DB schema
│   └── seeders/           # Sample data
│
├── public/
│   └── assets/            # Public assets (css, js, images)
│
├── composer.json
├── package.json
└── README.md
```

---

## 👥 Contributors

* [Aissa Gue](https://github.com/Aissa-Gue)
* [DADDIOUAMER Redouane](https://github.com/D-Redouane)

---

<div align="center">   
    <img src="./public/assets/img/logo/meskellil_logo.PNG" width="200">
    <p>&copy; 2025 Meskellil Ecommerce – All rights reserved.</p> 
</div>
