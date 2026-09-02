<?php

include "../../config/database.php";

if (!isset($_GET["id"])) {
    header("Location: index.php");
    exit;
}

$id = (int) $_GET["id"];

$query = mysqli_prepare(
    $conn,
    "SELECT
        clients.*,
        users.name,
        users.email
     FROM clients
     INNER JOIN users
        ON clients.user_id = users.id
     WHERE clients.id = ?"
);

mysqli_stmt_bind_param($query, "i", $id);

mysqli_stmt_execute($query);

$result = mysqli_stmt_get_result($query);

$client = mysqli_fetch_assoc($result);

if (!$client) {
    header("Location: index.php");
    exit;
}

include "../includes/header.php";

?>

<link rel="stylesheet" href="../assets/css/clients.css">

<?php

include "../includes/navbar.php";
include "../includes/sidebar.php";

?>

<div class="clients-page">

    <h2 class="mb-4">Client Details</h2>

    <div class="card">

        <div class="card-body">

            <p>
                <strong>ID:</strong>
                <?= $client["id"] ?>
            </p>

            <p>
                <strong>Name:</strong>
                <?= htmlspecialchars($client["name"]) ?>
            </p>

            <p>
                <strong>Email:</strong>
                <?= htmlspecialchars($client["email"]) ?>
            </p>

            <p>
                <strong>Phone:</strong>
                <?= htmlspecialchars($client["phone"]) ?>
            </p>

            <p>
                <strong>Address:</strong>
                <?= htmlspecialchars($client["address"]) ?>
            </p>

            <p>
                <strong>City:</strong>
                <?= htmlspecialchars($client["city"]) ?>
            </p>

            <p>
                <strong>Created At:</strong>
                <?= $client["created_at"] ?>
            </p>

            <a
                href="edit.php?id=<?= $client["id"] ?>"
                class="btn btn-primary">
                Edit
            </a>

            <a
                href="index.php"
                class="btn btn-secondary">
                Back
            </a>

        </div>

    </div>

</div>

<?php

include "../includes/footer.php";

?>