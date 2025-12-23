# 🛡️ Secure E-Commerce System (Software Security Assignment)

This repository contains a secure Laravel-based e-commerce platform. This guide provides step-by-step instructions to set up the project locally using **Laragon** and **HeidiSQL**.

## 📋 Prerequisites

Before starting, ensure your local environment (Laragon) is running the following:

* **PHP 8.2+**
* **MySQL** (via HeidiSQL)
* **Composer**
* **Node.js & NPM** (for frontend assets)

---

## 🚀 Installation Steps

### Step 1: Project Setup

1. Extract your project ZIP into your Laragon `www` directory: `C:\laragon\www\secure-shop`.
2. Open the folder in **VS Code**.

### Step 2: Install Dependencies

Run the following commands in the VS Code terminal to install backend and frontend requirements:

```bash
# Install PHP packages
composer install

# Install and build UI assets (Tailwind CSS/Vite)
npm install
npm run build

```

### Step 3: Environment Configuration (`.env`)

1. Locate `.env.example` in the root folder and rename it to `.env`.
2. Open the `.env` file and verify/update these settings:


* 
**Database**: Set `DB_DATABASE=secure_shop`.


* 
**Stripe**: Ensure `STRIPE_KEY` and `STRIPE_SECRET` are populated with your sandbox keys.


* 
**Mail**: Set `MAIL_MAILER=log` to test emails without a real mail server.





### Step 4: Security & Database Initialization

Secure the application and build your database tables:

1. **Generate App Key**:
```bash
php artisan key:generate

```


2. 
**Create Database**: Open HeidiSQL, right-click your connection, and create a new database named **`secure_shop`**.


3. **Run Migrations**:
```bash
php artisan migrate

```



---

## 🏃‍♂️ How to Run

1. In your terminal, start the local development server:
```bash
php artisan serve

```


2. Navigate to [http://127.0.0.1:8000](http://127.0.0.1:8000) in your web browser.

---

## 🧪 Testing Procedures

### 1. Role-Based Access Control (RBAC)

To create an Admin account manually:

* Register a standard user account on the website.
* Open **HeidiSQL** and navigate to the `users` table.
* Locate your user and change the `role` column value from `user` to **`admin`**.
* Refresh the site to access the **Admin Dashboard**.

### 2. Two-Factor Authentication (2FA)

* Go to your **Profile** and click **Enable 2FA**.
* Scan the generated QR code with **Google Authenticator**.
* Verify the code to protect your login.

### 3. Payment Processing (PCI-DSS Compliance)

Use Stripe’s official test card for sandbox transactions:

* **Card Number**: `4242 4242 4242 4242`
* **CVC**: `123` | **Expiry**: Any future date.

### 4. Viewing Order Emails

Since the mailer is set to `log`, view sent receipts here:

* Path: `storage/logs/laravel.log`

---

## 🛠 Troubleshooting

* **Vite manifest not found**: Run `npm run build`.
* **Database errors**: Run `php artisan migrate:fresh` to reset the database (Warning: This erases existing data).
