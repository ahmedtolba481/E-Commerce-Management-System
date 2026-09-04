<div align="center">
  <img src="https://img.shields.io/badge/PHP-777BB4?style=for-the-badge&logo=php&logoColor=white" />
  <img src="https://img.shields.io/badge/MySQL-005C84?style=for-the-badge&logo=mysql&logoColor=white" />
  <img src="https://img.shields.io/badge/HTML5-E34F26?style=for-the-badge&logo=html5&logoColor=white" />
  <img src="https://img.shields.io/badge/CSS3-1572B6?style=for-the-badge&logo=css3&logoColor=white" />
  <img src="https://img.shields.io/badge/Bootstrap_Icons-563D7C?style=for-the-badge&logo=bootstrap&logoColor=white" />

<br><br>

  <h1 align="center">🛍️ E-Commerce Management System</h1>
  
  <p align="center">
    <strong>A professional, modern, and fully responsive E-Commerce platform featuring a stunning Mint-Green UI.</strong>
  </p>

  <img src="admin/assets/images/slider/slide1.jpg" alt="ShopEase tech and gadgets storefront banner" width="720" />
</div>

<hr>

## Features

### 🛒 Client storefront

- Browse products, categories, brands, and product details
- Add products to a session-based shopping cart
- Register and sign in as a client
- Manage profile information and delivery details
- Place orders, review order history, and cancel eligible orders

### 🧰 Staff portal

Staff members use the management portal to support daily store operations. Depending on the page, staff can view the dashboard, products, clients, and orders; review order items; manage inventory, categories, brands, partners, and team information.

Staff accounts cannot access administrator-only user management and other restricted actions.

### 🛡️ Administrator portal

Administrators have full management access, including everything available to staff plus:

- Create, edit, and delete users
- Assign the `Admin`, `Staff`, or `Client` role
- Manage all catalog, order, client, team, and partner records
- Monitor inventory, revenue, orders, and registered users

## 👥 User roles

| Role     | Main access                                                     | Login location          |
| -------- | --------------------------------------------------------------- | ----------------------- |
| `Client` | Storefront, cart, checkout, profile, and personal orders        | `/pages/auth/login.php` |
| `Staff`  | Store management and operational dashboard pages                | `/admin/login.php`      |
| `Admin`  | Full dashboard access, including user and permission management | `/admin/login.php`      |

The role is stored in the `users.role` column. New public registrations are created as `Client` accounts. Staff and administrator accounts should be created by an administrator or inserted into the database by a trusted developer.

## Technology

- PHP 8 or newer
- MySQL or MariaDB
- HTML5, CSS3, and Vanilla JavaScript
- Bootstrap Icons
- XAMPP, WAMP, MAMP, or another Apache/PHP environment

## Project Structure

```text
E-Commerce-Management-System/
├── actions/          # Form handlers for authentication, cart, checkout, orders, and profile
├── admin/            # Staff and administrator portal
│   ├── includes/     # Dashboard authentication and shared layout files
│   ├── pages/        # Catalog, client, order, team, partner, and user management
│   └── assets/       # Admin styles, scripts, and uploaded images
├── assets/           # Storefront styles and JavaScript
├── config/           # Database connection
├── database/         # Database schema and seed data
├── includes/         # Shared storefront header, navigation, and footer
├── pages/            # Storefront, authentication, cart, checkout, and account pages
└── index.php         # Storefront entry point
```

## Installation

1. Install and start Apache and MySQL in XAMPP.
2. Copy the project into the web root, for example:

```text
C:\xampp\htdocs\E-Commerce-Management-System
```

3. Open `http://localhost/phpmyadmin` and create a database named `ecommerce`.
4. Import `database/ecommerce.sql`.
5. Optionally import `database/seed.sql` to add sample users, products, categories, brands, and other data.
6. Check `config/database.php` and update the host, database name, username, and password for your local MySQL installation.
7. Open the application:

- Storefront: `http://localhost/E-Commerce-Management-System/`
- Client login: `http://localhost/E-Commerce-Management-System/pages/auth/login.php`
- Staff and admin login: `http://localhost/E-Commerce-Management-System/admin/login.php`

## Demo accounts

The accounts in `database/seed.sql` use the development password `ChangeMe123!`:

| Role   | Email                 |
| ------ | --------------------- |
| Admin  | `admin@example.com`   |
| Client | `ahmed@example.com`   |
| Client | `mohamed@example.com` |
| Client | `sara@example.com`    |

The seed file does not currently include a `Staff` account. To test the staff portal, create a user with `role = 'Staff'` through the administrator user page or directly in the database, using a securely generated password hash.

Change all development passwords before using the application outside a local test environment.

## Database overview

- `users`: login identities and role assignments
- `clients`: client contact and delivery information
- `products`, `categories`, and `brands`: product catalog
- `orders` and `order_items`: purchases and their products
- `team` and `partners`: storefront content managed from the portal

## Security notes

- Use HTTPS in production.
- Store a strong, unique password for every account.
- Do not commit production credentials or uploaded files containing sensitive information.
- Review permissions before assigning the `Admin` role.
