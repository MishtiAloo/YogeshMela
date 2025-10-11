# `⚡Features`

## Core Features (MVP)

These are essential to make the system usable.

- **User Registration & Login**

  - Separate roles: Buyer, Seller, Admin
  - Profile management (name, contact info, address)

- **Animal Listings**

  - Sellers can post animals (cow, goat, sheep, camel, etc.)
  - Each listing includes: images, type, breed, age, weight, price, location, vaccination info

- **Filters**

  - Filter by type, breed, weight range, price range, city/location

- **Buy Request**

  - Buyers can purchase an animal
  - Real-time stock status (available / sold)

- **Admin Panel**

  - Manage listings, orders and deliveries + butchers
  - Approve or reject listings

---

## Marketplace & Transaction Features

These make the system function like a real marketplace.

- **Online Payment Integration**

  - Support for payment
  - Partial payment or full payment options

- **Order Management**

  - Order confirmation, invoice generation
  - Delivery/pickup scheduling

---

## Service Features

These will enhance user trust and convenience.

- **Delivery Service**

  - delivery charges

- **Butcher Service**

  - Schedule slaughter and meat delivery

---

## Trust Features

These help build trust between buyers and sellers.

- **Verification Badge**

  - Verified sellers get a badge to build trust

---

## Extras

Useful for admins and to improve the business.

- **Promotions & Featured Listings**

  - Sellers can pay to promote their animals to top of the list (Only verified sellers)

---

<br><br><br><br>

# `⚡Entity Specific Feature`

## Buyer Features

**Main goal:** Browse, filter, and purchase animals easily and safely.

- **Account Management**

  - Register/login as buyer
  - Manage profile (name, phone, address)

- **Animal Browsing**

  - View all active listings with images and details
  - Use filters (type, breed, weight, price range, city/location)
  - See seller profile (contact info, verification badge)

- **Buy Request / Order**

  - Request to buy or directly purchase an animal
  - Select delivery and butcher services (optional)
  - Choose payment method (partial/full payment)

- **Order Tracking**

  - View order status (pending, confirmed, delivered)
  - View delivery schedule if chosen

- **Other**

  - View promotions and featured listings

---

## Seller Features

**Main goal:** Post animals and manage orders.

- **Account Management**

  - Register/login as seller
  - Manage profile and store details (address, contact, logo/photo)

- **Listing Management**

  - Add new animal listing (images, type, breed, age, weight, price, location, vaccination info)
  - Edit or remove listings
  - Mark an animal as sold

- **Order Handling**

  - Receive buy requests and confirm or reject them
  - Manage delivery and butcher service coordination

- **Payment & Promotions**

  - Receive payments from buyers
  - Option to pay for promoting listings (only if verified)

- **Verification**

  - Submit documents for admin approval to get verification badge

- **Other**

  - View sales history and earnings

---

## Admin Features

**Main goal:** Oversee the platform, ensure trust and smooth operation.

- **User Management**

  - Approve or ban buyers/sellers
  - Verify sellers and assign verification badges

- **Listing Management**

  - Approve or reject new animal listings
  - Remove inappropriate or fraudulent listings

- **Order Management**

  - View and track all orders
  - Manage delivery and butcher service providers

- **Payments & Promotions**

  - Approve paid promotions for listings

<br><br><br><br>

# `⚡Tables Overview`

1. `users`
2. `listings`
3. `orders`
4. `payments`
5. `deliveries`
6. `butchers`
7. `promotions`

---

## 1. `users`

| Column     | Type                                                        | Notes                     |
| ---------- | ----------------------------------------------------------- | ------------------------- |
| id         | bigIncrements                                               | PK                        |
| name       | string                                                      |                           |
| email      | string, unique                                              |                           |
| password   | string                                                      | hashed                    |
| phone      | string, nullable                                            |                           |
| address    | string, nullable                                            |                           |
| role       | enum('buyer', 'seller', 'admin', 'butcher', 'delivery_man') |                           |
| verified   | boolean (default false)                                     | seller verification badge |
| created_at | timestamps                                                  |                           |

> All buyers, sellers, and admins are here; `role` distinguishes them.

---

## 2. `listings`

| Column                 | Type                                         | Notes                   |
| ---------------------- | -------------------------------------------- | ----------------------- |
| id                     | bigIncrements                                | PK                      |
| user_id                | foreignId                                    | FK → users(id) (seller) |
| animal_type            | enum('cow','goat','sheep','camel')           |                         |
| breed                  | string                                       |                         |
| age                    | integer                                      | months                  |
| weight                 | decimal(5,2)                                 | in kg                   |
| price                  | decimal(10,2)                                |                         |
| location               | string                                       |                         |
| vaccination_info       | text, nullable                               |                         |
| status                 | enum('available','sold') default 'available' |                         |
| created_at, updated_at | timestamps                                   |                         |

---

## 3. `orders`

| Column                 | Type                                              | Notes             |
| ---------------------- | ------------------------------------------------- | ----------------- |
| id                     | bigIncrements                                     | PK                |
| buyer_id               | foreignId                                         | FK → users(id)    |
| listing_id             | foreignId                                         | FK → listings(id) |
| quantity               | integer default 1                                 | Usually 1 animal  |
| butcher_service        | boolean default false                             |                   |
| delivery_service       | boolean default false                             |                   |
| status                 | enum('confirmed','delivered') default 'confirmed' |                   |
| created_at, updated_at | timestamps                                        |                   |

> Each order is tied to **one animal listing** and **one buyer**.

---

## 4. `deliveries`

| Column           | Type                                                           | Notes           |
| ---------------- | -------------------------------------------------------------- | --------------- |
| id               | bigIncrements                                                  | PK              |
| order_id         | foreignId                                                      | FK → orders(id) |
| delivery_man_id  | foreignId                                                      | FK → users(id)  |
| delivery_date    | date                                                           |                 |
| delivery_address | string                                                         |                 |
| charge           | decimal(10,2)                                                  |                 |
| status           | enum('scheduled','in_transit','delivered') default 'scheduled' |                 |
| created_at       | timestamps                                                     |                 |

---

## 5. `butcher_orders`

| Column         | Type                                              | Notes           |
| -------------- | ------------------------------------------------- | --------------- |
| id             | bigIncrements                                     | PK              |
| order_id       | foreignId                                         | FK → orders(id) |
| butcher_id     | foreignId                                         | FK → users(id)  |
| scheduled_date | date                                              |                 |
| charge         | decimal(10,2)                                     |                 |
| status         | enum('scheduled','completed') default 'scheduled' |                 |
| created_at     | timestamps                                        |                 |

---

## 6. `promotions`

| Column           | Type          | Notes             |
| ---------------- | ------------- | ----------------- |
| id               | bigIncrements | PK                |
| listing_id       | foreignId     | FK → listings(id) |
| amount_paid      | decimal(10,2) |                   |
| fixed_discount   | decimal(10,2) | nullable          |
| percent_discount | decimal(10,2) | nullable          |
| start_date       | date          |                   |
| end_date         | date          |                   |
| created_at       | timestamps    |                   |

> Only **verified sellers** will be allowed to create promotions in app logic (not schema level).

## ⚡ Relationships in Eloquent

- `User hasMany Listings`
- `User hasMany Orders` (as buyer)
- `Listing belongsTo User`
- `Order belongsTo User` and `Order belongsTo Listing`
- `Order hasOneOrZero Delivery`, `Order hasOneOrZero Butcher`
