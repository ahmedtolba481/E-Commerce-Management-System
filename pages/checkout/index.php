<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include "../../config/database.php";

if (!isset($_SESSION['client_id'])) {
    header("Location: ../auth/login.php");
    exit;
}
if (empty($_SESSION['cart'])) {
    header("Location: ../cart/index.php");
    exit;
}

include "../../includes/header.php";
include "../../includes/navbar.php";

$error = isset($_SESSION['checkout_error']) ? $_SESSION['checkout_error'] : '';
unset($_SESSION['checkout_error']);

// Get user and client data
$user_id = (int)$_SESSION['user_id'];
$user_query = "SELECT users.name, users.email, clients.phone, clients.address, clients.city 
               FROM users 
               JOIN clients ON users.id = clients.user_id 
               WHERE users.id = $user_id LIMIT 1";
$user_result = mysqli_query($conn, $user_query);
$user = $user_result ? mysqli_fetch_assoc($user_result) : null;
?>

<section class="section" style="background: var(--background); min-height: 80vh;">
    <div class="container">
        <h1 style="margin-bottom: 2rem;">Checkout</h1>
        
        <?php if ($error): ?>
            <div style="background: #FEE2E2; color: #DC2626; padding: 1rem; border-radius: 8px; margin-bottom: 1.5rem;">
                <i class="bi bi-exclamation-triangle-fill"></i> <?php echo htmlspecialchars($error); ?>
            </div>
        <?php endif; ?>
        
        <div class="row">
            <div class="col-md-7">
                <div class="card" style="padding: 2rem; margin-bottom: 1.5rem;">
                    <h3 style="margin-bottom: 1.5rem;"><i class="bi bi-person-lines-fill"></i> Customer Information</h3>
                    <div class="row">
                        <div class="col-md-6" style="margin-bottom: 1rem;">
                            <label class="form-label">Full Name</label>
                            <input type="text" class="form-control" value="<?php echo htmlspecialchars($user['name'] ?? ''); ?>" readonly style="background: #F3F4F6;">
                        </div>
                        <div class="col-md-6" style="margin-bottom: 1rem;">
                            <label class="form-label">Email Address</label>
                            <input type="email" class="form-control" value="<?php echo htmlspecialchars($user['email'] ?? ''); ?>" readonly style="background: #F3F4F6;">
                        </div>
                    </div>
                </div>
                
                <div class="card" style="padding: 2rem;">
                    <h3 style="margin-bottom: 1.5rem;"><i class="bi bi-truck"></i> Shipping Information</h3>
                    <div style="background: var(--light-mint); color: var(--primary); padding: 1rem; border-radius: 8px; margin-bottom: 1.5rem; font-size: 0.9rem;">
                        <i class="bi bi-info-circle-fill"></i> To update your shipping details, please visit your <a href="../profile/index.php" style="color: var(--primary); font-weight: bold;">Profile page</a>.
                    </div>
                    <div class="row">
                        <div class="col-md-6" style="margin-bottom: 1rem;">
                            <label class="form-label">Phone Number</label>
                            <input type="text" class="form-control" value="<?php echo htmlspecialchars($user['phone'] ?? ''); ?>" readonly style="background: #F3F4F6;">
                        </div>
                        <div class="col-md-6" style="margin-bottom: 1rem;">
                            <label class="form-label">City</label>
                            <input type="text" class="form-control" value="<?php echo htmlspecialchars($user['city'] ?? ''); ?>" readonly style="background: #F3F4F6;">
                        </div>
                    </div>
                    <div style="margin-bottom: 1rem;">
                        <label class="form-label">Address</label>
                        <input type="text" class="form-control" value="<?php echo htmlspecialchars($user['address'] ?? ''); ?>" readonly style="background: #F3F4F6;">
                    </div>
                </div>
            </div>
            
            <div class="col-md-5">
                <div class="card" style="padding: 2rem; position: sticky; top: 100px;">
                    <h3 style="margin-bottom: 1.5rem;">Order Summary</h3>
                    
                    <div style="max-height: 300px; overflow-y: auto; padding-right: 1rem; margin-bottom: 1rem;">
                        <?php
                        $subtotal = 0;
                        foreach ($_SESSION['cart'] as $item) {
                            $product_id = $item['id'];
                            $quantity = $item['quantity'];
                            
                            $query = "SELECT name, price, image FROM products WHERE id = $product_id";
                            $result = mysqli_query($conn, $query);
                            
                            if ($result && mysqli_num_rows($result) > 0) {
                                $product = mysqli_fetch_assoc($result);
                                $item_total = $product['price'] * $quantity;
                                $subtotal += $item_total;
                        ?>
                            <div style="display: flex; align-items: center; justify-content: space-between; border-bottom: 1px solid #F3F4F6; padding-bottom: 0.75rem; margin-bottom: 0.75rem;">
                                <div style="display: flex; align-items: center; gap: 0.75rem; flex: 1;">
                                    <div style="width: 40px; height: 40px; background: #F3F4F6; border-radius: 4px; display: flex; align-items: center; justify-content: center; overflow: hidden;">
                                        <img src="../../assets/images/products<?php echo htmlspecialchars($product['image'] ?? 'default.jpg'); ?>" onerror="this.src='../../assets/images/products/<?php echo htmlspecialchars($product['image'] ?? 'iphone15.jpg'); ?>'" style="max-width: 100%; max-height: 100%; object-fit: contain;">
                                    </div>
                                    <div style="font-size: 0.9rem;">
                                        <div style="font-weight: 600; color: var(--dark); white-space: nowrap; overflow: hidden; text-overflow: ellipsis; max-width: 150px;"><?php echo htmlspecialchars($product['name']); ?></div>
                                        <div style="color: #6B7280;">Qty: <?php echo $quantity; ?></div>
                                    </div>
                                </div>
                                <div style="font-weight: 600;">$<?php echo number_format($item_total, 2); ?></div>
                            </div>
                        <?php
                            }
                        }
                        ?>
                    </div>
                    
                    <div style="display: flex; justify-content: space-between; margin-bottom: 0.5rem; color: var(--text);">
                        <span>Subtotal</span>
                        <span>$<?php echo number_format($subtotal, 2); ?></span>
                    </div>
                    
                    <?php 
                    $delivery = ($subtotal > 0 && $subtotal < 300) ? 4.99 : 0;
                    $total = $subtotal + $delivery;
                    ?>
                    
                    <div style="display: flex; justify-content: space-between; margin-bottom: 1rem; color: var(--text); padding-bottom: 1rem; border-bottom: 1px solid #E5E7EB;">
                        <span>Delivery</span>
                        <span><?php echo $delivery > 0 ? '$'.number_format($delivery, 2) : 'FREE'; ?></span>
                    </div>
                    
                    <div style="display: flex; justify-content: space-between; margin-bottom: 2rem; font-weight: 700; font-size: 1.25rem;">
                        <span>Grand Total</span>
                        <span style="color: var(--primary);">$<?php echo number_format($total, 2); ?></span>
                    </div>
                    
                    <form action="../../actions/checkout/place-order.php" method="POST">
                        <button type="submit" class="btn btn-primary" style="width: 100%; justify-content: center; padding: 1rem; font-size: 1.1rem;"><i class="bi bi-lock-fill"></i> Place Order Securely</button>
                    </form>
                    
                    <div style="text-align: center; margin-top: 1rem;">
                        <a href="../cart/index.php" style="color: var(--text); text-decoration: none; font-size: 0.9rem;">Return to Cart</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php
include "../../includes/footer.php";
?>
