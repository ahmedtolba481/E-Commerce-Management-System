# E-Commerce Management System

A professional, fully responsive E-Commerce platform built with procedural PHP and MySQL. This system features a modern client-facing storefront with a premium, mint-green aesthetic and a comprehensive administrative dashboard for managing products, categories, orders, and users.

## Features

### Client-Side (Storefront)
- **Modern UI/UX**: Premium, glassmorphic and card-based responsive design featuring a distinct dark-mint color palette.
- **Product Catalog**: Browse products by category, view detailed product pages, and search for items.
- **Shopping Cart & Checkout**: Fully functional cart system (session-based) allowing users to add/remove items, review their basket, and proceed to checkout.
- **Dynamic Content**: Hero sliders, featured products, top brands, and partner showcases driven directly from the database.
- **Responsive Layout**: Designed to work seamlessly across mobile, tablet, and desktop devices.

### Admin-Side (Dashboard)
- **Secure Login Portal**: A high-end, modern login interface for administrators.
- **Inventory Management**: Create, read, update, and delete (CRUD) functionality for products, stock levels, and pricing.
- **Category & Brand Management**: Organize the store by managing product categories and top brands.
- **Order Tracking**: View customer orders, track statuses, and manage order items.
- **Team & Partner Management**: Update the "About Us" and "Team" sections directly from the backend.
- **Centralized Media**: All images are efficiently managed within a centralized `admin/assets/images` directory to prevent duplication and simplify path resolution.

## Tech Stack

- **Backend**: Procedural PHP (PHP 8+)
- **Database**: MySQL
- **Frontend**: HTML5, CSS3, JavaScript, Bootstrap Icons
- **Architecture**: Procedural approach tailored for university-level projects, maintaining simple, understandable, and modular code structures.

## Project Structure

```
E-Commerce-Management-System/
│
├── actions/            # Backend logic for processing forms (cart, checkout, etc.)
├── admin/              # Administrative dashboard and secure backend
│   ├── assets/         # Admin CSS, JS, and centralized images directory
│   ├── includes/       # Reusable admin components (sidebar, header, auth checks)
│   └── pages/          # Admin CRUD interfaces (products, categories, orders)
├── assets/             # Client-side CSS and JS (Images are centralized in admin/)
├── config/             # Database connection and configuration files
├── database/           # SQL schema exports and initial data dumps
├── includes/           # Reusable client components (navbar, footer, header)
├── pages/              # Client-facing pages (home, products, cart, checkout)
└── index.php           # Main entry point (redirects to storefront home)
```

## Setup & Installation

1. **Prerequisites**: Ensure you have a local server environment like XAMPP, WAMP, or MAMP installed.
2. **Clone the Repository**: Place the project folder into your web server's root directory (e.g., `C:\xampp\htdocs\`).
3. **Database Configuration**:
   - Open phpMyAdmin (or your preferred database client).
   - Create a new database (e.g., `ecommerce_db`).
   - Import the provided SQL file located in the `database/` folder.
   - Open `config/database.php` and update the database credentials (host, username, password, database name) to match your local setup.
4. **Run the Application**:
   - Access the storefront: `http://localhost/E-Commerce-Management-System/`
   - Access the admin panel: `http://localhost/E-Commerce-Management-System/admin/login.php`

## Recent Updates

- **Unified Asset Management**: All product, category, team, and brand images have been consolidated into the `admin/assets/images` folder for better maintenance.
- **Modernized Interface**: The entire system, from the admin dashboard to the client checkout page, now uses a cohesive, card-based design system with modern typography and styling.

## License

This project is licensed under the MIT License. See the `LICENSE` file for details.
