<?php
include '../../includes/auth.php';
require_admin_role();
$pageTitle = "Categories | ShopEase Admin";
$pageHeading = "Categories";

include '../../includes/header.php';
include '../../../config/database.php';

$query = 'SELECT * FROM categories ORDER BY id DESC;';
$result = mysqli_query($conn, $query);

$categoriesList = [];
if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
        $categoriesList[] = $row;
    }
}
?>

<div class="admin-layout">
    <?php include '../../includes/sidebar.php'; ?>

    <main class="admin-content">
        <?php include '../../includes/navbar.php'; ?>

        <div class="page-header">
            <div>
                <span class="page-eyebrow">CATALOG MANAGEMENT</span>
                <h1>Categories</h1>
                <p>Organize products into store categories.</p>
            </div>

            <div class="page-actions">
                <a href="create.php" class="btn btn-primary">
                    <i class="bi bi-plus-lg"></i>
                    <span>Add Category</span>
                </a>
            </div>
        </div>

        <?php if (!empty($categoriesList)) { ?>
            <div class="entity-card-grid">
                <?php foreach ($categoriesList as $category) { ?>
                    <article class="entity-card">
                        <div class="card-media-wrap">
                            <?php if (!empty($category['image'])) { ?>
                                <img src="/E-Commerce-Management-System/admin/assets/images/categories/<?= htmlspecialchars($category['image']); ?>" alt="<?= htmlspecialchars($category['name']); ?>" loading="lazy">
                            <?php } else { ?>
                                <i class="bi bi-grid card-media-placeholder"></i>
                            <?php } ?>
                        </div>

                        <div class="entity-card-body">
                            <span class="entity-subtitle">CATEGORY #<?= $category['id']; ?></span>
                            <h2 class="entity-title"><?= htmlspecialchars($category['name']); ?></h2>
                            <p class="entity-description"><?= htmlspecialchars($category['description'] ?? 'No description available.'); ?></p>

                            <div class="entity-card-footer">
                                <span class="category-status"><span class="category-status-dot" aria-hidden="true"></span>Active</span>
                                <div class="icon-action-group">
                                    <a href="show.php?id=<?= $category['id']; ?>" class="icon-action action-view" aria-label="View category" title="View Category">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                    <a href="edit.php?id=<?= $category['id']; ?>" class="icon-action action-edit" aria-label="Edit category" title="Edit Category">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <a href="delete.php?id=<?= $category['id']; ?>" class="icon-action action-delete" aria-label="Delete category" title="Delete Category">
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
                    <i class="bi bi-grid"></i>
                </div>
                <h3>No Categories Found</h3>
                <p>There are currently no categories in the store catalog.</p>
                <a href="create.php" class="btn btn-primary">
                    <i class="bi bi-plus-lg"></i>
                    <span>Add Category</span>
                </a>
            </div>
        <?php } ?>
    </main>
</div>

<?php include '../../includes/footer.php'; ?>