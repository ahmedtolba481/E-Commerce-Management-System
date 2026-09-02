<?php

include "../../config/database.php";

$error = "";

$name = "";
$email = "";
$role = "user";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name = trim($_POST["name"]);
    $email = trim($_POST["email"]);
    $password = $_POST["password"];
    $role = $_POST["role"];

    if ($name == "" || $email == "" || $password == "") {

        $error = "All fields are required.";

    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {

        $error = "Please enter a valid email.";

    } elseif (strlen($password) < 6) {

        $error = "Password must be at least 6 characters.";

    } else {

        $check = mysqli_prepare(
            $conn,
            "SELECT id FROM users WHERE email = ?"
        );

        mysqli_stmt_bind_param($check, "s", $email);

        mysqli_stmt_execute($check);

        mysqli_stmt_store_result($check);

        if (mysqli_stmt_num_rows($check) > 0) {

            $error = "Email already exists.";

        } else {

            $hashedPassword = password_hash(
                $password,
                PASSWORD_DEFAULT
            );

            $query = mysqli_prepare(
                $conn,
                "INSERT INTO users
                (name, email, password, role)
                VALUES (?, ?, ?, ?)"
            );

            mysqli_stmt_bind_param(
                $query,
                "ssss",
                $name,
                $email,
                $hashedPassword,
                $role
            );

            mysqli_stmt_execute($query);

            header("Location: index.php");
            exit;
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

    <h2 class="mb-4">Add User</h2>

    <?php if ($error != "") { ?>

        <div class="alert alert-danger">
            <?= $error ?>
        </div>

    <?php } ?>

    <form method="POST">

        <div class="mb-3">

            <label class="form-label">Name</label>

            <input
                type="text"
                name="name"
                class="form-control"
                value="<?= htmlspecialchars($name) ?>"
                required>

        </div>

        <div class="mb-3">

            <label class="form-label">Email</label>

            <input
                type="email"
                name="email"
                class="form-control"
                value="<?= htmlspecialchars($email) ?>"
                required>

        </div>

        <div class="mb-3">

            <label class="form-label">Password</label>

            <input
                type="password"
                name="password"
                class="form-control"
                minlength="6"
                required>

        </div>

        <div class="mb-3">

            <label class="form-label">Role</label>

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
            Add User
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