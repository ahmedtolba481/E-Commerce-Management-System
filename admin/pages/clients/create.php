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
    $userId = (int)($_POST["user_id"] ?? 0);
    $phone = trim($_POST["phone"] ?? "");
    $address = trim($_POST["address"] ?? "");
    $city = trim($_POST["city"] ?? "");

    if ($userId <= 0 || $phone === "" || $address === "" || $city === "") {
        $error = "Select a client user account and complete all contact fields.";
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

$pageTitle = "New Client | ShopEase Admin";
$pageHeading = "New Client";

include "../../includes/header.php";
?>

<div class="admin-layout">
    <?php include "../../includes/sidebar.php"; ?>

    <main class="admin-content">
        <?php include "../../includes/navbar.php"; ?>

        <div class="page-header">
            <div>
                <span class="page-eyebrow">CUSTOMER DIRECTORY</span>
                <h1>Add New Client</h1>
                <p>Complete the contact profile for a registered user account.</p>
            </div>
            <div class="page-actions">
                <a href="index.php" class="btn btn-outline">
                    <i class="bi bi-arrow-left"></i>
                    <span>Back to Clients</span>
                </a>
            </div>
        </div>

        <?php if (!empty($error)) { ?>
            <div class="alert alert-danger">
                <i class="bi bi-exclamation-triangle-fill"></i>
                <span><?= htmlspecialchars($error) ?></span>
            </div>
        <?php } ?>

        <div class="form-card">
            <div class="form-header">
                <h2>Client Details</h2>
                <p class="text-muted">Link a user account and enter address & contact details.</p>
            </div>

            <form method="POST">
                <div class="form-grid">
                    <div class="form-group full-width">
                        <label for="user_id" class="form-label">Client Account <span>*</span></label>
                        <select id="user_id" name="user_id" class="form-select" required>
                            <option value="">Choose an available user account...</option>
                            <?php while ($user = mysqli_fetch_assoc($usersQuery)) { ?>
                                <option value="<?= $user["id"] ?>" <?= $userId === (int)$user["id"] ? "selected" : "" ?>>
                                    <?= htmlspecialchars($user["name"] . " (" . $user["email"] . ")") ?>
                                </option>
                            <?php } ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="phone" class="form-label">Phone Number <span>*</span></label>
                        <input type="text" id="phone" name="phone" class="form-control" placeholder="+1 555 019 2831" value="<?= htmlspecialchars($phone) ?>" required>
                    </div>

                    <div class="form-group">
                        <label for="city" class="form-label">City <span>*</span></label>
                        <input type="text" id="city" name="city" class="form-control" placeholder="New York" value="<?= htmlspecialchars($city) ?>" required>
                    </div>

                    <div class="form-group full-width">
                        <label for="address" class="form-label">Full Address <span>*</span></label>
                        <input type="text" id="address" name="address" class="form-control" placeholder="123 Shopping Avenue, Suite 400" value="<?= htmlspecialchars($address) ?>" required>
                    </div>
                </div>

                <div class="form-actions">
                    <a href="index.php" class="btn btn-outline">Cancel</a>
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-person-plus-fill"></i>
                        <span>Create Client Profile</span>
                    </button>
                </div>
            </form>
        </div>
    </main>
</div>

<?php include "../../includes/footer.php"; ?>
