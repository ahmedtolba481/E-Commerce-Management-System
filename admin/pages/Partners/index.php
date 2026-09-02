<?php

$pageTitle = "Partners | SmartStore";
$pageKey = "users";

include '../../includes/header.php';
include '../../includes/navbar.php';
include '../../../config/database.php';

$query = 'SELECT * from partners;';
$result = mysqli_query($conn, $query);

?>

<div class="admin-layout">

    <?php include '../../includes/sidebar.php'; ?>

    <main class="admin-content">

        <div class="page-header">
            <div>
                <div class="page-eyebrow">Management</div>
                <h1>Partners</h1>
                <p>Manage system partners.</p>
            </div>

            <div class="page-actions">
                <a href="create.php" class="btn btn-primary">
                    <i class="bi bi-plus-lg"></i>
                    Add Partner
                </a>
            </div>
        </div>

        <div class="users-table-card">

    <div class="section-heading" style="padding: 22px 24px 0;">
        <div>
            <div class="section-eyebrow">System Partners</div>
            <h2>All Partners</h2>
        </div>
    </div>

    <div class="table-responsive">

        <table class="users-table">

                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Logo</th>
                            <th>Website</th>
                            <th>Created At</th>
                            <th>Actions</th>
                        </tr>
                    </thead>

                    <tbody>

                        <?php while ($partner = mysqli_fetch_array($result)) { ?>

                            <tr>

                                <td>
                                    <?php echo $partner['id']; ?>
                                </td>

                                <td>
                                    <strong><?php echo $partner['name']; ?></strong>
                                </td>

                                <td>
                                    <span class="partners$partners-role">
                                        <img src="/E-Commerce-Management-System/admin/assets/images/partners/<?php echo ($partner['logo']); ?>" alt="<?php echo ($partners['logo']); ?>">
                                    </span>
                                </td>

                                <td>
                                    <span class="partner-role">
                                        <?php echo ($partner['website']); ?>
                                    </span>
                                </td>

                                <td>
                                    <?php echo $partner['created_at']; ?>
                                </td>

                                <td>
                                    <div class="partner-actions">

                                        <a href="edit.php?id=<?= $partner['id']; ?>"
                                        class="partner-action edit"
                                        title="Edit">
                                            <i class="bi bi-pencil"></i>
                                        </a>

                                        <a href="delete.php?id=<?= $partner['id']; ?>"
                                        class="partner-action delete"
                                        title="Delete">
                                            <i class="bi bi-trash"></i>
                                        </a>

                                    </div>
                                </td>

                            </tr>

                        <?php } ?>

                    </tbody>

                </table>

            </div>

        </div>

    </main>

</div>

<?php include '../../includes/footer.php'; ?>