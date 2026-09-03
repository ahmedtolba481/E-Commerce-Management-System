<?php
session_start();
require_once __DIR__ . '/config/database.php';

if (!isset($_SESSION['user_id'])) { header("Location: login.php"); exit; }

$order_id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$user_id = (int)$_SESSION['user_id'];
if ($order_id <= 0) { header("Location: my-orders.php"); exit; }

$stmt = $conn->prepare("
    SELECT orders.id, orders.total_price, orders.status, orders.created_at
    FROM orders
    INNER JOIN clients ON orders.client_id = clients.id
    WHERE orders.id = ? AND clients.user_id = ?
    LIMIT 1
");
$stmt->bind_param("ii", $order_id, $user_id);
$stmt->execute();
$order = $stmt->get_result()->fetch_assoc();
if (!$order) { header("Location: my-orders.php"); exit; }

$stmt = $conn->prepare("
    SELECT order_items.quantity, order_items.price,
           products.name AS product_name, products.image
    FROM order_items
    LEFT JOIN products ON order_items.product_id = products.id
    WHERE order_items.order_id = ?
    ORDER BY order_items.id ASC
");
$stmt->bind_param("i", $order_id);
$stmt->execute();
$items = $stmt->get_result();
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>SmartStore - Order #<?= $order_id ?></title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
<link rel="stylesheet" href="assets/css/style.css">
<style>
.order-details-page{min-height:70vh;background:var(--bg);padding:55px 0 80px}
.details-card{background:#fff;border:1px solid var(--border);border-radius:16px;overflow:hidden;box-shadow:0 8px 25px rgba(23,43,77,.06)}
.details-header{background:var(--dark);color:#fff;padding:20px 25px}.details-header h1{margin:0 0 5px;font-size:22px;font-weight:800}.details-header p{margin:0;opacity:.8;font-size:13px}
.details-body{padding:25px}.detail-item{display:flex;align-items:center;gap:15px;padding:15px 0;border-bottom:1px solid #edf1ef}.detail-item:last-child{border-bottom:0}
.detail-item-image{width:70px;height:70px;flex:0 0 70px;border-radius:10px;background:var(--bg);display:flex;align-items:center;justify-content:center;overflow:hidden}.detail-item-image img{width:100%;height:100%;object-fit:contain}.detail-item-image i{font-size:25px;color:#9aa6a1}
.detail-item-info{flex:1;min-width:0}.detail-item-info h3{color:var(--dark);font-size:15px;font-weight:700;margin:0 0 5px}.detail-item-info p{color:var(--text);font-size:12px;margin:0}.detail-item-total{color:var(--primary);font-weight:800;white-space:nowrap}
.order-summary{margin-top:20px;padding-top:20px;border-top:1px solid var(--border)}.order-summary-row{display:flex;justify-content:space-between;color:var(--text);font-size:14px}.order-summary-row.total{color:var(--dark);font-size:19px;font-weight:800}.order-summary-row.total span:last-child{color:var(--primary)}
</style></head>
<body>
<nav class="navbar navbar-expand-lg main-navbar"><div class="container">
<a class="navbar-brand d-lg-none text-white fw-bold" href="index.php">SmartStore</a>
<div class="collapse navbar-collapse show" id="mainNav"><ul class="navbar-nav mx-auto align-items-lg-center">
<li class="nav-item"><a class="nav-link" href="index.php">HOME</a></li><li class="nav-item"><a class="nav-link" href="categories.php">PRODUCTS</a></li><li class="nav-item"><a class="nav-link" href="cart.php">CART</a></li><li class="nav-item"><a class="nav-link active" href="my-orders.php">MY ORDERS</a></li><li class="nav-item"><a class="nav-link" href="logout.php">LOGOUT</a></li>
</ul></div></div></nav>
<section class="order-details-page"><div class="container">
<div class="mb-4"><a href="my-orders.php" class="text-decoration-none text-success fw-semibold small"><i class="bi bi-arrow-left"></i> Back to My Orders</a></div>
<div class="details-card"><div class="details-header"><h1>Order #<?= $order_id ?></h1><p><?= htmlspecialchars(date('M d, Y - h:i A', strtotime($order['created_at']))) ?> &nbsp;•&nbsp; <?= htmlspecialchars($order['status']) ?></p></div>
<div class="details-body">
<?php while ($item=$items->fetch_assoc()): $qty=(int)$item['quantity']; $price=(float)$item['price']; $image=$item['image'] ?? ''; ?>
<div class="detail-item"><div class="detail-item-image">
<?php if ($image !== ''): ?><img src="admin/assets/images/products/<?= htmlspecialchars($image) ?>" alt="<?= htmlspecialchars($item['product_name'] ?? 'Product') ?>"><?php else: ?><i class="bi bi-image"></i><?php endif; ?>
</div><div class="detail-item-info"><h3><?= htmlspecialchars($item['product_name'] ?? 'Product') ?></h3><p>Quantity: <?= $qty ?> × $<?= number_format($price,2) ?></p></div><div class="detail-item-total">$<?= number_format($qty*$price,2) ?></div></div>
<?php endwhile; ?>
<div class="order-summary"><div class="order-summary-row total"><span>Order Total</span><span>$<?= number_format((float)$order['total_price'],2) ?></span></div></div>
</div></div></div></section>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body></html>
