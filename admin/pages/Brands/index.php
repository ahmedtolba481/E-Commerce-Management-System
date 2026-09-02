<?php
include '../../includes/auth.php';
require_admin_role();
$pageTitle = "Brands | ShopEase Admin";
$pageHeading = "Brands";

include '../../includes/header.php';
include '../../../config/database.php';

$query = 'SELECT * FROM brands ORDER BY id DESC;';
$result = mysqli_query($conn, $query);

$brandsList = [];
if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
        $brandsList[] = $row;
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
                <h1>Brands</h1>
                <p>Manage product brands and manufacturers.</p>
            </div>

            <div class="page-actions">
                <a href="create.php" class="btn btn-primary">
                    <i class="bi bi-plus-lg"></i>
                    <span>Add Brand</span>
                </a>
            </div>
        </div>

        <?php if (!empty($brandsList)) { ?>
            <div class="entity-card-grid">
                <?php foreach ($brandsList as $brand) { ?>
                    <article class="entity-card">
                        <div class="card-media-wrap logo-container">
                            <?php if (!empty($brand['logo'])) { ?>
                                <img src="/E-Commerce-Management-System/admin/assets/images/brands/<?= htmlspecialchars($brand['logo']); ?>" alt="<?= htmlspecialchars($brand['name']); ?>" loading="lazy">
                            <?php } else { ?>
                                <i class="bi bi-patch-check card-media-placeholder"></i>
                            <?php } ?>
                        </div>

                        <div class="entity-card-body">
                            <span class="entity-subtitle">BRAND #<?= $brand['id']; ?></span>
                            <h2 class="entity-title"><?= htmlspecialchars($brand['name']); ?></h2>
                            <p class="entity-description"><?= htmlspecialchars($brand['description'] ?? 'No description available.'); ?></p>

                            <div class="entity-card-footer">
                                <span class="badge badge-mint">Official Brand</span>
                                <div class="icon-action-group">
                                    <a href="edit.php?id=<?= $brand['id']; ?>" class="icon-action action-edit" aria-label="Edit brand" title="Edit Brand">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <a href="delete.php?id=<?= $brand['id']; ?>" class="icon-action action-delete" aria-label="Delete brand" title="Delete Brand">
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
                    <i class="bi bi-patch-check"></i>
                </div>
                <h3>No Brands Found</h3>
                <p>There are currently no product brands in your system.</p>
                <a href="create.php" class="btn btn-primary">
                    <i class="bi bi-plus-lg"></i>
                    <span>Add Brand</span>
                </a>
            </div>
        <?php } ?>
    </main>
</div>

<?php include '../../includes/footer.php'; ?>