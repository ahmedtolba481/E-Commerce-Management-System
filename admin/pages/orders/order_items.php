<?php
include '../../includes/auth.php';
$pageTitle = "Order Details | ShopEase Admin";
$pageHeading = "Order Details";

include '../../../config/database.php';

$order_id = (int)($_GET['id'] ?? ($_GET['order_id'] ?? 0));

$orderQuery = "SELECT
                orders.id,
                users.name AS client_name,
                users.email AS client_email,
                clients.phone AS client_phone,
                clients.address AS client_address,
                clients.city AS client_city,
                orders.total_price,
                orders.status,
                orders.created_at
               FROM orders
               LEFT JOIN clients ON orders.client_id = clients.id
               LEFT JOIN users ON clients.user_id = users.id
               WHERE orders.id = $order_id";

$orderResult = mysqli_query($conn, $orderQuery);
$order = mysqli_fetch_assoc($orderResult);

if (!$order) {
    header("Location: index.php");
    exit;
}

$query = "SELECT
            order_items.id,
            order_items.order_id,
            order_items.product_id,
            order_items.quantity,
            order_items.price,
            products.name AS product_name,
            products.image AS product_image
          FROM order_items
          LEFT JOIN products ON order_items.product_id = products.id
          WHERE order_items.order_id = $order_id";

$result = mysqli_query($conn, $query);

$itemsList = [];
if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
        $itemsList[] = $row;
    }
}

$statusClass = 'badge-mint';
$st = strtolower($order['status'] ?? 'pending');
if ($st === 'pending' || $st === 'processing') $statusClass = 'badge-warning';
elseif ($st === 'cancelled') $statusClass = 'badge-danger';
elseif ($st === 'shipped') $statusClass = 'badge-info';

include '../../includes/header.php';
?>

<div class="admin-layout">
    <?php include '../../includes/sidebar.php'; ?>

    <main class="admin-content">
        <?php include '../../includes/navbar.php'; ?>

        <div class="page-header">
            <div>
                <span class="page-eyebrow">ORDER FULFILLMENT</span>
                <h1>Order #<?= $order['id']; ?> Details</h1>
                <p>Review customer purchase details and manage status.</p>
            </div>

            <div class="page-actions">
                <a href="index.php" class="btn btn-outline">
                    <i class="bi bi-arrow-left"></i>
                    <span>Back to Orders</span>
                </a>
                <a href="edit.php?id=<?= $order['id'] ?>" class="btn btn-primary">
                    <i class="bi bi-pencil"></i>
                    <span>Update Status</span>
                </a>
            </div>
        </div>

        <div class="row g-4 mb-4">
            <!-- Order Information Card -->
            <div class="col-md-6">
                <div class="form-card m-0" style="max-width: 100%;">
                    <div class="d-flex align-items-center justify-content-between mb-3 pb-2 border-bottom">
                        <h2 class="h5 font-weight-bold text-dark m-0">Order Summary</h2>
                        <span class="badge <?= $statusClass ?>"><?= htmlspecialchars(ucfirst($order['status'])) ?></span>
                    </div>

                    <div class="d-flex flex-column gap-2">
                        <div class="d-flex justify-content-between py-1">
                            <span class="text-muted">Order ID</span>
                            <strong class="text-dark">#<?= $order['id'] ?></strong>
                        </div>
                        <div class="d-flex justify-content-between py-1 border-top">
                            <span class="text-muted">Placed Date</span>
                            <span class="text-dark"><?= htmlspecialchars($order['created_at']) ?></span>
                        </div>
                        <div class="d-flex justify-content-between py-1 border-top">
                            <span class="text-muted">Total Amount</span>
                            <strong class="h4 text-primary m-0">$<?= number_format($order['total_price'], 2) ?></strong>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Customer Information Card -->
            <div class="col-md-6">
                <div class="form-card m-0" style="max-width: 100%;">
                    <div class="d-flex align-items-center justify-content-between mb-3 pb-2 border-bottom">
                        <h2 class="h5 font-weight-bold text-dark m-0">Customer Details</h2>
                        <i class="bi bi-person-vcard text-primary fs-5"></i>
                    </div>

                    <div class="d-flex flex-column gap-2">
                        <div class="d-flex justify-content-between py-1">
                            <span class="text-muted">Customer Name</span>
                            <strong class="text-dark"><?= htmlspecialchars($order['client_name'] ?? 'Guest Customer') ?></strong>
                        </div>
                        <div class="d-flex justify-content-between py-1 border-top">
                            <span class="text-muted">Email</span>
                            <span class="text-dark"><?= htmlspecialchars($order['client_email'] ?? 'N/A') ?></span>
                        </div>
                        <div class="d-flex justify-content-between py-1 border-top">
                            <span class="text-muted">Shipping City</span>
                            <span class="text-dark"><?= htmlspecialchars($order['client_city'] ?? 'N/A') ?></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- ORDER ITEMS LIST CARDS -->
        <div class="form-card max-w-none" style="max-width: 100%;">
            <div class="d-flex align-items-center justify-content-between mb-3 pb-2 border-bottom">
                <h2 class="h5 font-weight-bold text-dark m-0">Purchased Items (<?= count($itemsList) ?>)</h2>
            </div>

            <?php if (!empty($itemsList)) { ?>
                <div class="d-flex flex-column gap-3">
                    <?php foreach ($itemsList as $item) { 
                        $subtotal = $item['quantity'] * $item['price'];
                    ?>
                        <div class="d-flex align-items-center justify-content-between p-3 rounded border bg-white shadow-xs">
                            <div class="d-flex align-items-center gap-3">
                                <div style="width: 56px; height: 56px; border-radius: 8px; overflow: hidden; background: #f8fafc; border: 1px solid #e2e8f0; display: flex; align-items: center; justify-content: center;">
                                    <?php if (!empty($item['product_image'])) { ?>
                                        <img src="/E-Commerce-Management-System/admin/assets/images/products/<?= htmlspecialchars($item['product_image']) ?>" alt="" style="width: 100%; height: 100%; object-fit: contain;">
                                    <?php } else { ?>
                                        <i class="bi bi-box-seam text-muted fs-4"></i>
                                    <?php } ?>
                                </div>
                                <div>
                                    <h3 class="h6 font-weight-bold text-dark m-0"><?= htmlspecialchars($item['product_name'] ?? 'Product Item'); ?></h3>
                                    <span class="text-muted small">Unit Price: $<?= number_format($item['price'], 2) ?> &times; Qty: <?= $item['quantity'] ?></span>
                                </div>
                            </div>

                            <div class="text-end">
                                <span class="d-block text-muted small">Subtotal</span>
                                <strong class="h5 text-dark m-0">$<?= number_format($subtotal, 2) ?></strong>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            <?php } else { ?>
                <div class="text-center py-4 text-muted">No items associated with this order.</div>
            <?php } ?>
        </div>
    </main>
</div>

<?php include '../../includes/footer.php'; ?>