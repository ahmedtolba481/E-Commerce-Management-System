<?php
include "../../config/database.php";
include "../../includes/header.php";
include "../../includes/navbar.php";

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$query = "SELECT products.*, categories.name AS category_name, brands.name AS brand_name 
          FROM products 
          LEFT JOIN categories ON products.category_id = categories.id 
          LEFT JOIN brands ON products.brand_id = brands.id 
          WHERE products.id = $id";
$result = mysqli_query($conn, $query);
$product = $result ? mysqli_fetch_assoc($result) : null;

if (!$product) {
    echo "<div class='container section text-center'><h2>Product not found.</h2><a href='index.php' class='btn btn-primary mt-3'>Back to Products</a></div>";
    include "../../includes/footer.php";
    exit;
}
?>

<section class="section">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-6">
                <div class="card" style="padding: 2rem; background: var(--background); display: flex; align-items: center; justify-content: center; height: 500px;">
                    <img src="../../admin/assets/images/products/<?php echo htmlspecialchars($product['image'] ?? 'default.jpg'); ?>" onerror="this.src='../../admin/assets/images/products/<?php echo htmlspecialchars($product['image'] ?? 'iphone15.jpg'); ?>'" alt="<?php echo htmlspecialchars($product['name']); ?>" style="max-width: 100%; max-height: 100%; object-fit: contain;">
                </div>
            </div>
            <div class="col-md-6" style="padding-left: 3rem;">
                <div style="display: flex; align-items: center; gap: 1rem; margin-bottom: 1rem;">
                    <?php if(!empty($product['brand_name'])): ?>
                        <span class="badge badge-success"><?php echo htmlspecialchars($product['brand_name']); ?></span>
                    <?php endif; ?>
                    <span class="badge" style="background: #E5E7EB; color: var(--dark);"><?php echo htmlspecialchars($product['category_name'] ?? 'Uncategorized'); ?></span>
                </div>
                
                <h1 style="font-size: 2.5rem; margin-bottom: 0.5rem;"><?php echo htmlspecialchars($product['name']); ?></h1>
                
                <div style="font-size: 2rem; font-weight: 700; color: var(--primary); margin-bottom: 1.5rem;">
                    $<?php echo htmlspecialchars($product['price']); ?>
                </div>
                
                <div style="margin-bottom: 1.5rem;">
                    <?php if ((int)$product['stock'] > 0): ?>
                        <span style="color: var(--primary); font-weight: 600;"><i class="bi bi-check-circle-fill"></i> In Stock (<?php echo $product['stock']; ?> available)</span>
                    <?php else: ?>
                        <span style="color: #DC2626; font-weight: 600;"><i class="bi bi-x-circle-fill"></i> Out of Stock</span>
                    <?php endif; ?>
                </div>
                
                <div style="color: var(--text); font-size: 1.1rem; line-height: 1.8; margin-bottom: 2rem;">
                    <?php echo nl2br(htmlspecialchars($product['description'] ?? 'No description available.')); ?>
                </div>
                
                <?php if ((int)$product['stock'] > 0): ?>
                    <form action="../../actions/cart/add.php" method="POST" style="display: flex; gap: 1rem; align-items: center; padding: 1.5rem; background: var(--background); border-radius: 12px;">
                        <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">
                        <div style="display: flex; align-items: center; gap: 1rem;">
                            <label style="font-weight: 600;">Quantity:</label>
                            <input type="number" name="quantity" value="1" min="1" max="<?php echo $product['stock']; ?>" class="form-control" style="width: 80px; text-align: center;">
                        </div>
                        <button type="submit" class="btn btn-primary btn-lg" style="flex: 1;"><i class="bi bi-cart-plus"></i> Add to Cart</button>
                    </form>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>

<?php
include "../../includes/footer.php";
?>
