# ⚡ PHP MVC Framework — Built from Scratch

<p align="center">
  <img src="https://img.shields.io/badge/PHP-8.x-777BB4?style=for-the-badge&logo=php&logoColor=white"/>
  <img src="https://img.shields.io/badge/MySQL-4479A1?style=for-the-badge&logo=mysql&logoColor=white"/>
  <img src="https://img.shields.io/badge/PDO-Enabled-green?style=for-the-badge"/>
  <img src="https://img.shields.io/badge/Composer-PSR--4-orange?style=for-the-badge&logo=composer&logoColor=white"/>
  <img src="https://img.shields.io/badge/License-MIT-blue?style=for-the-badge"/>
</p>

> A fully custom-built PHP MVC framework with no heavy dependencies — crafted from the ground up to deeply understand how modern frameworks like **Laravel** work under the hood.

---

## 📌 Table of Contents

- [About](#-about)
- [Features](#-features)
- [Project Structure](#-project-structure)
- [Requirements](#-requirements)
- [Installation](#-installation)
- [Configuration](#-configuration)
- [Usage](#-usage)
  - [Routing](#routing)
  - [Controllers](#controllers)
  - [Models](#models)
  - [Validation](#validation)
  - [Views](#views)
  - [Helpers](#helpers)
- [Validation Rules Reference](#-validation-rules-reference)
- [Tech Stack](#-tech-stack)

---

## 🧠 About

This project is a **lightweight MVC (Model-View-Controller) framework** built entirely from scratch in PHP. It was built as a deep-dive learning project to understand the internals of how popular PHP frameworks are architected — covering everything from routing and request handling, to validation pipelines and database abstraction layers.

It is **not** a production framework, but a clean, readable, and well-structured codebase that demonstrates strong OOP principles and architectural patterns.

---

## ✨ Features

| Feature | Description |
|---|---|
| 🔀 **Custom Router** | Static `GET` / `POST` route registration with controller/method dispatch |
| 🛡️ **Validation Engine** | Chainable, extensible rule-based validation system |
| 🗄️ **Database Abstraction** | PDO-based MySQL manager with query, create, read, update & delete |
| 🧩 **Base Model** | Eloquent-inspired static model methods (`create`, `all`, `where`, `update`, `delete`) |
| 🔐 **Session Manager** | Flash session support for errors and old input repopulation |
| 🖼️ **View Engine** | Simple PHP template rendering with layout & partial support |
| ⚙️ **Config System** | File-based config loader with dot-notation access |
| 🧰 **Laravel-style Helpers** | `app()`, `request()`, `view()`, `config()`, `env()`, `old()`, `back()`, `bcrypt()` |
| 📦 **PSR-4 Autoloading** | Composer-based namespace autoloading — no manual `require` |
| 🔒 **Password Hashing** | Built-in `bcrypt` helper via `Hash` support class |

---

## 📁 Project Structure

```
mvc/
├── App/
│   ├── Controllers/
│   │   ├── HomeController.php
│   │   └── RegisterController.php
│   └── Models/
│       ├── Model.php          # Abstract base model
│       └── User.php
│
├── Config/
│   ├── app.php
│   ├── database.php
│   └── mail.php
│
├── Routes/
│   └── web.php                # All application routes
│
├── Views/
│   ├── layouts/               # Base layout templates
│   ├── partials/              # Reusable partials (navbar, etc.)
│   ├── auth/                  # Auth views (register, login)
│   ├── errors/                # Error pages (404, etc.)
│   └── home.php
│
├── src/                       # Framework core (Moayman\Mvc namespace)
│   ├── Application.php        # App bootstrapper & service container
│   ├── Database/
│   │   ├── DB.php             # Database facade with __call magic
│   │   ├── Grammers/          # SQL query grammar builders
│   │   ├── Managers/
│   │   │   ├── MySQLManager.php
│   │   │   └── Contracts/DatabaseManager.php
│   │   └── Concerns/          # ConnectsTo trait
│   ├── Http/
│   │   ├── Request.php        # HTTP Request wrapper
│   │   ├── Response.php       # HTTP Response (redirect, status)
│   │   └── Route.php          # Static router
│   ├── Validation/
│   │   ├── Validator.php      # Core validator class
│   │   ├── RulesResolver.php  # Parses rule strings to rule objects
│   │   ├── RulesMapper.php    # Maps rule names to rule classes
│   │   ├── Errorbag.php       # Collects validation errors
│   │   ├── Message.php        # Generates error messages
│   │   └── Rules/
│   │       ├── RequiredRule.php
│   │       ├── EmailRule.php
│   │       ├── AlphanumRule.php
│   │       ├── MaxRule.php
│   │       ├── BetweenRule.php
│   │       ├── ConfirmedRule.php
│   │       ├── UniqueRule.php
│   │       └── contract/Rule.php  # Rule interface
│   ├── View/
│   │   └── View.php
│   └── Support/
│       ├── helpers.php        # Global helper functions
│       ├── Session.php
│       ├── Hash.php
│       ├── Str.php
│       ├── Arr.php
│       └── config.php
│
├── Public/                    # Web root (index.php entry point)
├── database/                  # Migrations / seeds
├── .env                       # Environment variables
├── composer.json
└── README.md
```

---

## 📋 Requirements

- PHP **8.0+**
- MySQL / MariaDB
- Composer
- A web server (Apache / Nginx) or PHP built-in server

---

## 🚀 Installation

**1. Clone the repository**
```bash
git clone https://github.com/your-username/mvc-framework.git
cd mvc-framework
```

**2. Install dependencies**
```bash
composer install
```

**3. Copy the environment file**
```bash
cp .env.example .env
```

**4. Configure your `.env`** *(see [Configuration](#-configuration))*

**5. Point your web server root to the `/Public` directory**

Or use PHP's built-in server:
```bash
php -S localhost:8000 -t Public
```

---

## ⚙️ Configuration

Edit your `.env` file:

```env
DB_DRIVER=mysql
DB_HOST=127.0.0.1
DB_DATABASE=your_database
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

Config files live in `/Config`:
- `app.php` — application settings
- `database.php` — database settings
- `mail.php` — mail settings

Access config values anywhere using:
```php
config('database.host');
```

---

## 💻 Usage

### Routing

Define your routes in `Routes/web.php`:

```php
use App\Controllers\HomeController;
use App\Controllers\RegisterController;
use Moayman\Mvc\Http\Route;

Route::get('/', [HomeController::class, 'index']);
Route::get('/signup', [RegisterController::class, 'index']);
Route::post('/signup', [RegisterController::class, 'store']);
```

---

### Controllers

```php
namespace App\Controllers;

class HomeController
{
    public function index()
    {
        return view('home');
    }
}
```

---

### Models

Models extend the base `Model` class and get static CRUD methods for free:

```php
namespace App\Models;

class User extends Model {}
```

```php
// Create
User::create(['name' => 'John', 'email' => 'john@example.com']);

// Read all
$users = User::all();

// Filter
$users = User::where(['email', '=', 'john@example.com']);

// Update
User::update($id, ['name' => 'Jane']);

// Delete
User::delete($id);
```

> The table name is automatically resolved from the class name (e.g. `User` → `users`).

---

### Validation

```php
$validator = new validator();

$validator->setrules([
    'name'     => 'required|alnum|between:5,32',
    'username' => 'required|alnum|between:5,32|unique:users,username',
    'email'    => 'required|email|unique:users,email',
    'password' => 'required|alnum|between:8,32|confirmed',
]);

$validator->make(request()->all());

if (!$validator->passes()) {
    app()->session->setFlash('errors', $validator->errors());
    app()->session->setFlash('old', request()->all());
    return back();
}
```

---

### Views

Views are plain PHP files stored in `/Views`:

```php
// Render a view
view('auth.register');

// Render with data
view('profile', ['user' => $user]);
```

Use `old()` in views to repopulate form fields after failed validation:

```html
<input type="text" name="username" value="<?= old('username') ?>">
```

Display validation errors:

```php
<?php if (app()->session->hasFlash('errors')): ?>
    <?php foreach (app()->session->getFlash('errors') as $field => $error): ?>
        <p class="error"><?= $error ?></p>
    <?php endforeach; ?>
<?php endif; ?>
```

---

### Helpers

| Helper | Description |
|---|---|
| `app()` | Returns the singleton Application instance |
| `request($key?)` | Returns the Request instance or a specific input value |
| `view($view, $data?)` | Renders a view template |
| `config($key, $default?)` | Reads a config value |
| `env($key, $default?)` | Reads an environment variable |
| `old($key)` | Gets old flashed input value |
| `back()` | Redirects to the previous URL |
| `bcrypt($password)` | Hashes a password |
| `base_path()` | Returns the absolute project root path |

---

## 📖 Validation Rules Reference

| Rule | Syntax | Description |
|---|---|---|
| `required` | `required` | Field must not be empty |
| `email` | `email` | Must be a valid email format |
| `alnum` | `alnum` | Must contain only alphanumeric characters |
| `max` | `max:255` | Value length must not exceed the given max |
| `between` | `between:5,32` | Value length must be between min and max |
| `confirmed` | `confirmed` | Must match the `field_confirmation` input |
| `unique` | `unique:table,column` | Value must not already exist in the DB |

Rules can be chained with `|`:
```
'email' => 'required|email|between:5,100|unique:users,email'
```

---

## 🛠️ Tech Stack

- **Language:** PHP 8.x
- **Database:** MySQL via PDO
- **Autoloading:** Composer PSR-4
- **Dependencies:**
  - [`vlucas/phpdotenv`](https://github.com/vlucas/phpdotenv) — `.env` file loading
  - [`symfony/var-dumper`](https://symfony.com/doc/current/components/var_dumper.html) — Debug dumping

---

## 🤝 Contributing

Contributions, issues, and feature requests are welcome!
Feel free to open an issue or submit a pull request.

---

## 📄 License

This project is licensed under the **MIT License**.

---

<p align="center">Built with ❤️ by <strong>Mohamed Ayman</strong></p>
