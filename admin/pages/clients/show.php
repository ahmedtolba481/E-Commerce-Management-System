<?php

include "../../includes/auth.php";
include "../../../config/database.php";

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
            <h1>Client profile</h1>
            <p>Review contact information and account details.</p>
        </div>
        <div class="client-header-actions">
            <a href="index.php" class="btn btn-light"><i class="bi bi-arrow-left"></i> Back</a>
            <a href="edit.php?id=<?= $client["id"] ?>" class="btn btn-primary"><i class="bi bi-pencil"></i> Edit client</a>
        </div>
    </div>

    <div class="client-detail-card">
        <div class="client-profile-heading">
            <div class="client-avatar"><?= strtoupper(substr($client["name"], 0, 1)) ?></div>
            <div>
                <span class="clients-eyebrow">CLIENT #<?= $client["id"] ?></span>
                <h2><?= htmlspecialchars($client["name"]) ?></h2>
                <p><?= htmlspecialchars($client["email"]) ?></p>
            </div>
        </div>

        <div class="client-detail-grid">
            <div><span>Phone</span><strong><?= htmlspecialchars($client["phone"]) ?></strong></div>
            <div><span>City</span><strong><?= htmlspecialchars($client["city"]) ?></strong></div>
            <div class="client-detail-wide"><span>Address</span><strong><?= htmlspecialchars($client["address"]) ?></strong></div>
            <div><span>Created</span><strong><?= htmlspecialchars($client["created_at"]) ?></strong></div>
        </div>
    </div>
</div>
</main>
</div>

<?php

include "../../includes/footer.php";

?>