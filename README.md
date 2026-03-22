# VNT Hotel Management System

VNT Hotel Management System is a full-stack hotel operations web application built with Laravel 9, PHP 8, Blade, and MySQL. It combines a customer-facing booking website with an internal back-office workspace for hotel staff, covering reservations, room inventory, guest records, service sales, invoicing, and contact management.

For recruiters, this repository demonstrates more than basic CRUD. The project implements real business workflows such as reservation validation, room availability checks, check-in/check-out operations, dynamic pricing, and invoice generation inside a practical server-rendered application.

## Recruiter Snapshot

- End-to-end booking flow from customer reservation to staff checkout
- Separate admin and customer authentication flows using Laravel guards and middleware
- Overbooking prevention based on room-type inventory and overlapping booking windows
- Cashier workflow for room status tracking, service add-ons, and payment handling
- Relational database design covering rooms, room types, floors, bookings, invoices, customers, admins, services, and contact messages

## Main Features

### Customer-facing features

- Public hotel landing page with room and service presentation
- Customer login and booking history
- Reservation form with check-in/check-out datetime selection
- Capacity validation based on room type
- Contact form with messages stored for staff review

### Back-office features

- Admin dashboard with operational summary metrics
- Room, room type, floor, service, customer, and admin management
- Booking review and confirmation workflow
- Cashier interface for live room status, check-in, checkout, and service charges
- Invoice management with payment status updates
- Booking and contact-message notification endpoints for admin monitoring

### Business logic highlights

- Room availability is calculated by comparing overlapping reservations against the actual number of rooms available for a room type
- Checkout supports hourly, overnight, and daily pricing rules
- Service items can be added during checkout and rolled into the final invoice
- Staff can process walk-in guests as well as reserved bookings

## Tech Stack

- Backend: PHP 8, Laravel 9
- Frontend: Blade templates, Bootstrap, custom CSS, vanilla JavaScript, Vite
- Database: MySQL / MariaDB
- Libraries: Guzzle, Laravel Sanctum, PHP Flasher
- Application style: MVC, server-rendered views, session-based authentication

## Project Modules

- Public website: hotel homepage, reservation form, contact section
- Customer area: login, reservation history, booking cancellation
- Admin area: dashboard, rooms, room types, floors, services, customers, admins
- Operations: booking confirmation, cashier workflow, invoice handling
- Messaging: contact inbox and booking/message notifications

## Run Locally

### Prerequisites

- PHP 8+
- Composer
- Node.js and npm
- MySQL or MariaDB
- XAMPP or an equivalent local PHP/MySQL environment

### Setup

1. Install PHP dependencies:

```bash
composer install
```

2. Install frontend dependencies:

```bash
npm install
```

3. Create the environment file and application key:

```bash
copy .env.example .env
php artisan key:generate
```

4. Configure the database in `.env`.

Recommended local database values:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=vnt_hotel
DB_USERNAME=root
DB_PASSWORD=
```

5. Create a database named `vnt_hotel`.

6. Import `database/vnt_hotel.sql` into the `vnt_hotel` database with phpMyAdmin or the MySQL CLI.

The SQL dump is the fastest way to reproduce the current demo data and schema. The repository also includes Laravel migrations and seeders for core entities.

7. Start the application:

```bash
php artisan serve
npm run dev
```

8. Open the project in your browser:

- Public site: `http://127.0.0.1:8000/home`
- Admin login: `http://127.0.0.1:8000/login-admin`
- Customer login: `http://127.0.0.1:8000/login-customer`

## What This Project Demonstrates

- Building a complete business workflow, not just isolated CRUD pages
- Translating hotel operations into application rules and database relationships
- Handling multiple user roles in a Laravel application
- Designing practical internal tools for staff operations
- Combining product-facing pages and operational dashboards in one codebase

## Notes

- The UI content is primarily tailored to a Vietnamese hotel context, while this README is written in English for technical review
- The included SQL dump contains sample data that makes the project easier to review locally
- PHPUnit scaffolding is present, but automated test coverage is still limited

## Repository Entry Points

- Main routes: `routes/web.php`
- Controllers: `app/Http/Controllers`
- Views: `resources/views`
- Database dump: `database/vnt_hotel.sql`
