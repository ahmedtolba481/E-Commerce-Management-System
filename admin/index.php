<?php
$pageTitle = "Dashboard | ShopEase Admin";
$pageHeading = "Dashboard Overview";

include '../config/database.php';
include './includes/auth.php';

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

// Total Products Count
$prodCountQuery = "SELECT COUNT(*) AS total_products FROM products";
$prodCountResult = mysqli_query($conn, $prodCountQuery);
$prodCountRow = mysqli_fetch_assoc($prodCountResult);
$totalProducts = $prodCountRow["total_products"];

// 4. Total Clients
$clientsQuery = "
    SELECT COUNT(*) AS total_clients
    FROM clients
";
$clientsResult = mysqli_query($conn, $clientsQuery);
$clientsRow = mysqli_fetch_assoc($clientsResult);
$totalClients = $clientsRow["total_clients"];

// Total Users
$usersCountQuery = "SELECT COUNT(*) AS total_users FROM users";
$usersCountResult = mysqli_query($conn, $usersCountQuery);
$usersCountRow = mysqli_fetch_assoc($usersCountResult);
$totalUsers = $usersCountRow["total_users"] ?? 0;

// 5. Low Stock Products
$lowStockQuery = "
    SELECT
        products.id,
        products.name,
        products.stock,
        products.image,
        categories.name AS category_name
    FROM products
    LEFT JOIN categories
        ON products.category_id = categories.id
    WHERE products.stock <= 10
    ORDER BY products.stock ASC
    LIMIT 4
";
$lowStockResult = mysqli_query($conn, $lowStockQuery);

// 6. Recent Orders
$recentOrdersQuery = "
    SELECT
        orders.id,
        users.name AS client_name,
        orders.total_price,
        orders.status,
        orders.created_at
    FROM orders
    LEFT JOIN clients
        ON orders.client_id = clients.id
    LEFT JOIN users
        ON clients.user_id = users.id
    ORDER BY orders.id DESC
    LIMIT 5
";
$recentOrdersResult = mysqli_query($conn, $recentOrdersQuery);

include './includes/header.php';
?>

<div class="admin-layout">
    <?php require_once './includes/sidebar.php'; ?>

    <main class="admin-content">
        <?php include './includes/navbar.php'; ?>

        <!-- Page Header -->
        <div class="page-header">
            <div>
                <span class="page-eyebrow">COMMAND CENTER</span>
                <h1>Welcome back, <?= htmlspecialchars($_SESSION['admin_name'] ?? 'Admin') ?></h1>
                <p>Here is what is happening across your ShopEase store today.</p>
            </div>

            <div class="page-actions">
                <a href="/E-Commerce-Management-System/admin/pages/products/create.php" class="btn btn-primary">
                    <i class="bi bi-plus-lg"></i>
                    <span>Add Product</span>
                </a>
            </div>
        </div>

        <!-- STATISTICS GRID -->
        <div class="stats-grid">
            <!-- Card 1: Total Products -->
            <div class="stat-card">
                <div>
                    <div class="stat-card-header">
                        <span class="stat-card-title">Total Products</span>
                        <div class="stat-icon">
                            <i class="bi bi-box-seam"></i>
                        </div>
                    </div>
                    <div class="stat-value"><?= number_format($totalProducts) ?></div>
                </div>
                <div class="stat-footer">
                    <span class="stat-accent"><?= number_format($productsInStock) ?></span> total items in inventory
                </div>
            </div>

            <!-- Card 2: Total Orders -->
            <div class="stat-card">
                <div>
                    <div class="stat-card-header">
                        <span class="stat-card-title">Total Orders</span>
                        <div class="stat-icon">
                            <i class="bi bi-receipt"></i>
                        </div>
                    </div>
                    <div class="stat-value"><?= number_format($totalOrders) ?></div>
                </div>
                <div class="stat-footer">
                    <span class="stat-accent">$<?= number_format($totalRevenue, 2) ?></span> total revenue
                </div>
            </div>

            <!-- Card 3: Total Clients -->
            <div class="stat-card">
                <div>
                    <div class="stat-card-header">
                        <span class="stat-card-title">Total Clients</span>
                        <div class="stat-icon">
                            <i class="bi bi-person-vcard"></i>
                        </div>
                    </div>
                    <div class="stat-value"><?= number_format($totalClients) ?></div>
                </div>
                <div class="stat-footer">
                    Registered customer accounts
                </div>
            </div>

            <!-- Card 4: Total Users -->
            <div class="stat-card">
                <div>
                    <div class="stat-card-header">
                        <span class="stat-card-title">Total System Users</span>
                        <div class="stat-icon">
                            <i class="bi bi-person-gear"></i>
                        </div>
                    </div>
                    <div class="stat-value"><?= number_format($totalUsers) ?></div>
                </div>
                <div class="stat-footer">
                    Admins and staff users
                </div>
            </div>
        </div>

        <!-- DASHBOARD EXTRA SECTIONS -->
        <div class="row g-4 mb-4">
            <!-- Recent Orders Section -->
            <div class="col-lg-7">
                <div class="form-card m-0 max-w-none" style="max-width: 100%;">
                    <div class="d-flex align-items-center justify-content-between mb-3 pb-2 border-bottom">
                        <div>
                            <span class="page-eyebrow">SALES</span>
                            <h3 class="h5 font-weight-bold text-dark m-0">Recent Orders</h3>
                        </div>
                        <a href="./pages/orders/index.php" class="btn btn-outline btn-sm">
                            View All Orders <i class="bi bi-arrow-right"></i>
                        </a>
                    </div>

                    <?php if ($recentOrdersResult && mysqli_num_rows($recentOrdersResult) > 0) { ?>
                        <div class="d-flex flex-column gap-3">
                            <?php while ($order = mysqli_fetch_assoc($recentOrdersResult)) { 
                                $statusClass = 'badge-mint';
                                $st = strtolower($order['status'] ?? 'pending');
                                if ($st === 'pending' || $st === 'processing') $statusClass = 'badge-warning';
                                elseif ($st === 'cancelled') $statusClass = 'badge-danger';
                                elseif ($st === 'shipped') $statusClass = 'badge-info';
                            ?>
                                <div class="d-flex align-items-center justify-content-between p-3 rounded border bg-white shadow-xs">
                                    <div class="d-flex align-items-center gap-3">
                                        <div class="stat-icon" style="width: 38px; height: 38px; font-size: 1.1rem;">
                                            <i class="bi bi-bag"></i>
                                        </div>
                                        <div>
                                            <strong class="d-block text-dark">Order #<?= $order['id'] ?></strong>
                                            <span class="text-muted small"><?= htmlspecialchars($order['client_name'] ?? 'Guest Customer') ?></span>
                                        </div>
                                    </div>
                                    <div class="text-end">
                                        <strong class="d-block text-dark">$<?= number_format($order['total_price'], 2) ?></strong>
                                        <span class="badge <?= $statusClass ?>"><?= htmlspecialchars(ucfirst($order['status'])) ?></span>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                    <?php } else { ?>
                        <div class="text-center py-4 text-muted">No orders found yet.</div>
                    <?php } ?>
                </div>
            </div>

            <!-- Low Stock Alert Section -->
            <div class="col-lg-5 ">
                <div class="form-card m-0 max-w-none" style="max-width: 100%;">
                    <div class="d-flex align-items-center justify-content-between mb-3 pb-2 border-bottom">
                        <div> 
                            <span class="page-eyebrow text-danger">INVENTORY ALERT</span>
                            <h3 class="h5 font-weight-bold text-dark m-0">Low Stock Products</h3>
                        </div>
                        <a href="./pages/products/index.php" class="btn btn-outline btn-sm">
                            Manage Inventory
                        </a>
                    </div>

                    <?php if ($lowStockResult && mysqli_num_rows($lowStockResult) > 0) { ?>
                        <div class="d-flex flex-column gap-3">
                            <?php while ($product = mysqli_fetch_assoc($lowStockResult)) { ?>
                                <div class="d-flex align-items-center justify-content-between p-2.5 rounded border bg-white p-2 rounded-2">
                                    <div class="d-flex align-items-center gap-3">
                                        <div style="width: 44px; height: 44px; border-radius: 8px; overflow: hidden; background: #f8fafc; border: 1px solid #e2e8f0; display: flex; align-items: center; justify-content: center;">
                                            <?php if (!empty($product['image'])) { ?>
                                                <img src="/E-Commerce-Management-System/admin/assets/images/products/<?= htmlspecialchars($product['image']) ?>" alt="" style="width: 100%; height: 100%; object-fit: contain;">
                                            <?php } else { ?>
                                                <i class="bi bi-box-seam text-muted"></i>
                                            <?php } ?>
                                        </div>
                                        <div>
                                            <strong class="d-block text-dark small" style="line-height: 1.2;"><?= htmlspecialchars($product['name']) ?></strong>
                                            <span class="text-muted" style="font-size: 0.75rem;"><?= htmlspecialchars($product['category_name'] ?? 'Uncategorized') ?></span>
                                        </div>
                                    </div>
                                    <span class="badge badge-danger"><?= $product['stock'] ?> left</span>
                                </div>
                            <?php } ?>
                        </div>
                    <?php } else { ?>
                        <div class="text-center py-4 text-muted">
                            <i class="bi bi-check-circle text-success fs-3 d-block mb-2"></i>
                            All products have sufficient stock!
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>

        <!-- QUICK ACTIONS / NAVIGATION TILES -->
        <div class="mt-4">
            <span class="page-eyebrow">QUICK ACCESS</span>
            <h2 class="h4 font-weight-bold text-dark mb-3">Store Modules</h2>
            <div class="entity-card-grid">
                <a href="./pages/categories/index.php" class="entity-card p-3 text-decoration-none text-dark">
                    <div class="d-flex align-items-center gap-3">
                        <div class="stat-icon"><i class="bi bi-grid-fill"></i></div>
                        <div>
                            <h3 class="h6 font-weight-bold m-0">Categories</h3>
                            <span class="text-muted small">Manage catalog categories</span>
                        </div>
                    </div>
                </a>

                <a href="./pages/Brands/index.php" class="entity-card p-3 text-decoration-none text-dark">
                    <div class="d-flex align-items-center gap-3">
                        <div class="stat-icon"><i class="bi bi-patch-check-fill"></i></div>
                        <div>
                            <h3 class="h6 font-weight-bold m-0">Brands</h3>
                            <span class="text-muted small">Manage product brands</span>
                        </div>
                    </div>
                </a>

                <a href="./pages/products/index.php" class="entity-card p-3 text-decoration-none text-dark">
                    <div class="d-flex align-items-center gap-3">
                        <div class="stat-icon"><i class="bi bi-box-seam-fill"></i></div>
                        <div>
                            <h3 class="h6 font-weight-bold m-0">Products</h3>
                            <span class="text-muted small">Catalog & inventory</span>
                        </div>
                    </div>
                </a>

                <a href="./pages/orders/index.php" class="entity-card p-3 text-decoration-none text-dark">
                    <div class="d-flex align-items-center gap-3">
                        <div class="stat-icon"><i class="bi bi-receipt"></i></div>
                        <div>
                            <h3 class="h6 font-weight-bold m-0">Orders</h3>
                            <span class="text-muted small">Fulfill & update orders</span>
                        </div>
                    </div>
                </a>

                <a href="./pages/clients/index.php" class="entity-card p-3 text-decoration-none text-dark">
                    <div class="d-flex align-items-center gap-3">
                        <div class="stat-icon"><i class="bi bi-person-vcard-fill"></i></div>
                        <div>
                            <h3 class="h6 font-weight-bold m-0">Clients</h3>
                            <span class="text-muted small">Customer directory</span>
                        </div>
                    </div>
                </a>

                <a href="./pages/team/index.php" class="entity-card p-3 text-decoration-none text-dark">
                    <div class="d-flex align-items-center gap-3">
                        <div class="stat-icon"><i class="bi bi-people-fill"></i></div>
                        <div>
                            <h3 class="h6 font-weight-bold m-0">Team</h3>
                            <span class="text-muted small">Staff members</span>
                        </div>
                    </div>
                </a>

                <a href="./pages/Partners/index.php" class="entity-card p-3 text-decoration-none text-dark">
                    <div class="d-flex align-items-center gap-3">
                        <div class="stat-icon"><i class="bi bi-buildings-fill"></i></div>
                        <div>
                            <h3 class="h6 font-weight-bold m-0">Partners</h3>
                            <span class="text-muted small">Suppliers & partners</span>
                        </div>
                    </div>
                </a>

                <a href="./pages/users/index.php" class="entity-card p-3 text-decoration-none text-dark">
                    <div class="d-flex align-items-center gap-3">
                        <div class="stat-icon"><i class="bi bi-person-gear"></i></div>
                        <div>
                            <h3 class="h6 font-weight-bold m-0">Users</h3>
                            <span class="text-muted small">System permissions</span>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </main>
</div>

<?php require_once __DIR__ . '/includes/footer.php'; ?>