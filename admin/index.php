<?php

$pageTitle = "Dashboard | SmartStore";
$pageKey = "dashboard";

include( './includes/header.php');
include('./includes/navbar.php');
include('./includes/database.php');
?>

<div class="admin-layout">

    

    <?php require_once __DIR__ . '/includes/sidebar.php'; ?>


    

    <main class="admin-content">

        <!-- Page Header -->
        <div class="page-header">

            <div>

                <span class="page-eyebrow">
                    COMMAND CENTER
                </span>

                <h1>Dashboard</h1>

                <p>
                    Welcome back, Admin. Here's what's happening with your
                    store today.
                </p>

            </div>


            <div class="page-actions">

                <button type="button" class="btn btn-outline-secondary">

                    <i class="bi bi-download"></i>

                    Export Report

                </button>


                <a
                    href="/E-Commerce-Management-System/admin/products/create.php"
                    class="btn btn-primary"
                >

                    <i class="bi bi-plus-lg"></i>

                    Add Product

                </a>

            </div>

        </div>


        <!-- =========================
             STATISTICS
        ========================== -->

        <div class="stats-grid">


            <!-- Total Revenue -->

            <div class="stat-card">

                <div class="stat-card-top">

                    <div>

                        <span class="stat-label">
                            Total Revenue
                        </span>

                        <h2>$48,290</h2>

                    </div>


                    <div class="stat-icon stat-icon-blue">

                        <i class="bi bi-currency-dollar"></i>

                    </div>

                </div>


                <div class="stat-footer">

                    <span class="positive">

                        <i class="bi bi-arrow-up"></i>

                        12.5%

                    </span>

                    <span>
                        vs last month
                    </span>

                </div>

            </div>


            <!-- Total Orders -->

            <div class="stat-card">

                <div class="stat-card-top">

                    <div>

                        <span class="stat-label">
                            Total Orders
                        </span>

                        <h2>1,204</h2>

                    </div>


                    <div class="stat-icon stat-icon-green">

                        <i class="bi bi-cart-check"></i>

                    </div>

                </div>


                <div class="stat-footer">

                    <span class="positive">

                        <i class="bi bi-arrow-up"></i>

                        8.2%

                    </span>

                    <span>
                        vs last month
                    </span>

                </div>

            </div>


            <!-- Products -->

            <div class="stat-card">

                <div class="stat-card-top">

                    <div>

                        <span class="stat-label">
                            Products in Stock
                        </span>

                        <h2>341</h2>

                    </div>


                    <div class="stat-icon stat-icon-orange">

                        <i class="bi bi-box-seam"></i>

                    </div>

                </div>


                <div class="stat-footer">

                    <span class="negative">

                        <i class="bi bi-arrow-down"></i>

                        2.4%

                    </span>

                    <span>
                        vs last month
                    </span>

                </div>

            </div>


            <!-- Clients -->

            <div class="stat-card">

                <div class="stat-card-top">

                    <div>

                        <span class="stat-label">
                            Total Clients
                        </span>

                        <h2>3,482</h2>

                    </div>


                    <div class="stat-icon stat-icon-cyan">

                        <i class="bi bi-people"></i>

                    </div>

                </div>


                <div class="stat-footer">

                    <span class="positive">

                        <i class="bi bi-arrow-up"></i>

                        5.7%

                    </span>

                    <span>
                        vs last month
                    </span>

                </div>

            </div>

        </div>


        <!-- =========================
             STORE MANAGEMENT
        ========================== -->

        <div class="section-heading">

            <div>

                <span class="section-eyebrow">
                    STORE MANAGEMENT
                </span>

                <h2>Manage your store</h2>

                <p>
                    Quickly access the main areas of your e-commerce system.
                </p>

            </div>

        </div>


        <div class="management-grid">


            <!-- Categories -->

            <a
                href="/E-Commerce-Management-System/admin/categories/index.php"
                class="management-card"
            >

                <div class="management-icon">
                    <i class="bi bi-grid"></i>
                </div>

                <div class="management-content">

                    <h3>Categories</h3>

                    <p>
                        Organize products into categories.
                    </p>

                </div>

                <i class="bi bi-arrow-right management-arrow"></i>

            </a>


            <!-- Brands -->

            <a
                href="/E-Commerce-Management-System/admin/brands/index.php"
                class="management-card"
            >

                <div class="management-icon">
                    <i class="bi bi-tags"></i>
                </div>

                <div class="management-content">

                    <h3>Brands</h3>

                    <p>
                        Manage product brands.
                    </p>

                </div>

                <i class="bi bi-arrow-right management-arrow"></i>

            </a>


            <!-- Products -->

            <a
                href="/E-Commerce-Management-System/admin/products/index.php"
                class="management-card"
            >

                <div class="management-icon">
                    <i class="bi bi-box-seam"></i>
                </div>

                <div class="management-content">

                    <h3>Products</h3>

                    <p>
                        Add and manage store products.
                    </p>

                </div>

                <i class="bi bi-arrow-right management-arrow"></i>

            </a>


            <!-- Orders -->

            <a
                href="/E-Commerce-Management-System/admin/orders/index.php"
                class="management-card"
            >

                <div class="management-icon">
                    <i class="bi bi-cart-check"></i>
                </div>

                <div class="management-content">

                    <h3>Orders</h3>

                    <p>
                        Manage customer orders.
                    </p>

                </div>

                <i class="bi bi-arrow-right management-arrow"></i>

            </a>


            <!-- Clients -->

            <a
                href="/E-Commerce-Management-System/admin/clients/index.php"
                class="management-card"
            >

                <div class="management-icon">
                    <i class="bi bi-people"></i>
                </div>

                <div class="management-content">

                    <h3>Clients</h3>

                    <p>
                        Manage registered customers.
                    </p>

                </div>

                <i class="bi bi-arrow-right management-arrow"></i>

            </a>


            <!-- Team -->

            <a
                href="/E-Commerce-Management-System/admin/team/index.php"
                class="management-card"
            >

                <div class="management-icon">
                    <i class="bi bi-person-badge"></i>
                </div>

                <div class="management-content">

                    <h3>Team</h3>

                    <p>
                        Manage store team members.
                    </p>

                </div>

                <i class="bi bi-arrow-right management-arrow"></i>

            </a>


            <!-- Partners -->

            <a
                href="/E-Commerce-Management-System/admin/partners/index.php"
                class="management-card"
            >

                <div class="management-icon">
                    <i class="bi bi-building"></i>
                </div>

                <div class="management-content">

                    <h3>Partners</h3>

                    <p>
                        Manage suppliers and partners.
                    </p>

                </div>

                <i class="bi bi-arrow-right management-arrow"></i>

            </a>


            <!-- Users -->

            <a
                href="/E-Commerce-Management-System/admin/users/index.php"
                class="management-card"
            >

                <div class="management-icon">
                    <i class="bi bi-person-gear"></i>
                </div>

                <div class="management-content">

                    <h3>Users</h3>

                    <p>
                        Manage admin users and permissions.
                    </p>

                </div>

                <i class="bi bi-arrow-right management-arrow"></i>

            </a>

        </div>


        <!-- =========================
             REVENUE + RECENT ORDERS
        ========================== -->

        <div class="dashboard-grid">


            <!-- Revenue Overview -->

            <div class="dashboard-card sales-card">

                <div class="card-header">

                    <div>

                        <span class="card-eyebrow">
                            FINANCIAL PULSE
                        </span>

                        <h3>
                            Revenue Overview
                        </h3>

                        <p>
                            Monthly sales performance
                        </p>

                    </div>


                    <div class="chart-period">

                        <button class="active">
                            12M
                        </button>

                        <button>
                            6M
                        </button>

                        <button>
                            30D
                        </button>

                    </div>

                </div>


                <div class="sales-chart">

                    <div class="chart-y-axis">

                        <span>$20k</span>
                        <span>$15k</span>
                        <span>$10k</span>
                        <span>$5k</span>
                        <span>$0</span>

                    </div>


                    <div class="chart-area">

                        <div class="chart-bars">


                            <div class="chart-column">

                                <div
                                    class="chart-bar"
                                    style="height: 38%;"
                                ></div>

                                <span>Jan</span>

                            </div>


                            <div class="chart-column">

                                <div
                                    class="chart-bar"
                                    style="height: 52%;"
                                ></div>

                                <span>Feb</span>

                            </div>


                            <div class="chart-column">

                                <div
                                    class="chart-bar"
                                    style="height: 44%;"
                                ></div>

                                <span>Mar</span>

                            </div>


                            <div class="chart-column">

                                <div
                                    class="chart-bar"
                                    style="height: 64%;"
                                ></div>

                                <span>Apr</span>

                            </div>


                            <div class="chart-column">

                                <div
                                    class="chart-bar"
                                    style="height: 57%;"
                                ></div>

                                <span>May</span>

                            </div>


                            <div class="chart-column">

                                <div
                                    class="chart-bar"
                                    style="height: 75%;"
                                ></div>

                                <span>Jun</span>

                            </div>


                            <div class="chart-column">

                                <div
                                    class="chart-bar"
                                    style="height: 91%;"
                                ></div>

                                <span>Jul</span>

                            </div>


                            <div class="chart-column">

                                <div
                                    class="chart-bar"
                                    style="height: 100%;"
                                ></div>

                                <span>Aug</span>

                            </div>


                            <div class="chart-column">

                                <div
                                    class="chart-bar"
                                    style="height: 70%;"
                                ></div>

                                <span>Sep</span>

                            </div>


                            <div class="chart-column">

                                <div
                                    class="chart-bar"
                                    style="height: 56%;"
                                ></div>

                                <span>Oct</span>

                            </div>


                            <div class="chart-column">

                                <div
                                    class="chart-bar"
                                    style="height: 63%;"
                                ></div>

                                <span>Nov</span>

                            </div>


                            <div class="chart-column">

                                <div
                                    class="chart-bar"
                                    style="height: 78%;"
                                ></div>

                                <span>Dec</span>

                            </div>


                        </div>

                    </div>

                </div>

            </div>


            <!-- Recent Orders -->

            <div class="dashboard-card orders-card">

                <div class="card-header">

                    <div>

                        <span class="card-eyebrow">
                            LIVE QUEUE
                        </span>

                        <h3>
                            Recent Orders
                        </h3>

                        <p>
                            Latest customer orders
                        </p>

                    </div>


                    <a
                        href="/E-Commerce-Management-System/admin/orders/index.php"
                        class="view-all"
                    >

                        View all

                        <i class="bi bi-arrow-right"></i>

                    </a>

                </div>


                <div class="table-responsive">

                    <table class="table dashboard-table">

                        <thead>

                            <tr>

                                <th>
                                    Order
                                </th>

                                <th>
                                    Customer
                                </th>

                                <th>
                                    Total
                                </th>

                                <th>
                                    Status
                                </th>

                            </tr>

                        </thead>


                        <tbody>


                            <tr>

                                <td>
                                    <strong>#ORD-1024</strong>
                                </td>

                                <td>
                                    John Doe
                                </td>

                                <td>
                                    $245.00
                                </td>

                                <td>

                                    <span class="status-badge status-completed">
                                        Completed
                                    </span>

                                </td>

                            </tr>


                            <tr>

                                <td>
                                    <strong>#ORD-1023</strong>
                                </td>

                                <td>
                                    Sarah Smith
                                </td>

                                <td>
                                    $189.50
                                </td>

                                <td>

                                    <span class="status-badge status-pending">
                                        Pending
                                    </span>

                                </td>

                            </tr>


                            <tr>

                                <td>
                                    <strong>#ORD-1022</strong>
                                </td>

                                <td>
                                    Michael Brown
                                </td>

                                <td>
                                    $420.00
                                </td>

                                <td>

                                    <span class="status-badge status-processing">
                                        Processing
                                    </span>

                                </td>

                            </tr>


                            <tr>

                                <td>
                                    <strong>#ORD-1021</strong>
                                </td>

                                <td>
                                    Emma Wilson
                                </td>

                                <td>
                                    $75.99
                                </td>

                                <td>

                                    <span class="status-badge status-completed">
                                        Completed
                                    </span>

                                </td>

                            </tr>


                            <tr>

                                <td>
                                    <strong>#ORD-1020</strong>
                                </td>

                                <td>
                                    David Lee
                                </td>

                                <td>
                                    $310.00
                                </td>

                                <td>

                                    <span class="status-badge status-pending">
                                        Pending
                                    </span>

                                </td>

                            </tr>


                        </tbody>

                    </table>

                </div>

            </div>

        </div>


        <!-- =========================
             BOTTOM CARDS
        ========================== -->

        <div class="dashboard-grid dashboard-grid-bottom">


            <!-- Low Stock -->

            <div class="dashboard-card">

                <div class="card-header">

                    <div>

                        <span class="card-eyebrow">
                            INVENTORY
                        </span>

                        <h3>
                            Low Stock Alert
                        </h3>

                        <p>
                            Products that need attention
                        </p>

                    </div>


                    <a
                        href="/E-Commerce-Management-System/admin/products/index.php"
                        class="view-all"
                    >
                        View all
                    </a>

                </div>


                <div class="product-list">


                    <div class="product-row">

                        <div class="product-info">

                            <div class="product-image">
                                <i class="bi bi-phone"></i>
                            </div>

                            <div>

                                <strong>
                                    iPhone 15 Pro
                                </strong>

                                <span>
                                    Electronics
                                </span>

                            </div>

                        </div>


                        <span class="stock-danger">
                            4 left
                        </span>

                    </div>


                    <div class="product-row">

                        <div class="product-info">

                            <div class="product-image">
                                <i class="bi bi-headphones"></i>
                            </div>

                            <div>

                                <strong>
                                    Wireless Headphones
                                </strong>

                                <span>
                                    Accessories
                                </span>

                            </div>

                        </div>


                        <span class="stock-warning">
                            7 left
                        </span>

                    </div>


                    <div class="product-row">

                        <div class="product-info">

                            <div class="product-image">
                                <i class="bi bi-keyboard"></i>
                            </div>

                            <div>

                                <strong>
                                    Mechanical Keyboard
                                </strong>

                                <span>
                                    Computer Accessories
                                </span>

                            </div>

                        </div>


                        <span class="stock-warning">
                            5 left
                        </span>

                    </div>


                    <div class="product-row">

                        <div class="product-info">

                            <div class="product-image">
                                <i class="bi bi-mouse"></i>
                            </div>

                            <div>

                                <strong>
                                    Gaming Mouse
                                </strong>

                                <span>
                                    Computer Accessories
                                </span>

                            </div>

                        </div>


                        <span class="stock-danger">
                            3 left
                        </span>

                    </div>


                </div>

            </div>


            <!-- Top Products -->

            <div class="dashboard-card">

                <div class="card-header">

                    <div>

                        <span class="card-eyebrow">
                            PERFORMANCE
                        </span>

                        <h3>
                            Top Products
                        </h3>

                        <p>
                            Best selling products
                        </p>

                    </div>


                    <a
                        href="/E-Commerce-Management-System/admin/products/index.php"
                        class="view-all"
                    >
                        View all
                    </a>

                </div>


                <div class="product-list">


                    <div class="product-row">

                        <div class="product-info">

                            <div class="product-rank">
                                1
                            </div>

                            <div>

                                <strong>
                                    MacBook Pro 14"
                                </strong>

                                <span>
                                    128 sales
                                </span>

                            </div>

                        </div>

                        <strong>
                            $18,240
                        </strong>

                    </div>


                    <div class="product-row">

                        <div class="product-info">

                            <div class="product-rank">
                                2
                            </div>

                            <div>

                                <strong>
                                    iPhone 15 Pro
                                </strong>

                                <span>
                                    96 sales
                                </span>

                            </div>

                        </div>

                        <strong>
                            $14,880
                        </strong>

                    </div>


                    <div class="product-row">

                        <div class="product-info">

                            <div class="product-rank">
                                3
                            </div>

                            <div>

                                <strong>
                                    AirPods Pro
                                </strong>

                                <span>
                                    82 sales
                                </span>

                            </div>

                        </div>

                        <strong>
                            $8,610
                        </strong>

                    </div>


                    <div class="product-row">

                        <div class="product-info">

                            <div class="product-rank">
                                4
                            </div>

                            <div>

                                <strong>
                                    Apple Watch
                                </strong>

                                <span>
                                    64 sales
                                </span>

                            </div>

                        </div>

                        <strong>
                            $6,560
                        </strong>

                    </div>


                </div>

            </div>


            <!-- Recent Activity -->

            <div class="dashboard-card">

                <div class="card-header">

                    <div>

                        <span class="card-eyebrow">
                            SYSTEM
                        </span>

                        <h3>
                            Recent Activity
                        </h3>

                        <p>
                            Latest system activity
                        </p>

                    </div>

                </div>


                <div class="activity-list">


                    <div class="activity-item">

                        <div class="activity-icon">
                            <i class="bi bi-cart-check"></i>
                        </div>

                        <div class="activity-content">

                            <strong>
                                New order received
                            </strong>

                            <span>
                                Order #ORD-1024 was placed
                            </span>

                            <small>
                                5 minutes ago
                            </small>

                        </div>

                    </div>


                    <div class="activity-item">

                        <div class="activity-icon">
                            <i class="bi bi-person-plus"></i>
                        </div>

                        <div class="activity-content">

                            <strong>
                                New customer registered
                            </strong>

                            <span>
                                Sarah Smith created an account
                            </span>

                            <small>
                                24 minutes ago
                            </small>

                        </div>

                    </div>


                    <div class="activity-item">

                        <div class="activity-icon">
                            <i class="bi bi-box-seam"></i>
                        </div>

                        <div class="activity-content">

                            <strong>
                                Product updated
                            </strong>

                            <span>
                                iPhone 15 Pro inventory updated
                            </span>

                            <small>
                                1 hour ago
                            </small>

                        </div>

                    </div>


                    <div class="activity-item">

                        <div class="activity-icon">
                            <i class="bi bi-check-circle"></i>
                        </div>

                        <div class="activity-content">

                            <strong>
                                Order completed
                            </strong>

                            <span>
                                Order #ORD-1021 was completed
                            </span>

                            <small>
                                2 hours ago
                            </small>

                        </div>

                    </div>


                </div>

            </div>

        </div>

    </main>

</div>


<?php

require_once __DIR__ . '/includes/footer.php';

?>