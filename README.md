# Laravel 12 E-Commerce Storefront

A simple, modular, and functional e-commerce application built with **Laravel 12**, **Blade Components**, **Tailwind CSS**, and **Laravel Breeze** for authentication, made for educational purposes.

Lazily written with Gemini Auto Low ([https://share.gemini.google/zpuEXfDCo9yi](https://share.gemini.google/zpuEXfDCo9yi)).


---

## 🚀 Features

### **Storefront & Customer Experience**
* **Product Catalog:** Browse featured products with grid-based responsive layout.
* **Session-Based Cart:** Add, update quantities, or remove products seamlessly without requiring immediate registration.
* **Order Checkout:** Simple checkout form collecting shipping details with transactional database safety and automated inventory/stock deduction.
* **Order Confirmation:** Clear success screen showing order summary and shipping details.

### **Admin Management**
* **Product CRUD:** Manage product catalog (create, edit, view, delete products with image uploads).
* **Order Management Dashboard:** View all incoming customer orders, inspect order items, and update order fulfillment statuses (`pending`, `processing`, `completed`, `cancelled`).
* **Seeded Admin Access:** Pre-configured administrator account for quick testing.

---

## 🛠️ Tech Stack

* **Framework:** Laravel 12
* **Language:** PHP 8.2+
* **Frontend:** Blade Templating + Tailwind CSS
* **Asset Bundler:** Vite
* **Authentication:** Laravel Breeze
* **Database:** MySQL / SQLite

---

## 📂 Project Structure

```text
app/
├── Http/
│   ├── Controllers/
│   │   ├── Admin/
│   │   │   └── OrderController.php
│   │   ├── CartController.php
│   │   ├── CheckoutController.php
│   │   └── ProductController.php
│   ...
resources/
├── views/
│   ├── admin/
│   │   └── orders/
│   │       ├── index.blade.php
│   │       └── show.blade.php
│   ├── cart/
│   │   └── index.blade.php
│   ├── checkout/
│   │   ├── index.blade.php
│   │   └── success.blade.php
│   ├── components/
│   │   └── store-layout.blade.php
│   ├── layouts/
│   │   └── store-navigation.blade.php
│   ├── products/
│   │   ├── create.blade.php
│   │   ├── edit.blade.php
│   │   ├── index.blade.php
│   │   └── show.blade.php
│   └── welcome.blade.php
...
```

---

## ⚙️ Installation & Setup

Follow these steps to set up the project locally on your machine.

### **1. Prerequisites**
Ensure you have the following installed on your local development system:
* **PHP >= 8.2**
* **Composer**
* **Node.js & npm**
* **MySQL** or **SQLite**

---

### **2. Clone & Install Dependencies**

Clone the repository and navigate into the project directory:

```bash
git clone <your-repository-url>
cd laravel-ecommerce
```

Install PHP dependencies using Composer:

```bash
composer install
```

Install JavaScript dependencies using NPM:

```bash
npm install
```

---

### **3. Environment Setup**

Create your environment configuration file:

```bash
cp .env.example .env
```

Generate the application encryption key:

```bash
php artisan key:generate
```

Configure your database connection inside `.env`:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laravel_ecommerce
DB_USERNAME=root
DB_PASSWORD=
```

---

### **4. Storage Link**

Create the symbolic link from `public/storage` to `storage/app/public` to make uploaded product images publicly accessible:

```bash
php artisan storage:link
```

---

### **5. Database Migration & Seeders**

Run database migrations to build the tables (`products`, `orders`, `order_items`, `users`) and seed the initial admin account:

```bash
php artisan migrate:fresh --seed
```

#### **Default Admin Credentials**
* **Email:** `admin@example.com`
* **Password:** `password`

---

### **6. Running the Application**

Start the backend development server:

```bash
php artisan serve
```

In a separate terminal window, start the frontend asset compiler:

```bash
npm run dev
```

Visit the application at [http://localhost:8000](http://localhost:8000).

---

## 🧪 Useful Commands

* Clear View Cache: `php artisan view:clear`
* Clear Route Cache: `php artisan route:clear`
* Build Production Assets: `npm run build`

---

## 📄 License
This project is open-source and created for educational purposes.
