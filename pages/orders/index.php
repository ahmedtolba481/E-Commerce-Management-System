<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include "../../config/database.php";

if (!isset($_SESSION['user_id']) || !isset($_SESSION['client_id'])) {
    header("Location: ../auth/login.php");
    exit;
}

include "../../includes/header.php";
include "../../includes/navbar.php";

$client_id = (int)$_SESSION['client_id'];
?>

<section class="section" style="background: var(--background); min-height: 80vh;">
    <div class="container">
        <h1 style="margin-bottom: 2rem;">My Orders</h1>
        
        <?php
        // Try to get orders, using simple mysqli
        $query = "SELECT * FROM orders WHERE client_id = $client_id ORDER BY id DESC";
        $result = mysqli_query($conn, $query);
        
        if ($result && mysqli_num_rows($result) > 0) {
            while ($order = mysqli_fetch_assoc($result)) {
                $order_id = $order['id'];
                $total_amount = $order['total_price'] ?? 0;
                $status = $order['status'] ?? 'pending';
                // Some status colors
                $status_color = '#9CA3AF'; // default gray
                $status_bg = '#F3F4F6';
                if ($status == 'pending') { $status_color = '#D97706'; $status_bg = '#FEF3C7'; }
                if ($status == 'processing') { $status_color = '#2563EB'; $status_bg = '#DBEAFE'; }
                if ($status == 'shipped') { $status_color = '#7C3AED'; $status_bg = '#EDE9FE'; }
                if ($status == 'delivered') { $status_color = '#059669'; $status_bg = '#D1FAE5'; }
                if ($status == 'cancelled') { $status_color = '#DC2626'; $status_bg = '#FEE2E2'; }
        ?>
                <div class="card" style="margin-bottom: 1.5rem; overflow: visible;">
                    <div style="background: #F9FAFB; padding: 1.5rem; border-bottom: 1px solid #E5E7EB; display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 1rem;">
                        <div>
                            <div style="font-size: 0.85rem; color: #6B7280; margin-bottom: 0.25rem;">Order Number</div>
                            <div style="font-weight: 700; color: var(--dark);">#ORD-<?php echo str_pad($order['id'], 5, '0', STR_PAD_LEFT); ?></div>
                        </div>
                        <div>
                            <div style="font-size: 0.85rem; color: #6B7280; margin-bottom: 0.25rem;">Total Amount</div>
                            <div style="font-weight: 700; color: var(--primary);">$<?php echo number_format((float)$total_amount, 2); ?></div>
                        </div>
                        <div>
                            <span style="display: inline-block; padding: 0.35rem 1rem; border-radius: 99px; font-size: 0.85rem; font-weight: 600; background: <?php echo $status_bg; ?>; color: <?php echo $status_color; ?>; text-transform: capitalize;">
                                <?php echo htmlspecialchars($status); ?>
                            </span>
                        </div>
                    </div>
                    <div style="padding: 1.5rem;">
                        <h5 style="margin-bottom: 1rem; font-size: 1rem;">Order Items</h5>
                        
                        <?php
                        // Get order items
                        $items_query = "SELECT order_items.*, products.name, products.image 
                                        FROM order_items 
                                        JOIN products ON order_items.product_id = products.id 
                                        WHERE order_items.order_id = $order_id";
                        $items_result = mysqli_query($conn, $items_query);
                        
                        if ($items_result && mysqli_num_rows($items_result) > 0) {
                            while ($item = mysqli_fetch_assoc($items_result)) {
                        ?>
                            <div style="display: flex; align-items: center; gap: 1rem; margin-bottom: 1rem; padding-bottom: 1rem; border-bottom: 1px solid #F3F4F6;">
                                <div style="width: 60px; height: 60px; background: var(--background); border-radius: 8px; display: flex; align-items: center; justify-content: center; padding: 0.25rem;">
                                    <img src="../../admin/assets/images/products/<?php echo htmlspecialchars($item['image'] ?? 'default.jpg'); ?>" onerror="this.src='../../admin/assets/images/products/<?php echo htmlspecialchars($item['image'] ?? 'iphone15.jpg'); ?>'" alt="<?php echo htmlspecialchars($item['name']); ?>" style="max-width: 100%; max-height: 100%; object-fit: contain;">
                                </div>
                                <div style="flex: 1;">
                                    <div style="font-weight: 600; color: var(--dark);"><?php echo htmlspecialchars($item['name']); ?></div>
                                    <div style="font-size: 0.85rem; color: #6B7280;">Qty: <?php echo htmlspecialchars($item['quantity'] ?? 1); ?> &times; $<?php echo htmlspecialchars($item['price']); ?></div>
                                </div>
                                <div style="font-weight: 600;">
                                    $<?php echo number_format((float)($item['price']) * (int)($item['quantity'] ?? 1), 2); ?>
                                </div>
                            </div>
                        <?php
                            }
                        }
                        ?>
                    </div>
                </div>
        <?php
            }
        } else {
        ?>
            <div class="card" style="padding: 4rem 2rem; text-align: center;">
                <div style="font-size: 4rem; color: #9CA3AF; margin-bottom: 1rem;"><i class="bi bi-box-seam"></i></div>
                <h2 style="margin-bottom: 1rem;">No orders yet</h2>
                <p style="color: var(--text); margin-bottom: 2rem;">You haven't placed any orders with us yet.</p>
                <a href="../products/index.php" class="btn btn-primary" style="padding: 1rem 2rem;">Start Shopping</a>
            </div>
        <?php
        }
        ?>
    </div>
</section>

<?php
include "../../includes/footer.php";
?>
