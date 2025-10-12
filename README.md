# YogeshMela — Laravel Livestock Marketplace

YogeshMela is a Laravel-based marketplace where verified sellers post animal listings and buyers can browse, filter, and purchase with optional delivery and butcher services. Admins verify sellers, manage promotions, and oversee operations. The project follows clean MVC architecture, normalized schema, and comprehensive documentation to support rapid iteration and maintainability.

---

## Table of Contents

-   [YogeshMela — Laravel Livestock Marketplace](#yogeshmela--laravel-livestock-marketplace)
    -   [Table of Contents](#table-of-contents)
    -   [Overview](#overview)
    -   [Features](#features)
    -   [Tech Stack](#tech-stack)
    -   [Project Structure](#project-structure)
    -   [Getting Started (Windows)](#getting-started-windows)
    -   [Database and Seeding](#database-and-seeding)
    -   [Running and Building](#running-and-building)
    -   [Roles and Access](#roles-and-access)
    -   [Documentation](#documentation)
    -   [Testing](#testing)
    -   [Common Tasks](#common-tasks)
    -   [Troubleshooting](#troubleshooting)
    -   [Roadmap](#roadmap)

---

## Overview

The platform emphasizes trust and convenience:

-   **Buyers**: Browse listings, filter by attributes, and place orders.
-   **Sellers**: Create, edit, and manage listings; request promotions.
-   **Admins**: Verify sellers, approve promotions, and monitor activities.

**Core domain entities**:

-   Users, Listings, Orders, Deliveries, Butcher Orders, Promotions, Carts, Sessions

See `Documentations/Report/Goru.md` for consolidated domain notes.

---

## Features

-   **Authentication & Profiles**: Registration, login, profile management.
-   **Roles**: Buyer, Seller, Admin, plus optional service roles (Butcher, Delivery).
-   **Listings**:

    -   Attributes: animal type, breed, age, weight, price, location, vaccination.
    -   Create, edit, and view listings.
    -   Browse and filter for buyers.

-   **Orders**:

    -   Place orders for listings.
    -   Optional services: Delivery & Butcher (admin approval required).
    -   Status lifecycle up to `delivered`.

-   **Promotions**:

    -   Sellers attach promotions to listings.
    -   Admin approves or denies promotions.

-   **Dashboards**: Role-specific summaries and actions.
-   **Cart & Checkout**: Basic cart functionality and checkout scaffold.
-   **Documentation**: Activity, Class, ERD, DFD, Sequence, Use Case, and Gantt diagrams in `Documentations/`.

---

## Tech Stack

-   **Backend**: Laravel (PHP) MVC, Eloquent ORM, Blade templating
-   **Database**: MySQL / MariaDB (or compatible), managed via Laravel migrations
-   **Frontend**: Vite, Node.js, npm for asset building
-   **Testing & Data**: Seeders and Factories for demo and test data

---

## Project Structure

-   **app/**: Controllers, Models, Middleware
-   **resources/views/**: Blade templates for home, listings, dashboards, authentication, cart, checkout
-   **resources/js & resources/css**: Vite-managed assets
-   **database/**: migrations, seeders, factories
-   **routes/**: web and API route definitions
-   **Documentations/**: UML diagrams, reports, domain notes

---

## Getting Started (Windows)

**Prerequisites**:

-   PHP 8.2+ (Laravel Herd or XAMPP/WAMP)
-   Composer
-   Node.js 18+ and npm
-   MySQL/MariaDB or PostgreSQL

**Setup**:

```bash
# Clone repository
git clone <repo-url>

# Navigate into project
cd yogeshmela

# Setup environment
copy .env.example .env
php artisan key:generate

# Configure database in .env
# DB_CONNECTION=mysql
# DB_HOST=127.0.0.1
# DB_PORT=3306
# DB_DATABASE=yogeshmela
# DB_USERNAME=<user>
# DB_PASSWORD=<pass>

# Install dependencies
composer install
npm install
```

---

## Database and Seeding

-   Run migrations and seeders:

```bash
php artisan migrate --seed
```

-   **Tables created**: users, listings, orders, deliveries, butcher_orders, promotions, sessions, carts, cache, jobs
-   **Seeded demo data**: Check `database/seeders/*.php`

---

## Running and Building

-   **Start local server**:

```bash
php artisan serve
```

Open [http://127.0.0.1:8000](http://127.0.0.1:8000)

-   **Assets**:

    -   Development: `npm run dev`
    -   Production: `npm run build`

-   **Optional queues**:

```bash
php artisan queue:table
php artisan queue:work
```

---

## Roles and Access

-   **Buyer**: Browse, add to cart, place orders, view dashboard
-   **Seller**: Manage listings, request promotions, mark orders delivered
-   **Admin**: Verify sellers, approve promotions, review dashboards

Middleware ensures route and action protection per role.

---

## Documentation

All diagrams and planning artifacts are in `Documentations/`:

-   **Activity**: High-level user flows (login, registration, order lifecycle, dashboards, promotions)
-   **Class**: Domain class structure
-   **ERD**: Tables, keys, cardinalities
-   **DFD**: Context-level, Level 0 (processes), Level 1 (subprocesses with DB)
-   **Sequence**: MVC interactions and entity lifecycles
-   **UseCase**: Actors and system interactions
-   **Gantt**: Project phases, milestones
-   **Report/Goru.md**: Domain goals, features, notes

---

## Testing

-   Run Laravel tests:

```bash
php artisan test
```

-   Test focus areas:

    -   Authentication
    -   Listing filters and pagination
    -   Order creation and lifecycle
    -   Optional services and admin approvals
    -   Seller verification and promotion workflow
    -   Role-based dashboard access

---

## Common Tasks

-   **Generate model + migration + factory**:

```bash
php artisan make:model Listing -m -f
```

-   **Create controller**:

```bash
php artisan make:controller ListingController --resource
```

-   **Seeder**:

```bash
php artisan make:seeder ListingSeeder
php artisan db:seed --class=ListingSeeder
```

-   **Cache & optimization**:

```bash
php artisan optimize:clear
```

---

## Troubleshooting

-   **Blank pages / 500 errors**: Check `APP_KEY` and DB credentials
-   **CSS / JS not loading**: Run `npm run dev` or `npm run build`; verify `@vite` tags
-   **Foreign key issues**: Verify migration order
-   **Seeded credentials**: Inspect `UserSeeder.php`
-   **Sessions not persisting**: Check `SESSION_DRIVER` and sessions table

---

## Roadmap

Future improvements:

-   Payments and reconciliation
-   Notifications (email, SMS, in-app)
-   Seller ratings and reviews
-   Coupons, promotions, and analytics
-   Buyer-seller chat with moderation
-   Reporting dashboards and CSV export
-   Internationalization and accessibility
-   Image optimization
