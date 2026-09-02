<?php

include "../../includes/auth.php";
include "../../../config/database.php";

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

$error = "";
$userId = 0;
$phone = "";
$address = "";
$city = "";

$usersQuery = mysqli_query(
    $conn,
    "SELECT id, name, email
     FROM users
     WHERE role = 'Client'
       AND id NOT IN (SELECT user_id FROM clients)
     ORDER BY name ASC"
);

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $userId = (int) ($_POST["user_id"] ?? 0);
    $phone = trim($_POST["phone"] ?? "");
    $address = trim($_POST["address"] ?? "");
    $city = trim($_POST["city"] ?? "");

    if ($userId <= 0 || $phone === "" || $address === "" || $city === "") {
        $error = "Select a client and complete all profile fields.";
    } else {
        try {
            $clientQuery = mysqli_prepare(
                $conn,
                "INSERT INTO clients (user_id, phone, address, city) VALUES (?, ?, ?, ?)"
            );
            mysqli_stmt_bind_param($clientQuery, "isss", $userId, $phone, $address, $city);
            mysqli_stmt_execute($clientQuery);

            header("Location: index.php");
            exit;
        } catch (mysqli_sql_exception $exception) {
            $error = $exception->getCode() === 1062 ? "This user already has a client profile." : "Unable to create the client right now.";
        }
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
            <h1>New Client</h1>
            <p>Complete the profile for an existing client account.</p>
        </div>
    </div>

    <div class="client-form-card">
        <?php if ($error !== "") { ?>
            <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
        <?php } ?>

        <form method="POST">
            <div class="client-form-grid">
                <div class="client-form-section">
                    <span class="clients-eyebrow">ACCOUNT</span>
                    <h2>Select client</h2>
                    <label for="user_id">Client account</label>
                    <select id="user_id" name="user_id" class="form-select" required>
                        <option value="">Choose an available client</option>
                        <?php while ($user = mysqli_fetch_assoc($usersQuery)) { ?>
                            <option value="<?= $user["id"] ?>" <?= $userId === (int) $user["id"] ? "selected" : "" ?>>
                                <?= htmlspecialchars($user["name"] . " - " . $user["email"]) ?>
                            </option>
                        <?php } ?>
                    </select>
                    <small class="form-help">Name and email come from the selected user account.</small>
                </div>

                <div class="client-form-section">
                    <span class="clients-eyebrow">PROFILE</span>
                    <h2>Contact details</h2>
                    <label for="phone">Phone</label>
                    <input id="phone" type="text" name="phone" value="<?= htmlspecialchars($phone) ?>" required>
                    <label for="address">Address</label>
                    <input id="address" type="text" name="address" value="<?= htmlspecialchars($address) ?>" required>
                    <label for="city">City</label>
                    <input id="city" type="text" name="city" value="<?= htmlspecialchars($city) ?>" required>
                </div>
            </div>

            <div class="client-form-actions">
                <a href="index.php" class="btn btn-light">Cancel</a>
                <button type="submit" class="btn btn-primary"><i class="bi bi-person-plus-fill"></i> Create Client</button>
            </div>
        </form>
    </div>
</div>
</main>
</div>

<?php include "../../includes/footer.php"; ?>
