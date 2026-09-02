<?php

include "../../config/database.php";

$query = "SELECT id, name, email, role, created_at
        FROM users
        ORDER BY id DESC";

$result = mysqli_query($conn, $query);

include "../includes/header.php";

?>

<link rel="stylesheet" href="../assets/css/users.css">

<?php

include "../includes/navbar.php";
include "../includes/sidebar.php";

?>

<div class="users-page">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <h2>Users</h2>

        <a href="create.php" class="btn btn-primary">
            Add User
        </a>

    </div>

    <table class="table table-bordered table-striped">

        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Role</th>
                <th>Created At</th>
                <th>Actions</th>
            </tr>
        </thead>

        <tbody>

        <?php while ($user = mysqli_fetch_assoc($result)) { ?>

            <tr>

                <td>
                    <?= $user["id"] ?>
                </td>

                <td>
                    <?= htmlspecialchars($user["name"]) ?>
                </td>

                <td>
                    <?= htmlspecialchars($user["email"]) ?>
                </td>

                <td>
                    <?= htmlspecialchars($user["role"]) ?>
                </td>

                <td>
                    <?= $user["created_at"] ?>
                </td>

                <td>

                    <div class="user-actions">

                        <a
                            href="edit.php?id=<?= $user["id"] ?>"
                            class="btn btn-primary btn-sm">
                            Edit
                        </a>

                        <a
                            href="delete.php?id=<?= $user["id"] ?>"
                            class="btn btn-danger btn-sm"
                            onclick="return confirm('Are you sure you want to delete this user?')">
                            Delete
                        </a>

                    </div>

                </td>

            </tr>

        <?php } ?>

        </tbody>

    </table>

</div>

<?php

include "../includes/footer.php";

?>