<?php

session_start();


// If already logged in, go to dashboard
if (isset($_SESSION['admin_id'])) {

    header("Location: index.php");
    exit;

}


include '../config/database.php';


$error = "";


// Login
if (isset($_POST['submit'])) {

    $email = trim($_POST['email']);
    $password = $_POST['password'];


    // Validation

    if ($email == "" || $password == "") {

        $error = "Please enter your email and password.";

    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {

        $error = "Please enter a valid email address.";

    } else {

        // Get user
        $sql = "SELECT id, name, email, password, role
                FROM users
                WHERE email = ?
                LIMIT 1";

        $stmt = mysqli_prepare($conn, $sql);

        mysqli_stmt_bind_param($stmt, "s", $email);

        mysqli_stmt_execute($stmt);

        $result = mysqli_stmt_get_result($stmt);

        $user = mysqli_fetch_assoc($result);


        // Verify user and password
        if ($user && password_verify($password, $user['password'])) {

            // Only admin and staff can access dashboard
            if ($user['role'] !== 'admin' && $user['role'] !== 'staff') {

                $error = "You do not have permission to access the admin dashboard.";

            } else {

                // Regenerate session ID
                session_regenerate_id(true);


                // Store admin information
                $_SESSION['admin_id'] = $user['id'];
                $_SESSION['admin_name'] = $user['name'];
                $_SESSION['admin_email'] = $user['email'];
                $_SESSION['admin_role'] = $user['role'];


                // Go to dashboard
                header("Location: index.php");
                exit;

            }

        } else {

            // Generic error
            $error = "Invalid email or password.";

        }

    }

}

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Admin Login | SmartStore</title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css"
        rel="stylesheet"
    >

    <link
        rel="stylesheet"
        href="/E-Commerce-Management-System/admin/assets/css/admin.css"
    >

</head>


<body class="login-page">

    <div class="login-container">

        <div class="login-card">


            <div class="login-header">

                <div class="login-icon">
                    <i class="bi bi-shield-lock"></i>
                </div>

                <h1>
                    SmartStore
                </h1>

                <p>
                    Admin Dashboard
                </p>

            </div>


            <?php if ($error != "") { ?>

                <div class="login-error">

                    <i class="bi bi-exclamation-circle"></i>

                    <?= htmlspecialchars($error); ?>

                </div>

            <?php } ?>


            <form method="POST">


                

                <div class="form-group">

                    <label
                        for="email"
                        class="form-label"
                    >
                        Email
                    </label>

                    <input
                        type="email"
                        id="email"
                        name="email"
                        class="form-input"
                        placeholder="Enter your email"
                        value="<?= htmlspecialchars($_POST['email'] ?? ''); ?>"
                        autocomplete="email"
                        required
                    >

                </div>


                

                <div class="form-group">

                    <label
                        for="password"
                        class="form-label"
                    >
                        Password
                    </label>

                    <input
                        type="password"
                        id="password"
                        name="password"
                        class="form-input"
                        placeholder="Enter your password"
                        autocomplete="current-password"
                        required
                    >

                </div>


                <button
                    type="submit"
                    name="submit"
                    class="btn-primary login-button"
                >

                    <i class="bi bi-box-arrow-in-right"></i>

                    Login

                </button>


            </form>

        </div>

    </div>

</body>

</html>