<?php

include "../../../config/database.php";

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

$error = "";
$name = "";
$email = "";
$phone = "";
$address = "";
$city = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = trim($_POST["name"] ?? "");
    $email = trim($_POST["email"] ?? "");
    $password = $_POST["password"] ?? "";
    $phone = trim($_POST["phone"] ?? "");
    $address = trim($_POST["address"] ?? "");
    $city = trim($_POST["city"] ?? "");

    if ($name === "" || $email === "" || $password === "" || $phone === "" || $address === "" || $city === "") {
        $error = "All fields are required.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Enter a valid email address.";
    } else {
        mysqli_begin_transaction($conn);

        try {
            $userQuery = mysqli_prepare(
                $conn,
                "INSERT INTO users (name, email, password, role) VALUES (?, ?, ?, 'Clients')"
            );
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            mysqli_stmt_bind_param($userQuery, "sss", $name, $email, $hashedPassword);
            mysqli_stmt_execute($userQuery);
            $userId = mysqli_insert_id($conn);

            $clientQuery = mysqli_prepare(
                $conn,
                "INSERT INTO clients (user_id, phone, address, city) VALUES (?, ?, ?, ?)"
            );
            mysqli_stmt_bind_param($clientQuery, "isss", $userId, $phone, $address, $city);
            mysqli_stmt_execute($clientQuery);

            mysqli_commit($conn);
            header("Location: index.php");
            exit;
        } catch (mysqli_sql_exception $exception) {
            mysqli_rollback($conn);
            $error = $exception->getCode() === 1062
                ? "That email address is already in use."
                : "Unable to create the client right now.";
        }
    }
}

include "../../includes/header.php";
?>
<link rel="stylesheet" href="../../assets/css/clients.css">
<?php
include "../../includes/navbar.php";
include "../../includes/sidebar.php";
?>

<div class="clients-page">
    <div class="clients-header">
        <div>
            <span class="clients-eyebrow">CUSTOMER DIRECTORY</span>
            <h1>New Client</h1>
            <p>Create a customer account and profile in one step.</p>
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
                    <h2>Login details</h2>
                    <label for="name">Full name</label>
                    <input id="name" type="text" name="name" value="<?= htmlspecialchars($name) ?>" required>
                    <label for="email">Email address</label>
                    <input id="email" type="email" name="email" value="<?= htmlspecialchars($email) ?>" required>
                    <label for="password">Temporary password</label>
                    <input id="password" type="password" name="password" required>
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

<?php include "../../includes/footer.php"; ?>
