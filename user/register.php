<?php
include 'config/database.php';

$success = "";
$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['register'])) {
    $name     = trim($_POST['name']);
    $email    = trim($_POST['email']);
    $password = trim($_POST['password']);

    if (!empty($name) && !empty($email) && !empty($password)) {
        $name  = $conn->real_escape_string($name);
        $email = $conn->real_escape_string($email);
        
        // التحقق مما إذا كان الإيميل مسجلاً مسبقاً
        $check_sql = "SELECT * FROM users WHERE email = '$email'";
        $check_res = $conn->query($check_sql);

        if ($check_res && $check_res->num_rows > 0) {
            $error = "This email is already registered!";
        } else {
            // تشفير كلمة المرور بأمان
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            // إدخال المستخدم الجديد في الجدول مع تحديد الـ role كـ user
            $insert_sql = "INSERT INTO users (name, email, password, role) VALUES ('$name', '$email', '$hashed_password', 'user')";
            
            if ($conn->query($insert_sql) === TRUE) {
                $success = "Account created successfully! You can now <a href='login.php'>Sign In</a>";
            } else {
                $error = "Error: " . $conn->error;
            }
        }
    } else {
        $error = "Please fill in all required fields.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SmartStore - Create Account</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body class="bg-light d-flex align-items-center justify-content-center" style="min-height: 100vh;">

    <div class="card border-0 shadow-sm rounded-4 p-4 p-md-5" style="width: 100%; max-width: 480px; background-color: #ffffff;">
        <div class="text-center mb-4">
            <h2 class="fw-bold fs-3 mb-1">Create Account</h2>
            <p class="text-muted small">Join SmartStore today</p>
        </div>

        <?php if(!empty($success)): ?>
            <div class="alert alert-success py-2 small"><?php echo $success; ?></div>
        <?php endif; ?>

        <?php if(!empty($error)): ?>
            <div class="alert alert-danger py-2 small"><?php echo $error; ?></div>
        <?php endif; ?>

        <form action="" method="POST">
            <div class="mb-3">
                <div class="input-group">
                    <span class="input-group-text bg-white border-end-0 text-muted"><i class="bi bi-person"></i></span>
                    <input type="text" class="form-control border-start-0 ps-0" name="name" placeholder="Full Name" required>
                </div>
            </div>

            <div class="mb-3">
                <div class="input-group">
                    <span class="input-group-text bg-white border-end-0 text-muted"><i class="bi bi-envelope"></i></span>
                    <input type="email" class="form-control border-start-0 ps-0" name="email" placeholder="Email address" required>
                </div>
            </div>

            <div class="mb-4">
                <div class="input-group">
                    <span class="input-group-text bg-white border-end-0 text-muted"><i class="bi bi-lock"></i></span>
                    <input type="password" class="form-control border-start-0 ps-0" name="password" placeholder="Password" required>
                </div>
            </div>

            <button type="submit" name="register" class="btn btn-primary w-100 py-2 fw-bold rounded-3 shadow-sm mb-3" style="background-color: #0d6efd;">
                Sign Up <i class="bi bi-arrow-right ms-1"></i>
            </button>
        </form>

        <div class="text-center text-muted small">
            Already have an account? <a href="login.php" class="fw-bold text-decoration-none text-primary">Sign In</a>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>