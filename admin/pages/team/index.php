<?php
include '../../includes/auth.php';
require_admin_role();
$pageTitle = "Team Members | ShopEase Admin";
$pageHeading = "Team Members";

include '../../includes/header.php';
include '../../../config/database.php';

$query = 'SELECT * FROM team ORDER BY id DESC;';
$result = mysqli_query($conn, $query);

$teamList = [];
if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
        $teamList[] = $row;
    }
}
?>

<div class="admin-layout">
    <?php include '../../includes/sidebar.php'; ?>

    <main class="admin-content">
        <?php include '../../includes/navbar.php'; ?>

        <div class="page-header">
            <div>
                <span class="page-eyebrow">ORGANIZATION</span>
                <h1>Team Members</h1>
                <p>Manage store staff and executive profiles.</p>
            </div>

            <div class="page-actions">
                <a href="create.php" class="btn btn-primary">
                    <i class="bi bi-plus-lg"></i>
                    <span>Add Member</span>
                </a>
            </div>
        </div>

        <?php if (!empty($teamList)) { ?>
            <div class="entity-card-grid">
                <?php foreach ($teamList as $member) { ?>
                    <article class="entity-card">
                        <div class="card-media-wrap profile-container">
                            <?php if (!empty($member['image'])) { ?>
                                <img src="/E-Commerce-Management-System/admin/assets/images/team/<?= htmlspecialchars($member['image']); ?>" alt="<?= htmlspecialchars($member['name']); ?>" loading="lazy">
                            <?php } else { ?>
                                <i class="bi bi-person card-media-placeholder"></i>
                            <?php } ?>
                        </div>

                        <div class="entity-card-body">
                            <span class="entity-subtitle"><?= htmlspecialchars($member['position'] ?? 'Team Member'); ?></span>
                            <h2 class="entity-title"><?= htmlspecialchars($member['name']); ?></h2>
                            <p class="entity-description"><?= htmlspecialchars($member['description'] ?? 'No bio description available.'); ?></p>

                            <!-- Social Links -->
                            <div class="social-links">
                                <?php if (!empty($member['facebook'])) { ?>
                                    <a href="<?= htmlspecialchars($member['facebook']); ?>" target="_blank" class="social-icon" title="Facebook"><i class="bi bi-facebook"></i></a>
                                <?php } ?>
                                <?php if (!empty($member['instagram'])) { ?>
                                    <a href="<?= htmlspecialchars($member['instagram']); ?>" target="_blank" class="social-icon" title="Instagram"><i class="bi bi-instagram"></i></a>
                                <?php } ?>
                                <?php if (!empty($member['linkedin'])) { ?>
                                    <a href="<?= htmlspecialchars($member['linkedin']); ?>" target="_blank" class="social-icon" title="LinkedIn"><i class="bi bi-linkedin"></i></a>
                                <?php } ?>
                            </div>

                            <div class="entity-card-footer">
                                <span class="badge badge-mint">Active Staff</span>
                                <div class="icon-action-group">
                                    <a href="edit.php?id=<?= $member['id']; ?>" class="icon-action action-edit" aria-label="Edit team member" title="Edit Member">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <a href="delete.php?id=<?= $member['id']; ?>" class="icon-action action-delete" aria-label="Delete team member" title="Delete Member">
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
                    <i class="bi bi-people"></i>
                </div>
                <h3>No Team Members Found</h3>
                <p>There are currently no staff members in your team directory.</p>
                <a href="create.php" class="btn btn-primary">
                    <i class="bi bi-plus-lg"></i>
                    <span>Add Member</span>
                </a>
            </div>
        <?php } ?>
    </main>
</div>

<?php include '../../includes/footer.php'; ?>