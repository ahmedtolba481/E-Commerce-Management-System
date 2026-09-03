<?php
include "../../config/database.php";
include "../../includes/header.php";
include "../../includes/navbar.php";

$category_id = isset($_GET['category']) ? (int)$_GET['category'] : 0;
?>

<section class="section" style="background: var(--background); padding: 3rem 0;">
    <div class="container">
        <div class="section-title">
            <h2 style="font-size: 2.5rem;">Our Products</h2>
            <p>Discover our complete collection of premium tech products.</p>
        </div>
        
        <div style="display: flex; gap: 1rem; flex-wrap: wrap; margin-bottom: 2rem; justify-content: center;">
            <a href="index.php" class="btn <?php echo ($category_id == 0) ? 'btn-primary' : 'btn-secondary'; ?>" style="border-radius: 99px;">All Products</a>
            <?php
            $cat_query = "SELECT * FROM categories";
            $cat_result = mysqli_query($conn, $cat_query);
            if ($cat_result) {
                while ($cat = mysqli_fetch_assoc($cat_result)) {
                    $active = ($category_id == $cat['id']) ? 'btn-primary' : 'btn-secondary';
                    echo '<a href="index.php?category='.$cat['id'].'" class="btn '.$active.'" style="border-radius: 99px;">'.htmlspecialchars($cat['name']).'</a>';
                }
            }
            ?>
        </div>
        
        <div class="row">
            <?php
            $query = "SELECT products.*, categories.name AS category_name, brands.name AS brand_name 
                      FROM products 
                      LEFT JOIN categories ON products.category_id = categories.id 
                      LEFT JOIN brands ON products.brand_id = brands.id";
            if ($category_id > 0) {
                $query .= " WHERE products.category_id = $category_id";
            }
            $result = mysqli_query($conn, $query);
            if ($result && mysqli_num_rows($result) > 0) {
                while ($product = mysqli_fetch_assoc($result)) {
            ?>
                <div class="col-md-3" style="margin-bottom: 1.5rem;">
                    <div class="product-card">
                        <div class="product-image">
                            <img src="../../admin/assets/images/products/<?php echo htmlspecialchars($product['image'] ?? 'default.jpg'); ?>" onerror="this.src='../../admin/assets/images/products/<?php echo htmlspecialchars($product['image'] ?? 'iphone15.jpg'); ?>'" alt="<?php echo htmlspecialchars($product['name']); ?>">
                        </div>
                        <div class="product-info">
                            <?php if(!empty($product['brand_name'])): ?>
                                <div class="product-brand"><?php echo htmlspecialchars($product['brand_name']); ?></div>
                            <?php endif; ?>
                            <div class="product-name"><?php echo htmlspecialchars($product['name']); ?></div>
                            <div style="font-size: 0.8rem; color: var(--text); margin-bottom: 0.5rem;"><?php echo htmlspecialchars($product['category_name']); ?></div>
                            <div class="product-price">$<?php echo htmlspecialchars($product['price']); ?></div>
                            <div class="product-actions">
                                <a href="details.php?id=<?php echo $product['id']; ?>" class="btn btn-secondary icon-btn" title="View Details"><i class="bi bi-eye"></i></a>
                                <form action="../../actions/cart/add.php" method="POST" style="flex:1;">
                                    <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">
                                    <input type="hidden" name="quantity" value="1">
                                    <button type="submit" class="btn btn-primary" style="width:100%;"><i class="bi bi-cart-plus"></i> Add</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            <?php
                }
            } else {
                echo "<div style='width: 100%; text-align: center; padding: 4rem 0;'><h3>No products found in this category.</h3></div>";
            }
            ?>
        </div>
    </div>
</section>

<?php
include "../../includes/footer.php";
?>
