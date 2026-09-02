<?php

$pageTitle = "Categories | SmartStore";
$pageKey = "categories";

include '../../includes/header.php';
include '../../includes/navbar.php';
include '../../../config/database.php';

$query = 'SELECT * from categories;';
$result = mysqli_query($conn, $query);

?>

<div class="admin-layout">

    <?php include '../../includes/sidebar.php'; ?>

    <main class="admin-content">

        <div class="page-header">
            <div>
                <div class="page-eyebrow">Management</div>
                <h1>Categories</h1>
                <p>Manage system categories.</p>
            </div>

            <div class="page-actions">
                <a href="create.php" class="btn btn-primary">
                    <i class="bi bi-plus-lg"></i>
                    Add Categories
                </a>
            </div>
        </div>

        <div class="users-table-card">

    <div class="section-heading" style="padding: 22px 24px 0;">
        <div>
            <div class="section-eyebrow">System Categories</div>
            <h2>All Categories</h2>
        </div>
    </div>

    <div class="table-responsive">

        <table class="users-table">

                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Image</th>
                            <th>Created At</th>
                            <th>Actions</th>
                        </tr>
                    </thead>

                    <tbody>

                        <?php while ($categories = mysqli_fetch_array($result)) { ?>

                            <tr>

                                <td>
                                    <?php echo $categories['id']; ?>
                                </td>

                                <td>
                                    <strong><?php echo $categories['name']; ?></strong>
                                </td>

                                <td>
                                    <?php echo ($categories['description']); ?>
                                </td>

                                <td>
                                    <span class="categories$categories-role">
                                        <img src="/E-Commerce-Management-System/admin/assets/images/categories/<?php echo ($categories['image']); ?>" alt="<?php echo ($categories['image']); ?>">
                                    </span>
                                </td>

                                <td>
                                    <?php echo $categories['created_at']; ?>
                                </td>

                                <td>
                                    <div class="categories$categories-actions">

                                        <a href="edit.php?id=<?= $categories['id']; ?>"
                                        class="categories$categories-action edit"
                                        title="Edit">
                                            <i class="bi bi-pencil"></i>
                                        </a>

                                        <a href="delete.php?id=<?= $categories['id']; ?>"
                                        class="categories$categories-action delete"
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