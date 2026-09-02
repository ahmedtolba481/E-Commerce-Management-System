<?php

$pageTitle = "Dashboard | SmartStore";
$pageKey = "dashboard";
include '../config/database.php';

// 1. Total Revenue
$revenueQuery = "
    SELECT COALESCE(SUM(total_price), 0) AS total_revenue
    FROM orders
    WHERE status != 'cancelled'
";
$revenueResult = mysqli_query($conn, $revenueQuery);
$revenueRow = mysqli_fetch_assoc($revenueResult);
$totalRevenue = $revenueRow["total_revenue"];

// 2. Total Orders
$ordersQuery = "
    SELECT COUNT(*) AS total_orders
    FROM orders
";
$ordersResult = mysqli_query($conn, $ordersQuery);
$ordersRow = mysqli_fetch_assoc($ordersResult);
$totalOrders = $ordersRow["total_orders"];

// 3. Products in Stock
$stockQuery = "
    SELECT COALESCE(SUM(stock), 0) AS products_in_stock
    FROM products
";
$stockResult = mysqli_query($conn, $stockQuery);
$stockRow = mysqli_fetch_assoc($stockResult);
$productsInStock = $stockRow["products_in_stock"];

// 4. Total Clients
$clientsQuery = "
    SELECT COUNT(*) AS total_clients
    FROM clients
";
$clientsResult = mysqli_query($conn, $clientsQuery);
$clientsRow = mysqli_fetch_assoc($clientsResult);
$totalClients = $clientsRow["total_clients"];

// 5. Low Stock Products
$lowStockQuery = "
    SELECT
        products.id,
        products.name,
        products.stock,
        categories.name AS category_name
    FROM products
    LEFT JOIN categories
        ON products.category_id = categories.id
    WHERE products.stock <= 10
    ORDER BY products.stock ASC
    LIMIT 4
";

$lowStockResult = mysqli_query($conn, $lowStockQuery);


// 6. Top Selling Products
$topProductsQuery = "
    SELECT
        products.id,
        products.name,
        SUM(order_items.quantity) AS total_sales,
        SUM(order_items.quantity * order_items.price) AS total_revenue
    FROM order_items
    INNER JOIN products
        ON order_items.product_id = products.id
    INNER JOIN orders
        ON order_items.order_id = orders.id
    WHERE orders.status != 'cancelled'
    GROUP BY products.id, products.name
    ORDER BY total_sales DESC
    LIMIT 4
";

$topProductsResult = mysqli_query($conn, $topProductsQuery);
include './includes/header.php';
include './includes/navbar.php';
?>

<div class="admin-layout">
    <?php require_once './includes/sidebar.php'; 
    ?>


    
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


        <!--  STATISTICS-->

        <div class="stats-grid">


            <!-- Total Revenue -->

            <div class="stat-card">
                <div class="stat-card-top">
                    <div>
                        <span class="stat-label">
                            Total Revenue
                        </span>
                        <h2>$<?= number_format($totalRevenue) ?></h2>
                    </div>


                    <div class="stat-icon stat-icon-blue">
                        <i class="bi bi-currency-dollar"></i>
                    </div>
                </div>

            </div>


            <!-- Total Orders -->

            <div class="stat-card">

                <div class="stat-card-top">

                    <div>

                        <span class="stat-label">
                            Total Orders
                        </span>

                        <h2><?= $totalOrders ?></h2>

                    </div>


                    <div class="stat-icon stat-icon-green">

                        <i class="bi bi-cart-check"></i>

                    </div>

                </div>



            </div>


            <!-- Products -->

            <div class="stat-card">

                <div class="stat-card-top">

                    <div>

                        <span class="stat-label">
                            Products in Stock
                        </span>

                        <h2><?= $productsInStock ?></h2>

                    </div>


                    <div class="stat-icon stat-icon-orange">

                        <i class="bi bi-box-seam"></i>

                    </div>

                </div>



            </div>


            <!-- Clients -->

            <div class="stat-card">

                <div class="stat-card-top">

                    <div>

                        <span class="stat-label">
                            Total Clients
                        </span>

                        <h2><?= $totalClients ?></h2>

                    </div>


                    <div class="stat-icon stat-icon-cyan">

                        <i class="bi bi-people"></i>

                    </div>

                </div>

            </div>

        </div>


        <!-- 
            STORE MANAGEMENT
        -->

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
                href="./pages/categories/index.php"
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
                href="./pages/Brands/index.php"
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
                href="./pages/products/index.php"
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
                href="./pages/orders/index.php"
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
                href="./pages/clients/index.php"
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
                href="./pages/team/index.php"
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
                href="./pages/Partners/index.php"
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
                href="./pages/users/index.php"
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

        <!-- 
            BOTTOM CARDS
        -->

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
            href="./pages/products/index.php"
            class="view-all"
        >
            View all
        </a>

    </div>


    <div class="product-list">

        <?php if (mysqli_num_rows($lowStockResult) > 0) { ?>

            <?php while ($product = mysqli_fetch_assoc($lowStockResult)) { ?>

                <div class="product-row">

                    <div class="product-info">

                        <div class="product-image">
                            <i class="bi bi-box-seam"></i>
                        </div>

                        <div>

                            <strong>
                                <?= htmlspecialchars($product["name"]) ?>
                            </strong>

                            <span>
                                <?= htmlspecialchars($product["category_name"] ?? "No Category") ?>
                            </span>
                        </div>
                    </div>
                    <?php if ($product["stock"] <= 4) { ?>
                        <span class="stock-danger">
                            <?= $product["stock"] ?> left
                        </span>
                    <?php } else { ?>
                        <span class="stock-warning">
                            <?= $product["stock"] ?> left
                        </span>
                    <?php } ?>
                </div>
            <?php } ?>
        <?php } else { ?>
            <p class="no-data">
                No low stock products.
            </p>
        <?php } ?>
    </div>
</div>
<?php require_once __DIR__ . '/includes/footer.php'; ?>