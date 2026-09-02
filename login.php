<?php
include 'config/database.php';
session_start();

$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['login'])) {
    $email    = trim($_POST['email']);
    $password = trim($_POST['password']);

    if (!empty($email) && !empty($password)) {
        $email = $conn->real_escape_string($email);
        
        $sql = "SELECT * FROM users WHERE email = '$email'";
        $result = $conn->query($sql);

        if ($result && $result->num_rows > 0) {
            $user = $result->fetch_assoc();
            
            // التحقق من الباسورد (سواء كان مشفر أو نص عادي مؤقتاً للتجربة)
            if (password_verify($password, $user['password']) || $password === $user['password']) {
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['user_name'] = $user['name'];
                $_SESSION['user_role'] = $user['role'];
                
                header("Location: index.php");
                exit();
            } else {
                $error = "Invalid password!";
            }
        } else {
            $error = "No account found with this email!";
        }
    } else {
        $error = "Please fill in all fields.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SmartStore - Sign In</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body class="bg-light d-flex align-items-center justify-content-center" style="min-height: 100vh;">

    <div class="card border-0 shadow-sm rounded-4 p-4 p-md-5" style="width: 100%; max-width: 480px; background-color: #ffffff;">
        <div class="text-center mb-4">
            <h2 class="fw-bold fs-3 mb-1">Welcome Back</h2>
            <p class="text-muted small">Sign in to your account</p>
        </div>

        <?php if(!empty($error)): ?>
            <div class="alert alert-danger py-2 small"><?php echo $error; ?></div>
        <?php endif; ?>

        <form action="" method="POST">
            <div class="mb-3">
                <div class="input-group">
                    <span class="input-group-text bg-white border-end-0 text-muted"><i class="bi bi-envelope"></i></span>
                    <input type="email" class="form-control border-start-0 ps-0" name="email" placeholder="Email address" required>
                </div>
            </div>

            <div class="mb-3">
                <div class="input-group">
                    <span class="input-group-text bg-white border-end-0 text-muted"><i class="bi bi-lock"></i></span>
                    <input type="password" class="form-control border-start-0 ps-0" name="password" placeholder="Password" required>
                    <span class="input-group-text bg-white border-start-0 text-muted"><i class="bi bi-eye"></i></span>
                </div>
            </div>

            <div class="d-flex justify-content-between align-items-center mb-4 small">
                <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="remember">
                    <label class="form-check-label text-muted" for="remember">Remember me</label>
                </div>
                <a href="#" class="text-decoration-none fw-semibold text-primary">Forgot password?</a>
            </div>

            <button type="submit" name="login" class="btn btn-primary w-100 py-2 fw-bold rounded-3 shadow-sm mb-3" style="background-color: #0d6efd;">
                Sign In <i class="bi bi-arrow-right ms-1"></i>
            </button>
        </form>

        <div class="text-center position-relative my-3">
            <hr class="text-muted opacity-25">
            <span class="position-absolute top-50 start-50 translate-middle px-2 bg-white text-muted small" style="font-size: 11px;">OR</span>
        </div>

        <button class="btn btn-outline-dark w-100 py-2 rounded-3 d-flex align-items-center justify-content-center gap-2 mb-4 bg-white text-dark border">
            <i class="bi bi-google"></i> <span class="fw-semibold small">Continue with Google</span>
        </button>

        <div class="text-center text-muted small">
            Don't have an account? <a href="register.php" class="fw-bold text-decoration-none text-primary">Create account</a>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>