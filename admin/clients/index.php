<?php

include "../../config/database.php";

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

include "../includes/header.php";

?>

<link rel="stylesheet" href="../assets/css/clients.css">

<?php

include "../includes/navbar.php";
include "../includes/sidebar.php";

?>

<div class="clients-page">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Clients</h2>
    </div>

    <table class="table table-bordered table-striped">

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

<?php

include "../includes/footer.php";

?>