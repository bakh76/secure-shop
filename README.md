Secure E-Commerce System (Assignment 2)

This README guides you through setting up the Secure Shop project on your local machine using Laragon.

📋 Prerequisites

Ensure you have the following installed (Laragon includes most of these):

Laragon (Full version recommended).

PHP 8.2+ (Included in Laragon).

MySQL (Included in Laragon).

Composer (Included in Laragon).

Node.js & NPM (Required for the UI styles).

🚀 Installation Steps

Step 1: Download the Project

Download the project ZIP file provided.

Extract the folder into your Laragon www directory (e.g., C:\laragon\www\secure-shop).

Open the folder in VS Code.

Step 2: Install Backend Dependencies
Open the terminal in VS Code (Ctrl+`) and run:

composer install


Step 3: Install Frontend Dependencies
This builds the design (Tailwind CSS):

npm install
npm run build


Step 4: Configure Environment (.env)

In the project folder, look for a file named .env.example.

Copy and paste it, then rename the copy to .env.

Open .env and update the following settings:

Database Settings:

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=secure_shop
DB_USERNAME=root
DB_PASSWORD=


Stripe Payment Settings (Sandbox):
Ask the project lead for these keys or generate new ones at dashboard.stripe.com/test/apikeys

STRIPE_KEY=pk_test_your_key_here
STRIPE_SECRET=sk_test_your_key_here


Email Settings (For Local Testing):
This ensures emails are saved to a log file instead of failing.

MAIL_MAILER=log


Step 5: Generate App Key
Run this command to secure the app:

php artisan key:generate


Step 6: Setup the Database

Open Laragon -> Click Database (HeidiSQL).

Right-click your connection -> Create new -> Database.

Name it: secure_shop.

Back in your VS Code terminal, run the migrations to create tables:

php artisan migrate


(If you encounter errors, run php artisan migrate:fresh to restart cleanly).

🏃‍♂️ How to Run

Start the server:

php artisan serve


Open your browser and go to: http://127.0.0.1:8000

🧪 How to Test (For the Report)

1. Creating an Admin Account (RBAC)

Since there is no "Admin Registration" page (for security), follow these steps:

Go to the website and Register a new account normally (e.g., admin@test.com).

Open HeidiSQL (Database).

Go to the users table -> Data tab.

Find your user and change the role column from user to admin.

Refresh the page. You can now access the Admin Dashboard and Manage Products.

2. Testing 2FA (Two-Factor Authentication)

Go to Profile.

Click Enable 2FA.

Use the Google Authenticator App on your phone to scan the QR code.

Enter the code to verify.

Logout and Login again to test the protection.

3. Testing Payment (Stripe PCI-DSS)

Log in as a User.

Add products to your Cart.

Proceed to Checkout.

Use the following Test Credit Card numbers (Stripe Sandbox):

Card Number: 4242 4242 4242 4242

MM/YY: Any future date (e.g., 12/30)

CVC: Any 3 digits (e.g., 123)

ZIP: Any valid zip (e.g., 12345)

4. Viewing Confirmation Emails

Since we are offline, emails are saved to a file.

Complete an Order.

Go to the project folder: storage/logs/laravel.log.

Scroll to the bottom. You will see the HTML code of the email receipt.

🛠 Troubleshooting

Error: "Vite manifest not found"

Run: npm run build

Error: "Table 'order_items' already exists"

Run: php artisan migrate:fresh (Warning: Deletes all data)

Stripe Error during Checkout

Make sure your .env file has the correct STRIPE_KEY and STRIPE_SECRET and you have restarted the server (Ctrl+C then php artisan serve) after saving the .env file.