<?php
include '../../includes/auth.php';
require_admin_role();
$pageTitle = "Partners | ShopEase Admin";
$pageHeading = "Partners";

include '../../includes/header.php';
include '../../../config/database.php';

$query = 'SELECT * FROM partners ORDER BY id DESC;';
$result = mysqli_query($conn, $query);

$partnersList = [];
if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
        $partnersList[] = $row;
    }
}
?>

<div class="admin-layout">
    <?php include '../../includes/sidebar.php'; ?>

    <main class="admin-content">
        <?php include '../../includes/navbar.php'; ?>

        <div class="page-header">
            <div>
                <span class="page-eyebrow">ORGANIZATION & SUPPLIERS</span>
                <h1>Partners</h1>
                <p>Manage store brand partners, sponsors, and suppliers.</p>
            </div>

            <div class="page-actions">
                <a href="create.php" class="btn btn-primary">
                    <i class="bi bi-plus-lg"></i>
                    <span>Add Partner</span>
                </a>
            </div>
        </div>

        <?php if (!empty($partnersList)) { ?>
            <div class="entity-card-grid">
                <?php foreach ($partnersList as $partner) { ?>
                    <article class="entity-card">
                        <div class="card-media-wrap logo-container">
                            <?php if (!empty($partner['logo'])) { ?>
                                <img src="/E-Commerce-Management-System/admin/assets/images/partners/<?= htmlspecialchars($partner['logo']); ?>" alt="<?= htmlspecialchars($partner['name']); ?>" loading="lazy">
                            <?php } else { ?>
                                <i class="bi bi-buildings card-media-placeholder"></i>
                            <?php } ?>
                        </div>

                        <div class="entity-card-body">
                            <span class="entity-subtitle">PARTNER #<?= $partner['id']; ?></span>
                            <h2 class="entity-title"><?= htmlspecialchars($partner['name']); ?></h2>
                            
                            <?php if (!empty($partner['website'])) { ?>
                                <a href="<?= htmlspecialchars($partner['website']); ?>" target="_blank" class="info-row text-decoration-none mt-1 mb-2">
                                    <i class="bi bi-link-45deg text-primary"></i>
                                    <span class="text-truncate" style="max-width: 200px;"><?= htmlspecialchars($partner['website']); ?></span>
                                </a>
                            <?php } else { ?>
                                <p class="entity-description mt-1 mb-2">No website link provided.</p>
                            <?php } ?>

                            <div class="entity-card-footer">
                                <span class="badge badge-mint">Official Partner</span>
                                <div class="icon-action-group">
                                    <a href="edit.php?id=<?= $partner['id']; ?>" class="icon-action action-edit" aria-label="Edit partner" title="Edit Partner">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <a href="delete.php?id=<?= $partner['id']; ?>" class="icon-action action-delete" aria-label="Delete partner" title="Delete Partner">
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
                    <i class="bi bi-buildings"></i>
                </div>
                <h3>No Partners Found</h3>
                <p>There are currently no partner organizations added to the system.</p>
                <a href="create.php" class="btn btn-primary">
                    <i class="bi bi-plus-lg"></i>
                    <span>Add Partner</span>
                </a>
            </div>
        <?php } ?>
    </main>
</div>

<?php include '../../includes/footer.php'; ?>