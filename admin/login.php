<?php

session_start();

if (isset($_SESSION['admin_id']) && in_array($_SESSION['admin_role'] ?? '', ['Admin', 'Staff'], true)) {

    header("Location: index.php");
    exit;

}


include '../config/database.php';

$error = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $email = trim($_POST['email']);
    $password = $_POST['password'];


    // Validation

    if ($email === "" || $password === "") {

        $error = "Please enter your email and password.";

    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {

        $error = "Please enter a valid email address.";

    } else {

        $stmt = mysqli_prepare($conn, "SELECT id, name, email, password, role FROM users WHERE email = ? LIMIT 1");
        mysqli_stmt_bind_param($stmt, "s", $email);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $user = mysqli_fetch_assoc($result);

        if ($user && password_verify($password, $user['password']) && in_array($user['role'], ['Admin', 'Staff'], true)) {
            session_regenerate_id(true);
            $_SESSION['admin_id'] = $user['id'];
            $_SESSION['admin_name'] = $user['name'];
            $_SESSION['admin_email'] = $user['email'];
            $_SESSION['admin_role'] = $user['role'];
            header("Location: index.php");
            exit;
        } else {
            $error = "Invalid email or password.";
        }

    }

}

?>
<?php
$pageTitle = "Admin Login | SmartStore";
$bodyClass = "login-page";
include './includes/header.php';
?>

    <div class="login-container">

        <section class="login-brief">
            <div class="login-brief-mark">
                <i class="bi bi-bag-heart-fill"></i>
            </div>

            <span class="login-brief-label">SMARTSTORE / CONTROL CENTER</span>

            <h2>Keep every order moving.</h2>

            <p>
                A focused workspace for your store team, inventory, and customer operations.
            </p>

            <div class="login-brief-status">
                <span class="status-dot"></span>
                Secure staff access
            </div>
        </section>

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