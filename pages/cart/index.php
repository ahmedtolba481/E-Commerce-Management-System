<?php
include "../../config/database.php";
include "../../includes/header.php";
include "../../includes/navbar.php";

$cart = isset($_SESSION['cart']) ? $_SESSION['cart'] : [];
$subtotal = 0;
?>

<section class="section" style="background: var(--background); min-height: 80vh;">
    <div class="container">
        <h1 style="margin-bottom: 2rem;">Shopping Cart</h1>
        
        <?php if (empty($cart)): ?>
            <div class="card" style="padding: 4rem 2rem; text-align: center;">
                <div style="font-size: 4rem; color: #9CA3AF; margin-bottom: 1rem;"><i class="bi bi-cart-x"></i></div>
                <h2 style="margin-bottom: 1rem;">Your cart is empty</h2>
                <p style="color: var(--text); margin-bottom: 2rem;">Looks like you haven't added anything to your cart yet.</p>
                <a href="../products/index.php" class="btn btn-primary" style="padding: 1rem 2rem;">Continue Shopping</a>
            </div>
        <?php else: ?>
            <div class="row">
                <div class="col-md-8">
                    <div class="card" style="padding: 2rem;">
                        <?php
                        foreach ($cart as $item) {
                            $product_id = $item['id'];
                            $quantity = $item['quantity'];
                            
                            $query = "SELECT * FROM products WHERE id = $product_id";
                            $result = mysqli_query($conn, $query);
                            
                            if ($result && mysqli_num_rows($result) > 0) {
                                $product = mysqli_fetch_assoc($result);
                                $item_total = $product['price'] * $quantity;
                                $subtotal += $item_total;
                        ?>
                            <div style="display: flex; align-items: center; border-bottom: 1px solid #E5E7EB; padding-bottom: 1.5rem; margin-bottom: 1.5rem; gap: 1.5rem;">
                                <div style="width: 100px; height: 100px; background: var(--background); border-radius: 8px; display: flex; align-items: center; justify-content: center; padding: 0.5rem;">
                                    <img src="../../admin/assets/images/products/<?php echo htmlspecialchars($product['image'] ?? 'default.jpg'); ?>" onerror="this.src='../../assets/images/products/<?php echo htmlspecialchars($product['image'] ?? 'iphone15.jpg'); ?>'" alt="<?php echo htmlspecialchars($product['name']); ?>" style="max-width: 100%; max-height: 100%; object-fit: contain;">
                                </div>
                                <div style="flex: 1;">
                                    <h4 style="margin-bottom: 0.2rem;"><?php echo htmlspecialchars($product['name']); ?></h4>
                                    <div style="color: var(--primary); font-weight: 600;">$<?php echo htmlspecialchars($product['price']); ?></div>
                                </div>
                                <div>
                                    <form action="../../actions/cart/update.php" method="POST" style="display: flex; align-items: center; gap: 0.5rem;">
                                        <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">
                                        <input type="number" name="quantity" value="<?php echo $quantity; ?>" min="1" max="<?php echo $product['stock']; ?>" class="form-control" style="width: 70px; padding: 0.5rem; text-align: center;">
                                        <button type="submit" class="btn btn-secondary icon-btn" style="width: 35px; height: 35px;" title="Update"><i class="bi bi-arrow-clockwise"></i></button>
                                    </form>
                                </div>
                                <div style="font-weight: 700; font-size: 1.1rem; width: 100px; text-align: right;">
                                    $<?php echo number_format($item_total, 2); ?>
                                </div>
                                <div>
                                    <form action="../../actions/cart/remove.php" method="POST">
                                        <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">
                                        <button type="submit" class="btn icon-btn" style="background: #FEE2E2; color: #DC2626; width: 35px; height: 35px;" title="Remove"><i class="bi bi-trash"></i></button>
                                    </form>
                                </div>
                            </div>
                        <?php
                            }
                        }
                        ?>
                    </div>
                </div>
                
                <div class="col-md-4">
                    <div class="card" style="padding: 2rem;">
                        <h3 style="margin-bottom: 1.5rem;">Order Summary</h3>
                        
                        <div style="display: flex; justify-content: space-between; margin-bottom: 1rem; color: var(--text);">
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
                            <span>Total</span>
                            <span style="color: var(--primary);">$<?php echo number_format($total, 2); ?></span>
                        </div>
                        
                        <a href="../checkout/index.php" class="btn btn-primary" style="width: 100%; justify-content: center; padding: 1rem;">Proceed to Checkout</a>
                        
                        <div style="text-align: center; margin-top: 1rem;">
                            <a href="../products/index.php" style="color: var(--text); text-decoration: none; font-size: 0.9rem;">or Continue Shopping</a>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div>
</section>

<?php
include "../../includes/footer.php";
?>
