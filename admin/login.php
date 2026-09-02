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

$pageTitle = "Admin Portal Sign In | ShopEase";
include './includes/header.php';
?>

<div class="login-page-body">
    <div class="login-card-container">
        <div class="login-brand-header">
            <div class="login-brand-icon">
                <i class="bi bi-bag-check-fill"></i>
            </div>
            <h1>Shop<span>Ease</span></h1>
            <p>E-Commerce Administration Portal</p>
            <div class="login-badge">
                <i class="bi bi-shield-lock-fill"></i>
                <span>Authorized Staff Only</span>
            </div>
        </div>

        <form method="POST" action="">
            <div class="form-group mb-3">
                <label for="email" class="form-label font-weight-bold">Email Address <span>*</span></label>
                <div class="login-input-wrap">
                    <input
                        type="email"
                        id="email"
                        name="email"
                        class="form-control"
                        placeholder="admin@shopease.com"
                        value="<?= htmlspecialchars($_POST['email'] ?? ''); ?>"
                        autocomplete="email"
                        required
                    >
                    <i class="bi bi-envelope login-input-icon"></i>
                </div>
            </div>

            <div class="form-group mb-4">
                <label for="password" class="form-label font-weight-bold">Password <span>*</span></label>
                <div class="login-input-wrap">
                    <input
                        type="password"
                        id="password"
                        name="password"
                        class="form-control"
                        placeholder="••••••••"
                        autocomplete="current-password"
                        required
                    >
                    <i class="bi bi-lock login-input-icon"></i>
                    <button type="button" class="toggle-password-btn" id="togglePassword" aria-label="Toggle password visibility" title="Show/Hide Password">
                        <i class="bi bi-eye" id="togglePasswordIcon"></i>
                    </button>
                </div>
            </div>

            <button type="submit" name="submit" class="login-btn-primary">
                <span>Sign In to Dashboard</span>
                <i class="bi bi-arrow-right"></i>
            </button>

            <!-- Error message located cleanly at bottom of form below input controls & button -->
            <?php if (!empty($error)) { ?>
                <div class="alert alert-danger mt-4 mb-0">
                    <i class="bi bi-exclamation-triangle-fill"></i>
                    <span><?= htmlspecialchars($error); ?></span>
                </div>
            <?php } ?>
        </form>

        <div class="login-footer-info">
            <i class="bi bi-shield-check"></i>
            <span>Secured Session • ShopEase Management Control</span>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const togglePasswordBtn = document.getElementById('togglePassword');
    const passwordInput = document.getElementById('password');
    const togglePasswordIcon = document.getElementById('togglePasswordIcon');

    if (togglePasswordBtn && passwordInput && togglePasswordIcon) {
        togglePasswordBtn.addEventListener('click', function() {
            const isPassword = passwordInput.getAttribute('type') === 'password';
            passwordInput.setAttribute('type', isPassword ? 'text' : 'password');
            togglePasswordIcon.className = isPassword ? 'bi bi-eye-slash' : 'bi bi-eye';
        });
    }
});
</script>

<?php include './includes/footer.php'; ?>