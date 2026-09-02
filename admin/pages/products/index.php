<?php
include '../../includes/auth.php';
$pageTitle = "Products | ShopEase Admin";
$pageHeading = "Products";

include '../../../config/database.php';

$query = "SELECT 
            products.id,
            categories.name AS category_name,
            brands.name AS brand_name,
            products.name,
            products.description,
            products.price,
            products.stock,
            products.image,
            products.created_at
          FROM products
          LEFT JOIN categories
            ON products.category_id = categories.id
          LEFT JOIN brands
            ON products.brand_id = brands.id
          ORDER BY products.id DESC";

$result = mysqli_query($conn, $query);

$productsList = [];
if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
        $productsList[] = $row;
    }
}

include '../../includes/header.php';
?>

<div class="admin-layout">
    <?php include '../../includes/sidebar.php'; ?>

    <main class="admin-content">
        <?php include '../../includes/navbar.php'; ?>

        <div class="page-header">
            <div>
                <span class="page-eyebrow">INVENTORY & CATALOG</span>
                <h1>Products</h1>
                <p>Manage product items, pricing, and stock levels.</p>
            </div>

            <div class="page-actions">
                <a href="create.php" class="btn btn-primary">
                    <i class="bi bi-plus-lg"></i>
                    <span>Add Product</span>
                </a>
            </div>
        </div>

        <?php if (!empty($productsList)) { ?>
            <div class="entity-card-grid">
                <?php foreach ($productsList as $product) { 
                    $isLowStock = (int)$product['stock'] <= 5;
                ?>
                    <article class="entity-card">
                        <div class="card-media-wrap">
                            <?php if (!empty($product['image'])) { ?>
                                <img src="/E-Commerce-Management-System/admin/assets/images/products/<?= htmlspecialchars($product['image']); ?>" alt="<?= htmlspecialchars($product['name']); ?>" loading="lazy">
                            <?php } else { ?>
                                <i class="bi bi-box-seam card-media-placeholder"></i>
                            <?php } ?>
                        </div>

                        <div class="entity-card-body">
                            <div class="d-flex align-items-center justify-content-between mb-1">
                                <span class="entity-subtitle">#<?= $product['id']; ?> &middot; <?= htmlspecialchars($product['category_name'] ?? 'Uncategorized'); ?></span>
                                <?php if (!empty($product['brand_name'])) { ?>
                                    <span class="badge badge-dark"><?= htmlspecialchars($product['brand_name']); ?></span>
                                <?php } ?>
                            </div>

                            <h2 class="entity-title"><?= htmlspecialchars($product['name']); ?></h2>
                            <p class="entity-description"><?= htmlspecialchars($product['description'] ?? 'No description available.'); ?></p>

                            <div class="d-flex align-items-center justify-content-between mb-3">
                                <span class="entity-price">$<?= number_format($product['price'], 2); ?></span>
                                <span class="badge <?= $isLowStock ? 'badge-danger' : 'badge-mint' ?>">
                                    <?= $product['stock']; ?> in stock
                                </span>
                            </div>

                            <div class="entity-card-footer">
                                <span class="text-muted small">Updated recently</span>
                                <div class="icon-action-group">
                                    <a href="show.php?id=<?= $product['id']; ?>" class="icon-action action-view" aria-label="View product" title="View Product">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                    <a href="edit.php?id=<?= $product['id']; ?>" class="icon-action action-edit" aria-label="Edit product" title="Edit Product">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <a href="delete.php?id=<?= $product['id']; ?>" class="icon-action action-delete" aria-label="Delete product" title="Delete Product">
                                        <i class="bi bi-trash3"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </article>
                <?php } ?>
            </div>
        <?php } else { ?>
            <div class="empty-state">
                <div class="empty-state-icon">
                    <i class="bi bi-box-seam"></i>
                </div>
                <h3>No Products Found</h3>
                <p>There are currently no products available in your store inventory.</p>
                <a href="create.php" class="btn btn-primary">
                    <i class="bi bi-plus-lg"></i>
                    <span>Add Product</span>
                </a>
            </div>
        <?php } ?>
    </main>
</div>

<?php include '../../includes/footer.php'; ?>