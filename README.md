# 🛡️ Secure E-Commerce System (Assignment Software Security)

This README provides a comprehensive, step-by-step guide to setting up the **Secure Shop** project on a local machine using Laragon. Please follow each step carefully to ensure the security features and database work correctly.

---

## 📋 Prerequisites

Ensure you have the following installed. If you are using **Laragon (Full)**, most of these are already included:

* **Laragon** (Full version recommended) 


* **PHP 8.2+** 


* **MySQL** (Accessible via HeidiSQL) 


* **Composer** (PHP dependency manager) 


* **Node.js & NPM** (Required for compiling UI styles) 



---

## 🚀 Installation Steps

### Step 1: Project Setup

1. **Download and Extract**: Download the project ZIP and extract it into your Laragon `www` directory (typically `C:\laragon\www\secure-shop`). 


2. **Open in VS Code**: Open the `secure-shop` folder in VS Code. 

### Step 2: Install Backend Dependencies

1. Open the terminal in VS Code (`Ctrl + ` `).
2. Run the following command to install the Laravel framework and its libraries:
```bash
composer install

```

### Step 3: Install Frontend Dependencies

This step compiles the Tailwind CSS and Javascript assets:

1. Run the following commands:
```bash
npm install
npm run build

```

### Step 4: Configure the Environment (`.env`)

1. Locate the `.env.example` file in the root directory.
2. **Copy and Rename**: Create a copy and name it `.env`. 
3. **Update Database Settings**: Open the `.env` file and ensure these lines match your Laragon setup:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=secure_shop
DB_USERNAME=root
DB_PASSWORD=

```

4. **Update Stripe Settings**: Enter your Sandbox keys to test payments:
```env
STRIPE_KEY=pk_test_your_key_here
STRIPE_SECRET=sk_test_your_key_here

```

5. **Enable Local Email Logging**:
```env
MAIL_MAILER=log

```

### Step 5: Security & App Key

Run this command to generate a unique encryption key for your application:

```bash
php artisan key:generate

```

### Step 6: Setup the Database

1. **Create Database**: Open Laragon, click **Database** (HeidiSQL), right-click your connection, and create a new database named **`secure_shop`**. 


2. **Run Migrations**: Build the tables (users, products, orders, etc.) by running:
```bash
php artisan migrate

```

3. **Seed the Data (Crucial Step)**: To automatically add the default Admin, Test User, and Sample Products, run:
```bash
php artisan db:seed

```

*(Note: If you want to wipe everything and start fresh with data, use `php artisan migrate:fresh --seed`)*.

---

## 🏃‍♂️ How to Run

1. **Start the Server**:
```bash
php artisan serve

```

2. **Access the Site**: Open your browser and go to `http://127.0.0.1:8000`. 


---

## 🧪 Testing Features (For the Report)

### 1. Admin Access (RBAC)

* **Default Credentials**: Log in using `admin@secureshop.com` and password `admin123` (provided by the Seeder).
* **Manual Admin Creation**: If you register a new user, go to HeidiSQL -> `users` table -> Data tab, and change the `role` column from `user` to `admin`. 



### 2. Two-Factor Authentication (2FA) Protection

1. Go to your **Profile**. 


2. Click **Enable 2FA** and scan the QR code with **Google Authenticator**. 


3. Verify the code and re-login to test the extra security layer. 


### 3. Stripe Payment (PCI-DSS)

1. Add products to your cart and proceed to checkout. 


2. **Use Test Card**: `4242 4242 4242 4242`, CVC: `123`, Expiry: Any future date. 


### 4. Verification of Emails

* Check `storage/logs/laravel.log` at the very bottom to see the HTML content of the order confirmation emails. 

---

## 🛠 Troubleshooting

* **Vite manifest not found**: Ensure you ran `npm run build`. 


* **Table already exists**: Run `php artisan migrate:fresh --seed`. 


* **Stripe Error**: Restart your server (`Ctrl + C` then `php artisan serve`) after saving `.env` changes. 
