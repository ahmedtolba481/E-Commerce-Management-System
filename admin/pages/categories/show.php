<?php
include '../../includes/auth.php';
require_admin_role();
$pageTitle = "Category Details | ShopEase Admin";
$pageHeading = "Category Details";

include '../../../config/database.php';

$id = (int)($_GET['id'] ?? 0);
$sql = "SELECT * FROM categories WHERE id = $id";
$result = mysqli_query($conn, $sql);
$category = mysqli_fetch_assoc($result);

if (!$category) {
    header("Location: index.php");
    exit;
}

// Get associated products count
$prodCountSql = "SELECT COUNT(*) as total FROM products WHERE category_id = $id";
$prodRes = mysqli_query($conn, $prodCountSql);
$prodCount = mysqli_fetch_assoc($prodRes)['total'] ?? 0;

include '../../includes/header.php';
?>

<div class="admin-layout">
    <?php include '../../includes/sidebar.php'; ?>

    <main class="admin-content">
        <?php include '../../includes/navbar.php'; ?>

        <div class="page-header">
            <div>
                <span class="page-eyebrow">CATALOG MANAGEMENT</span>
                <h1><?= htmlspecialchars($category['name']) ?></h1>
                <p>Overview of category info and statistics.</p>
            </div>

            <div class="page-actions">
                <a href="index.php" class="btn btn-outline">
                    <i class="bi bi-arrow-left"></i>
                    <span>Back</span>
                </a>
                <a href="edit.php?id=<?= $category['id'] ?>" class="btn btn-primary">
                    <i class="bi bi-pencil"></i>
                    <span>Edit Category</span>
                </a>
            </div>
        </div>

        <div class="form-card max-w-none" style="max-width: 800px;">
            <div class="row g-4 align-items-center">
                <div class="col-md-5">
                    <div class="card-media-wrap rounded" style="height: 240px;">
                        <?php if (!empty($category['image'])) { ?>
                            <img src="/E-Commerce-Management-System/admin/assets/images/categories/<?= htmlspecialchars($category['image']); ?>" alt="<?= htmlspecialchars($category['name']); ?>">
                        <?php } else { ?>
                            <i class="bi bi-grid card-media-placeholder"></i>
                        <?php } ?>
                    </div>
                </div>

                <div class="col-md-7">
                    <span class="badge badge-mint mb-2">Category #<?= $category['id'] ?></span>
                    <h2 class="h3 font-weight-bold text-dark mb-2"><?= htmlspecialchars($category['name']) ?></h2>
                    <p class="text-muted mb-3"><?= htmlspecialchars($category['description'] ?? 'No description provided.') ?></p>

                    <div class="d-flex align-items-center gap-3 pt-3 border-top">
                        <div>
                            <span class="d-block text-muted small">Associated Products</span>
                            <strong class="h4 font-weight-bold text-dark"><?= $prodCount ?></strong>
                        </div>
                        <?php if (isset($category['created_at'])) { ?>
                        <div class="ms-4 border-start ps-4">
                            <span class="d-block text-muted small">Created Date</span>
                            <strong class="text-dark small"><?= htmlspecialchars($category['created_at']) ?></strong>
                        </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>

<?php include '../../includes/footer.php'; ?>
