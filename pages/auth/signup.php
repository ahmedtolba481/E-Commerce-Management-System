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

<main class="auth-page auth-signup-page">
    <div class="auth-shell">
        <aside class="auth-panel">
            <a href="../home.php" class="auth-brand"><i class="bi bi-bag-check-fill"></i> ShopEase</a>
            <div class="auth-panel-copy">
                <span class="auth-kicker">Make shopping personal</span>
                <h1>Everything you like, in one place.</h1>
                <p>Create your account to save your details and make every checkout simpler.</p>
            </div>
            <div class="auth-panel-footer"><i class="bi bi-lightning-charge-fill"></i> Quick, simple shopping</div>
        </aside>

        <section class="auth-form-panel">
            <div class="auth-form-header">
                <span class="auth-kicker">Join ShopEase</span>
                <h2>Create your account</h2>
                <p>Set up your details once and shop with ease.</p>
            </div>
        
        <?php if ($error): ?>
            <div class="auth-alert">
                <i class="bi bi-exclamation-circle-fill"></i>
                <span><?php echo htmlspecialchars($error); ?></span>
            </div>
        <?php endif; ?>
        
            <form action="../../actions/auth/signup.php" method="POST" class="auth-signup-form">
                <div class="auth-form-grid">
                <div class="auth-field">
                    <label class="form-label">Full Name</label>
                    <div class="auth-input-wrap"><i class="bi bi-person"></i><input type="text" name="name" class="form-control" required autocomplete="name" placeholder="Your full name"></div>
                </div>
                <div class="auth-field">
                    <label class="form-label">Email Address</label>
                    <div class="auth-input-wrap"><i class="bi bi-envelope"></i><input type="email" name="email" class="form-control" required autocomplete="email" placeholder="you@example.com"></div>
                </div>
            
                <div class="auth-field">
                    <label class="form-label">Phone Number</label>
                    <div class="auth-input-wrap"><i class="bi bi-telephone"></i><input type="text" name="phone" class="form-control" required autocomplete="tel" placeholder="Your phone number"></div>
                </div>
                <div class="auth-field">
                    <label class="form-label">City</label>
                    <div class="auth-input-wrap"><i class="bi bi-geo-alt"></i><input type="text" name="city" class="form-control" required autocomplete="address-level2" placeholder="Your city"></div>
                </div>
                </div>
            <div class="auth-field">
                <label class="form-label">Address</label>
                <div class="auth-input-wrap"><i class="bi bi-house"></i><input type="text" name="address" class="form-control" required autocomplete="street-address" placeholder="Street and building address"></div>
            </div>
            
            <div class="auth-field auth-password-field">
                <label class="form-label">Password (Min 8 characters)</label>
                <div class="auth-input-wrap"><i class="bi bi-lock"></i><input type="password" name="password" class="form-control" required minlength="8" autocomplete="new-password" placeholder="At least 8 characters"></div>
            </div>
            
                <button type="submit" class="btn btn-primary auth-submit">Create account <i class="bi bi-arrow-right"></i></button>
            </form>
        
            <div class="auth-signup">Already have an account? <a href="login.php">Sign in</a></div>
        </section>
    </div>
</main>

</body>
</html>
