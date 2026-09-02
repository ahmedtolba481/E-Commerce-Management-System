<?php

include "../../includes/auth.php";
include "../../../config/database.php";

$query = "
    SELECT
        clients.*,
        users.name,
        users.email
    FROM clients
    INNER JOIN users
        ON clients.user_id = users.id
    ORDER BY clients.id DESC
";

$result = mysqli_query($conn, $query);

include "../../includes/header.php";

?>

<link rel="stylesheet" href="../../assets/css/clients.css?v=20260903">

<?php

include "../../includes/navbar.php";
include "../../includes/sidebar.php";

?>

<div class="admin-layout">
<main class="admin-content">
<div class="clients-page">

    <div class="clients-header">
        <div>
            <span class="clients-eyebrow">CUSTOMER DIRECTORY</span>
            <h1>Clients</h1>
            <p>Manage customer profiles and contact details.</p>
        </div>

        <a href="create.php" class="btn btn-primary client-create-button">
            <i class="bi bi-person-plus-fill"></i>
            New Client
        </a>
    </div>

    <div class="clients-table-wrap">
    <table class="table clients-table">

        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Address</th>
                <th>City</th>
                <th>Actions</th>
            </tr>
        </thead>

        <tbody>

        <?php while ($client = mysqli_fetch_assoc($result)) { ?>

            <tr>

                <td>
                    <?= $client["id"] ?>
                </td>

                <td>
                    <?= htmlspecialchars($client["name"]) ?>
                </td>

                <td>
                    <?= htmlspecialchars($client["email"]) ?>
                </td>

                <td>
                    <?= htmlspecialchars($client["phone"]) ?>
                </td>

                <td>
                    <?= htmlspecialchars($client["address"]) ?>
                </td>

                <td>
                    <?= htmlspecialchars($client["city"]) ?>
                </td>

                <td>

                    <div class="client-actions">

                        <a
                            href="show.php?id=<?= $client["id"] ?>"
                            class="btn btn-primary btn-sm">
                            View
                        </a>

                        <a
                            href="edit.php?id=<?= $client["id"] ?>"
                            class="btn btn-warning btn-sm">
                            Edit
                        </a>

                        <a
                            href="delete.php?id=<?= $client["id"] ?>"
                            class="btn btn-danger btn-sm"
                            onclick="return confirm('Are you sure you want to delete this client?')">
                            Delete
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

<?php

include "../../includes/footer.php";

?>