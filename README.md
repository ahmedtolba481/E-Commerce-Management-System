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
</div>

<hr>

## ✨ Highlights

- 🌟 **Premium Mint-Green Aesthetic**: A unique, glassmorphic design that immediately captivates users.
- 🛡️ **Secure Admin Dashboard**: Complete administrative control with a sleek backend management system.
- ⚡ **Lightweight & Fast**: Built with procedural PHP without bloated frameworks—perfect for high-performance and university-level projects.
- 📱 **Fully Responsive**: Flawless experience across mobile, tablet, and desktop viewports.

---

## 🚀 Features

### 🛒 Client-Side (Storefront)
| Feature | Description |
| :--- | :--- |
| 🎨 **Modern UI/UX** | Premium, card-based responsive design featuring a distinct dark-mint color palette. |
| 📦 **Product Catalog** | Browse products by category, view detailed product pages, and search. |
| 🛍️ **Cart & Checkout** | Session-based cart system allowing users to manage their basket and checkout. |
| 🎬 **Dynamic Content** | Database-driven hero sliders, featured products, top brands, and partner showcases. |

### 🛠️ Admin-Side (Dashboard)
| Feature | Description |
| :--- | :--- |
| 🔐 **Secure Login** | High-end, modern login interface for administrators with error handling. |
| 📊 **Inventory System** | Full CRUD functionality for products, stock levels, and pricing. |
| 🏷️ **Categories & Brands** | Organize the store perfectly by managing product categories and brands. |
| 📦 **Order Tracking** | View customer orders, track statuses, and manage items effortlessly. |
| 👥 **Team Management** | Update the "About Us", "Partners", and "Team" sections directly from the backend. |
| 🖼️ **Centralized Media** | All images are managed within a single `admin/assets/images` directory to avoid duplication. |

---

## 💻 Tech Stack

- <img src="https://raw.githubusercontent.com/devicons/devicon/master/icons/php/php-original.svg" alt="php" width="20" height="20"/> **Backend**: Procedural PHP (PHP 8+)
- <img src="https://raw.githubusercontent.com/devicons/devicon/master/icons/mysql/mysql-original.svg" alt="mysql" width="20" height="20"/> **Database**: MySQL
- <img src="https://raw.githubusercontent.com/devicons/devicon/master/icons/html5/html5-original.svg" alt="html5" width="20" height="20"/> **Frontend**: HTML5, CSS3, Vanilla JS
- <img src="https://raw.githubusercontent.com/devicons/devicon/master/icons/bootstrap/bootstrap-original.svg" alt="bootstrap" width="20" height="20"/> **Icons**: Bootstrap Icons
- 📐 **Architecture**: Custom Procedural Pattern

---

## 📂 Project Structure

```text
E-Commerce-Management-System/
├── ⚙️ actions/          # Backend logic for processing forms (cart, checkout)
├── 🛡️ admin/            # Administrative dashboard and secure backend
│   ├── 📁 assets/       # Admin CSS, JS, and centralized images directory
│   ├── 🧩 includes/     # Reusable admin components (sidebar, header, auth)
│   └── 📄 pages/        # Admin CRUD interfaces (products, categories, orders)
├── 🎨 assets/           # Client-side CSS and JS
├── 🔌 config/           # Database connection and configuration files
├── 🗄️ database/         # SQL schema exports and initial data dumps
├── 🧩 includes/         # Reusable client components (navbar, footer, header)
├── 📄 pages/            # Client-facing pages (home, products, cart, checkout)
└── 🚀 index.php         # Main entry point (redirects to storefront home)
```

---

## 🛠️ Setup & Installation

Follow these simple steps to get the project running locally on your machine:

1. **Install a Local Server Environment**: Ensure you have <a href="https://www.apachefriends.org/">XAMPP</a>, WAMP, or MAMP installed.
2. **Clone the Repository**: Place the project folder into your web server's root directory (e.g., `C:\xampp\htdocs\E-Commerce-Management-System`).
3. **Database Configuration**:
   - Open **phpMyAdmin** (`http://localhost/phpmyadmin`).
   - Create a new database (e.g., `ecommerce_db`).
   - Import the provided SQL file located in the `database/` folder.
   - Open `config/database.php` and update the database credentials (`host`, `username`, `password`, `database`) to match your local setup.
4. **Run the Application**:
   - 🏬 **Storefront**: [http://localhost/E-Commerce-Management-System/](http://localhost/E-Commerce-Management-System/)
   - 🔒 **Admin Panel**: [http://localhost/E-Commerce-Management-System/admin/login.php](http://localhost/E-Commerce-Management-System/admin/login.php)

---

<div align="center">
  <p>Built with ❤️ for a modern web experience.</p>
</div>
