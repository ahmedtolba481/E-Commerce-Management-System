<?php
include "../../includes/auth.php";
include "../../../config/database.php";

if (!isset($_GET["id"])) {
    header("Location: index.php");
    exit;
}

$id = (int)$_GET["id"];

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

        mysqli_stmt_bind_param($update, "sssi", $phone, $address, $city, $id);
        mysqli_stmt_execute($update);

        header("Location: show.php?id=" . $id);
        exit;
    }
}

$pageTitle = "Edit Client | ShopEase Admin";
$pageHeading = "Edit Client";

include "../../includes/header.php";
?>

<div class="admin-layout">
    <?php include "../../includes/sidebar.php"; ?>

    <main class="admin-content">
        <?php include "../../includes/navbar.php"; ?>

        <div class="page-header">
            <div>
                <span class="page-eyebrow">CUSTOMER DIRECTORY</span>
                <h1>Edit Client Profile #<?= $client['id'] ?></h1>
                <p>Update phone, address, or city details.</p>
            </div>
            <div class="page-actions">
                <a href="show.php?id=<?= $id ?>" class="btn btn-outline">
                    <i class="bi bi-arrow-left"></i>
                    <span>Back to Profile</span>
                </a>
            </div>
        </div>

        <?php if ($error !== "") { ?>
            <div class="alert alert-danger">
                <i class="bi bi-exclamation-triangle-fill"></i>
                <span><?= htmlspecialchars($error) ?></span>
            </div>
        <?php } ?>

        <div class="form-card">
            <div class="form-header">
                <h2>Modify Profile</h2>
                <p class="text-muted">Account details are linked to the user account.</p>
            </div>

            <form method="POST">
                <div class="form-grid">
                    <div class="form-group">
                        <label class="form-label">Client Name</label>
                        <input type="text" class="form-control bg-light" value="<?= htmlspecialchars($client["name"]) ?>" disabled>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Account Email</label>
                        <input type="email" class="form-control bg-light" value="<?= htmlspecialchars($client["email"]) ?>" disabled>
                    </div>

                    <div class="form-group">
                        <label for="phone" class="form-label">Phone Number <span>*</span></label>
                        <input type="text" id="phone" name="phone" class="form-control" value="<?= htmlspecialchars($phone) ?>" required>
                    </div>

                    <div class="form-group">
                        <label for="city" class="form-label">City <span>*</span></label>
                        <input type="text" id="city" name="city" class="form-control" value="<?= htmlspecialchars($city) ?>" required>
                    </div>

                    <div class="form-group full-width">
                        <label for="address" class="form-label">Address <span>*</span></label>
                        <input type="text" id="address" name="address" class="form-control" value="<?= htmlspecialchars($address) ?>" required>
                    </div>
                </div>

                <div class="form-actions">
                    <a href="show.php?id=<?= $id ?>" class="btn btn-outline">Cancel</a>
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-check-lg"></i>
                        <span>Save Changes</span>
                    </button>
                </div>
            </form>
        </div>
    </main>
</div>

<?php include "../../includes/footer.php"; ?>