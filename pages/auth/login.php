<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if (isset($_SESSION['user_id'])) {
    header("Location: ../../pages/home.php");
    exit;
}
include "../../includes/header.php";

$error = isset($_SESSION['auth_error']) ? $_SESSION['auth_error'] : '';
unset($_SESSION['auth_error']);
?>

<div style="min-height: 100vh; display: flex; align-items: center; justify-content: center; background: var(--background); padding: 2rem;">
    <div class="card" style="width: 100%; max-width: 450px; padding: 3rem 2rem;">
        <div style="text-align: center; margin-bottom: 2rem;">
            <a href="../home.php" style="font-size: 1.75rem; font-weight: 700; color: var(--dark); text-decoration: none; display: flex; align-items: center; justify-content: center; gap: 0.5rem;">
                <i class="bi bi-bag-check-fill" style="color: var(--primary);"></i> ShopEase
            </a>
            <h2 style="margin-top: 1.5rem; font-size: 1.5rem;">Welcome Back</h2>
            <p style="color: var(--text);">Sign in to continue to your account</p>
        </div>
        
        <?php if ($error): ?>
            <div style="background: #FEE2E2; color: #DC2626; padding: 1rem; border-radius: 8px; margin-bottom: 1.5rem; font-size: 0.9rem;">
                <?php echo htmlspecialchars($error); ?>
            </div>
        <?php endif; ?>
        
        <form action="../../actions/auth/login.php" method="POST">
            <div style="margin-bottom: 1.25rem;">
                <label class="form-label">Email Address</label>
                <input type="email" name="email" class="form-control" required placeholder="Enter your email">
            </div>
            
            <div style="margin-bottom: 2rem;">
                <div style="display: flex; justify-content: space-between; align-items: center;">
                    <label class="form-label" style="margin: 0;">Password</label>
                    <a href="#" style="font-size: 0.85rem; color: var(--primary); text-decoration: none;">Forgot password?</a>
                </div>
                <input type="password" name="password" class="form-control" style="margin-top: 0.5rem;" required placeholder="Enter your password">
            </div>
            
            <button type="submit" class="btn btn-primary" style="width: 100%; justify-content: center;">Sign In</button>
        </form>
        
        <div style="text-align: center; margin-top: 2rem; font-size: 0.9rem; color: var(--text);">
            Don't have an account? <a href="signup.php" style="color: var(--primary); font-weight: 600; text-decoration: none;">Create an account</a>
        </div>
    </div>
</div>

</body>
</html>
