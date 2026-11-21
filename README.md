# Magasin – Online Store

A small online store where visitors can browse products by category and place orders, and an administrator manages the catalogue, clients and orders.

## Features

- **Categories:** products are split into clothes, electronics and books, each with its own listing page and product images.
- **Registration and login:** visitors create an account and log in. The session keeps them logged in until they log out.
- **Shopping cart:** a logged-in user can add products, increase quantities and remove items.
- **Checkout:** placing an order saves it, with all its lines, in the database and empties the cart.
- **Product management (admin):** add products with an image upload and category-specific fields (author and genre for books, size and gender for clothes), and delete products.
- **Client management (admin):** list and delete clients.
- **Order management (admin):** list and delete orders.
- **Info pages:** About us, Contact us and More.

## Tools used

- **PHP** (`mysqli`) – server-side logic and sessions
- **MySQL** – data storage
- **HTML and CSS** – pages and styling
- **Font Awesome** – icons
- **XAMPP** – local Apache, PHP and MySQL server

## Setup

1. Install [XAMPP](https://www.apachefriends.org/), then copy this folder into `htdocs` and start Apache and MySQL.
2. Import `database.sql` (phpMyAdmin: **Import** tab). It creates the `ecommerce` database, all its tables and an admin account.
3. Log in as `admin@magasin.com` with password `admin123`, then change it.
4. If your MySQL setup differs from the default (`root`, no password), edit `config.php`.
5. Open `http://localhost/<folder-name>/index.php`.


## to access website enter http://localhost/online-store/index.php

## Author

Mohamed Aziz Trabelsi – Computer Science student, ISI Ariana
