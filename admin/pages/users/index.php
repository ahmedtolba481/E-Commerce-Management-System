<?php
// include '../../includes/auth.php';
$pageTitle = "Users | SmartStore";
$pageKey = "users";

include '../../includes/header.php';
include '../../includes/navbar.php';
include '../../../config/database.php';

$query = "SELECT * FROM users";
$result = mysqli_query($conn, $query);

?>

<div class="admin-layout">

    <?php include '../../includes/sidebar.php'; ?>

    <main class="admin-content">

        <?php if (isset($_GET['error']) && $_GET['error'] == 'orders') { ?>

            <div class="delete-error">
                You can't delete this user because they have orders.
            </div>

        <?php } ?>

        <div class="page-header">

            <div>
                <div class="page-eyebrow">Management</div>

                <h1>Users</h1>

                <p>Manage system users and their accounts.</p>
            </div>

            <div class="page-actions">

                <a href="create.php" class="btn btn-primary">

                    <i class="bi bi-plus-lg"></i>

                    Add User

                </a>

            </div>

        </div>


        <div class="users-table-card">

            <div class="section-heading" style="padding: 22px 24px 0;">

                <div>

                    <div class="section-eyebrow">
                        System Users
                    </div>

                    <h2>
                        All Users
                    </h2>

                </div>

            </div>


            <div class="table-responsive">

                <table class="users-table">

                    <thead>

                        <tr>

                            <th>#</th>

                            <th>Name</th>

                            <th>Email</th>

                            <th>Role</th>

                            <th>Created At</th>

                            <th>Actions</th>

                        </tr>

                    </thead>


                    <tbody>

                        <?php while ($user = mysqli_fetch_array($result)) { ?>

                            <tr>

                                <td>
                                    <?php echo $user['id']; ?>
                                </td>


                                <td>

                                    <strong>
                                        <?php echo $user['name']; ?>
                                    </strong>

                                </td>


                                <td>
                                    <?php echo $user['email']; ?>
                                </td>


                                <td>

                                    <span class="user-role">

                                        <?php echo $user['role']; ?>

                                    </span>

                                </td>


                                <td>
                                    <?php echo $user['created_at']; ?>
                                </td>


                                <td>

                                    <div class="user-actions">

                                        <a
                                            href="edit.php?id=<?= $user['id']; ?>"
                                            class="user-action edit"
                                            title="Edit"
                                        >

                                            <i class="bi bi-pencil"></i>

                                        </a>


                                        <a
                                            href="delete.php?id=<?= $user['id']; ?>"
                                            class="user-action delete"
                                            title="Delete"
                                        >

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