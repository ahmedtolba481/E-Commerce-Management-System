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
    <div class="card" style="width: 100%; max-width: 600px; padding: 3rem 2rem;">
        <div style="text-align: center; margin-bottom: 2rem;">
            <a href="../home.php" style="font-size: 1.75rem; font-weight: 700; color: var(--dark); text-decoration: none; display: flex; align-items: center; justify-content: center; gap: 0.5rem;">
                <i class="bi bi-bag-check-fill" style="color: var(--primary);"></i> ShopEase
            </a>
            <h2 style="margin-top: 1.5rem; font-size: 1.5rem;">Create Account</h2>
            <p style="color: var(--text);">Join us for the best shopping experience</p>
        </div>
        
        <?php if ($error): ?>
            <div style="background: #FEE2E2; color: #DC2626; padding: 1rem; border-radius: 8px; margin-bottom: 1.5rem; font-size: 0.9rem;">
                <?php echo htmlspecialchars($error); ?>
            </div>
        <?php endif; ?>
        
        <form action="../../actions/auth/signup.php" method="POST">
            <div class="row">
                <div class="col-md-6" style="margin-bottom: 1rem;">
                    <label class="form-label">Full Name</label>
                    <input type="text" name="name" class="form-control" required>
                </div>
                <div class="col-md-6" style="margin-bottom: 1rem;">
                    <label class="form-label">Email Address</label>
                    <input type="email" name="email" class="form-control" required>
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-6" style="margin-bottom: 1rem;">
                    <label class="form-label">Phone Number</label>
                    <input type="text" name="phone" class="form-control" required>
                </div>
                <div class="col-md-6" style="margin-bottom: 1rem;">
                    <label class="form-label">City</label>
                    <input type="text" name="city" class="form-control" required>
                </div>
            </div>
            
            <div style="margin-bottom: 1rem;">
                <label class="form-label">Address</label>
                <input type="text" name="address" class="form-control" required>
            </div>
            
            <div style="margin-bottom: 2rem;">
                <label class="form-label">Password (Min 6 characters)</label>
                <input type="password" name="password" class="form-control" required minlength="6">
            </div>
            
            <button type="submit" class="btn btn-primary" style="width: 100%; justify-content: center;">Create Account</button>
        </form>
        
        <div style="text-align: center; margin-top: 2rem; font-size: 0.9rem; color: var(--text);">
            Already have an account? <a href="login.php" style="color: var(--primary); font-weight: 600; text-decoration: none;">Sign in</a>
        </div>
    </div>
</div>

</body>
</html>
