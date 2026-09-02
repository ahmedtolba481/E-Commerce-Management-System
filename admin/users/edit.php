<?php

include "../../config/database.php";

if (!isset($_GET["id"])) {
    header("Location: index.php");
    exit;
}

$id = (int) $_GET["id"];

$query = mysqli_prepare(
    $conn,
    "SELECT * FROM users WHERE id = ?"
);

mysqli_stmt_bind_param($query, "i", $id);
mysqli_stmt_execute($query);

$result = mysqli_stmt_get_result($query);
$user = mysqli_fetch_assoc($result);

if (!$user) {
    header("Location: index.php");
    exit;
}

$name = $user["name"];
$email = $user["email"];
$role = $user["role"];

$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name = trim($_POST["name"]);
    $email = trim($_POST["email"]);
    $role = $_POST["role"];
    $password = $_POST["password"];

    if ($name == "" || $email == "") {

        $error = "Name and email are required.";

    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {

        $error = "Please enter a valid email.";

    } else {

        $check = mysqli_prepare(
            $conn,
            "SELECT id FROM users
             WHERE email = ? AND id != ?"
        );

        mysqli_stmt_bind_param(
            $check,
            "si",
            $email,
            $id
        );

        mysqli_stmt_execute($check);
        mysqli_stmt_store_result($check);

        if (mysqli_stmt_num_rows($check) > 0) {

            $error = "Email already exists.";

        } else {

            if ($password != "") {

                if (strlen($password) < 6) {

                    $error = "Password must be at least 6 characters.";

                } else {

                    $hashedPassword = password_hash(
                        $password,
                        PASSWORD_DEFAULT
                    );

                    $update = mysqli_prepare(
                        $conn,
                        "UPDATE users
                         SET name = ?,
                             email = ?,
                             password = ?,
                             role = ?
                         WHERE id = ?"
                    );

                    mysqli_stmt_bind_param(
                        $update,
                        "ssssi",
                        $name,
                        $email,
                        $hashedPassword,
                        $role,
                        $id
                    );

                    mysqli_stmt_execute($update);

                    header("Location: index.php");
                    exit;
                }

            } else {

                $update = mysqli_prepare(
                    $conn,
                    "UPDATE users
                     SET name = ?,
                         email = ?,
                         role = ?
                     WHERE id = ?"
                );

                mysqli_stmt_bind_param(
                    $update,
                    "sssi",
                    $name,
                    $email,
                    $role,
                    $id
                );

                mysqli_stmt_execute($update);

                header("Location: index.php");
                exit;
            }
        }
    }
}

include "../includes/header.php";

?>

<link rel="stylesheet" href="../assets/css/users.css">

<?php

include "../includes/navbar.php";
include "../includes/sidebar.php";

?>

<div class="users-page">

    <h2 class="mb-4">Edit User</h2>

    <?php if ($error != "") { ?>

        <div class="alert alert-danger">
            <?= $error ?>
        </div>

    <?php } ?>

    <form method="POST">

        <div class="mb-3">

            <label class="form-label">
                Name
            </label>

            <input
                type="text"
                name="name"
                class="form-control"
                value="<?= htmlspecialchars($name) ?>"
                required>

        </div>

        <div class="mb-3">

            <label class="form-label">
                Email
            </label>

            <input
                type="email"
                name="email"
                class="form-control"
                value="<?= htmlspecialchars($email) ?>"
                required>

        </div>

        <div class="mb-3">

            <label class="form-label">
                New Password
            </label>

            <input
                type="password"
                name="password"
                class="form-control"
                minlength="6">

            <small class="text-muted">
                Leave empty if you do not want to change the password.
            </small>

        </div>

        <div class="mb-3">

            <label class="form-label">
                Role
            </label>

            <select
                name="role"
                class="form-select">

                <option
                    value="user"
                    <?= $role == "user" ? "selected" : "" ?>>
                    User
                </option>

                <option
                    value="admin"
                    <?= $role == "admin" ? "selected" : "" ?>>
                    Admin
                </option>

            </select>

        </div>

        <button
            type="submit"
            class="btn btn-primary">
            Update User
        </button>

        <a
            href="index.php"
            class="btn btn-secondary">
            Back
        </a>

    </form>

</div>

<?php

include "../includes/footer.php";

?>