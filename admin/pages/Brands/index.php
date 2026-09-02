<?php

$pageTitle = "Brands | SmartStore";
$pageKey = "brands";

include '../../includes/header.php';
include '../../includes/navbar.php';
include '../../../config/database.php';

$query = 'SELECT * from brands;';
$result = mysqli_query($conn, $query);

?>

<div class="admin-layout">

    <?php include '../../includes/sidebar.php'; ?>

    <main class="admin-content">

        <div class="page-header">
            <div>
                <div class="page-eyebrow">Management</div>
                <h1>Brands</h1>
                <p>Manage brands.</p>
            </div>

            <div class="page-actions">
                <a href="create.php" class="btn btn-primary">
                    <i class="bi bi-plus-lg"></i>
                    Add Brands
                </a>
            </div>
        </div>

        <div class="users-table-card">

    <div class="section-heading" style="padding: 22px 24px 0;">
        <div>
            <div class="section-eyebrow">System Brands</div>
            <h2>All Brands</h2>
        </div>
    </div>

    <div class="table-responsive">

        <table class="users-table">

                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Logo</th>
                            <th>Created At</th>
                            <th>Actions</th>
                        </tr>
                    </thead>

                    <tbody>

                        <?php while ($brands = mysqli_fetch_array($result)) { ?>

                            <tr>

                                <td>
                                    <?php echo $brands['id']; ?>
                                </td>

                                <td>
                                    <strong><?php echo $brands['name']; ?></strong>
                                </td>

                                <td>
                                    <?php echo ($brands['description']); ?>
                                </td>

                                <td>
                                    <span class="brands$brands-role">
                                        <img src="/E-Commerce-Management-System/admin/assets/images/brands/<?php echo ($brands['logo']); ?>" alt="<?php echo ($brands['logo']); ?>">
                                    </span>
                                </td>

                                <td>
                                    <?php echo $brands['created_at']; ?>
                                </td>

                                <td>
                                    <div class="brands$brands-actions">

                                        <a href="edit.php?id=<?= $brands['id']; ?>"
                                        class="brands$brands-action edit"
                                        title="Edit">
                                            <i class="bi bi-pencil"></i>
                                        </a>

                                        <a href="delete.php?id=<?= $brands['id']; ?>"
                                        class="brands$brands-action delete"
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