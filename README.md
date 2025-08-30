Laravel E-Commerce Assessment
Project Overview

This Laravel web application demonstrates:

Multi-authentication system (Admin & Customer)

Real-time updates using Websockets

Web push notifications

Efficient large-scale product import using Laravel queues and batch processing

This is a backend-focused project. The UI is minimal using Blade and TailwindCSS.

Features
1. Multi-Authentication

Separate login & registration for Admin and Customer.

Dashboards for each user type.

Route protection via middleware: auth:admin & auth:customer.

2. Product Management

Admin:

CRUD operations for products (name, description, price, image, category, stock).

Bulk import of up to 100,000 products via CSV using chunked processing and queues.

Default image used if CSV does not provide one.

Customer:

Browse, search, and paginate products.

3. Order Management

Customer:

Place orders for available products.

Admin:

View and update order status (Pending, Shipped, Delivered).

Real-time order updates broadcast via Websockets.

4. Real-Time Updates

Live online/offline presence of users in dashboard.

Real-time order status updates using Laravel Websockets.

Instant updates, no polling required.

5. Web Push Notifications

Customers receive browser push notifications when Admin updates order status.

Works instantly via Websockets.

6. Optimized Product Import

Supports CSV/Excel files up to 100k rows.

Chunked processing and queue jobs prevent timeouts.

Row validation ensures correct data before saving.

Installation & Setup
1. Clone the repository
git clone <your-repo-url> laravel-assessment
cd laravel-assessment

2. Install PHP dependencies
composer install

3. Install Node dependencies & build assets
npm install
npm run build

4. Configure environment
cp .env.example .env


Update .env:

Database credentials

BROADCAST_DRIVER=pusher or websockets

QUEUE_CONNECTION=database

VITE_PUSHER_APP_KEY, VITE_PUSHER_APP_CLUSTER if using Pusher

5. Generate application key
php artisan key:generate

6. Run migrations and seeders
php artisan migrate --seed

7. Start queue worker
php artisan queue:work

8. Start Websockets server
php artisan websockets:serve

9. Serve the application
php artisan serve


Admin: http://127.0.0.1:8000/admin/login
Customer : http://127.0.0.1:8000/customer/login
if any user not exis in users table you need to register for admin first time 
http://127.0.0.1:8000/admin/register
Sample CSV

Path: database/products_sample_import.csv

Columns: name, description, price, stock, category, image_url

Leave image_url blank to use default image.

Used for testing bulk product import.

Testing

Run Laravel tests:

php artisan test


Tests included:

Admin order status update

Customer order placement

Bulk product import logic

Unit tests for core functionalities

Git Branch Guide

Create a new branch for submission:

git checkout -b laravel-assessment


Add all files:

git add .
git commit -m "Complete Laravel Assessment with all features"


Push branch to GitHub:

git push origin laravel-assessment

Notes

Default product image is used if none provided.

Queues and Websockets are required for import and notifications.

Backend-focused: UI is simple but functional.

Clear commit history recommended to demonstrate step-by-step development.

✅ This README now covers installation, running, testing, features, queues, websockets, CSV, and git workflow.