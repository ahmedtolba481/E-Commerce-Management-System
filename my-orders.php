<?php
session_start();
require_once __DIR__ . '/config/database.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$user_id = (int) $_SESSION['user_id'];

$stmt = $conn->prepare("
    SELECT orders.id, orders.total_price, orders.status, orders.created_at
    FROM orders
    INNER JOIN clients ON orders.client_id = clients.id
    WHERE clients.user_id = ?
    ORDER BY orders.created_at DESC
");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

function statusClass($status) {
    switch (strtolower($status)) {
        case 'completed':
        case 'delivered': return 'status-success';
        case 'cancelled':
        case 'canceled': return 'status-danger';
        case 'shipped': return 'status-info';
        case 'processing': return 'status-primary';
        default: return 'status-warning';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>SmartStore - My Orders</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
<link rel="stylesheet" href="assets/css/style.css">
<style>
.orders-page{min-height:70vh;background:var(--bg);padding:55px 0 80px}
.orders-header{margin-bottom:30px}.orders-header h1{color:var(--dark);font-size:32px;font-weight:800;margin-bottom:8px}
.orders-header p{color:var(--text);margin:0}
.orders-card{background:#fff;border:1px solid var(--border);border-radius:16px;overflow:hidden;box-shadow:0 8px 25px rgba(23,43,77,.06)}
.orders-table{margin:0}.orders-table thead th{background:var(--dark);color:#fff;border:0;padding:15px 18px;font-size:12px;text-transform:uppercase;letter-spacing:.5px}
.orders-table tbody td{padding:17px 18px;vertical-align:middle;color:var(--text);border-color:#edf1ef}
.order-id{color:var(--dark);font-weight:700}.order-total{color:var(--primary);font-weight:800}.order-date{font-size:13px}
.order-status{display:inline-flex;padding:6px 11px;border-radius:20px;font-size:11px;font-weight:700;text-transform:capitalize}
.status-success{background:#DDF6EC;color:#14885d}.status-danger{background:#FEE2E2;color:#B91C1C}.status-info{background:#DBEAFE;color:#1D4ED8}.status-primary{background:#E0E7FF;color:#4338CA}.status-warning{background:#FEF3C7;color:#92400E}
.order-view-btn{display:inline-flex;align-items:center;gap:6px;padding:7px 12px;border:1px solid var(--border);border-radius:20px;color:var(--dark);background:#fff;text-decoration:none;font-size:12px;font-weight:700;transition:.2s}
.order-view-btn:hover{color:#fff;background:var(--primary);border-color:var(--primary)}
.empty-orders{text-align:center;padding:65px 25px}.empty-orders i{display:block;font-size:48px;color:var(--primary);margin-bottom:15px}.empty-orders h3{color:var(--dark);font-size:21px;font-weight:700}.empty-orders p{color:var(--text);margin-bottom:22px}
@media(max-width:767px){.orders-page{padding:35px 0 55px}.orders-table thead{display:none}.orders-table,.orders-table tbody,.orders-table tr,.orders-table td{display:block;width:100%}.orders-table tr{padding:12px 15px;border-bottom:1px solid #edf1ef}.orders-table tbody td{padding:7px 0;border:0;display:flex;justify-content:space-between;gap:15px}.orders-table tbody td::before{content:attr(data-label);font-weight:700;color:var(--dark)}}
</style>
</head>
<body>
<nav class="navbar navbar-expand-lg main-navbar">
<div class="container">
<a class="navbar-brand d-lg-none text-white fw-bold" href="index.php">SmartStore</a>
<button class="navbar-toggler border-0 shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#mainNav">
<i class="bi bi-list text-white fs-2"></i></button>
<div class="collapse navbar-collapse" id="mainNav">
<ul class="navbar-nav mx-auto align-items-lg-center">
<li class="nav-item"><a class="nav-link" href="index.php">HOME</a></li>
<li class="nav-item"><a class="nav-link" href="index.php#about">ABOUT</a></li>
<li class="nav-item"><a class="nav-link" href="categories.php">PRODUCTS</a></li>
<li class="nav-item"><a class="nav-link" href="cart.php">CART</a></li>
<li class="nav-item"><a class="nav-link active" href="my-orders.php">MY ORDERS</a></li>
<li class="nav-item"><a class="nav-link" href="index.php#contact">CONTACT US</a></li>
<li class="nav-item"><a class="nav-link" href="logout.php">LOGOUT</a></li>
</ul></div></div></nav>
<section class="orders-page"><div class="container">
<div class="orders-header"><h1>My Orders</h1><p>View the orders you have placed and their current status.</p></div>
<div class="orders-card">
<?php if ($result && $result->num_rows > 0): ?>
<div class="table-responsive"><table class="table orders-table">
<thead><tr><th>Order</th><th>Date</th><th>Total</th><th>Status</th><th class="text-end">Action</th></tr></thead>
<tbody>
<?php while ($order = $result->fetch_assoc()): ?>
<tr>
<td data-label="Order"><span class="order-id">#<?= (int)$order['id'] ?></span></td>
<td data-label="Date"><span class="order-date"><?= htmlspecialchars(date('M d, Y - h:i A', strtotime($order['created_at']))) ?></span></td>
<td data-label="Total"><span class="order-total">$<?= number_format((float)$order['total_price'], 2) ?></span></td>
<td data-label="Status"><span class="order-status <?= statusClass($order['status']) ?>"><?= htmlspecialchars($order['status']) ?></span></td>
<td data-label="Action" class="text-md-end"><a href="order-details.php?id=<?= (int)$order['id'] ?>" class="order-view-btn"><i class="bi bi-eye"></i> View Details</a></td>
</tr>
<?php endwhile; ?>
</tbody></table></div>
<?php else: ?>
<div class="empty-orders"><i class="bi bi-bag-x"></i><h3>No orders yet</h3><p>You haven't placed any orders yet. Start shopping and your orders will appear here.</p><a href="categories.php" class="btn-shop">SHOP NOW <i class="bi bi-arrow-right"></i></a></div>
<?php endif; ?>
</div></div></section>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body></html>
