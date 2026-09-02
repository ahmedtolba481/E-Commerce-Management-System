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

$phone = $client["phone"];
$address = $client["address"];
$city = $client["city"];

$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $phone = trim($_POST["phone"]);
    $address = trim($_POST["address"]);
    $city = trim($_POST["city"]);

    if ($phone == "" || $address == "" || $city == "") {

        $error = "Phone, address and city are required.";

    } else {

        $update = mysqli_prepare(
            $conn,
            "UPDATE clients
             SET phone = ?,
                 address = ?,
                 city = ?
             WHERE id = ?"
        );

        mysqli_stmt_bind_param(
            $update,
            "sssi",
            $phone,
            $address,
            $city,
            $id
        );

        mysqli_stmt_execute($update);

        header("Location: show.php?id=" . $id);
        exit;
    }
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
            <h1>Edit client</h1>
            <p>Update the customer's contact information.</p>
        </div>
    </div>

    <?php if ($error != "") { ?>

        <div class="alert alert-danger">
            <?= $error ?>
        </div>

    <?php } ?>

    <div class="client-form-card">
    <form method="POST">

        <div class="client-form-grid">
        <div class="client-form-section">
            <span class="clients-eyebrow">ACCOUNT</span>
            <h2>Account details</h2>

            <label class="form-label">Name</label>

            <input
                type="text"
                class="form-control"
                value="<?= htmlspecialchars($client["name"]) ?>"
                disabled>

        </div>


        <div class="client-form-section">
            <span class="clients-eyebrow">PROFILE</span>
            <h2>Contact details</h2>

            <label class="form-label">Email</label>

            <input
                type="email"
                class="form-control"
                value="<?= htmlspecialchars($client["email"]) ?>"
                disabled>

        </div>


        <div class="client-form-section">

            <label class="form-label">Phone</label>

            <input
                type="text"
                name="phone"
                class="form-control"
                value="<?= htmlspecialchars($phone) ?>"
                required>

        </div>


        <div class="client-form-section">

            <label class="form-label">Address</label>

            <input
                type="text"
                name="address"
                class="form-control"
                value="<?= htmlspecialchars($address) ?>"
                required>

        </div>


        <div class="client-form-section">

            <label class="form-label">City</label>

            <input
                type="text"
                name="city"
                class="form-control"
                value="<?= htmlspecialchars($city) ?>"
                required>

        </div>
        </div>


        <div class="client-form-actions">
            <a href="show.php?id=<?= $id ?>" class="btn btn-light">Cancel</a>
            <button type="submit" class="btn btn-primary"><i class="bi bi-check2"></i> Save changes</button>
        </div>

    </form>
    </div>

</div>
</main>
</div>

<?php

include "../../includes/footer.php";

?>