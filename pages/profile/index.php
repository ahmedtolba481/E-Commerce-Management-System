<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include "../../config/database.php";

if (!isset($_SESSION['user_id'])) {
    header("Location: ../auth/login.php");
    exit;
}

$user_id = (int)$_SESSION['user_id'];
$query = "SELECT users.name, users.email, clients.phone, clients.address, clients.city 
          FROM users 
          JOIN clients ON users.id = clients.user_id 
          WHERE users.id = $user_id LIMIT 1";
$result = mysqli_query($conn, $query);

if (!$result || mysqli_num_rows($result) == 0) {
    header("Location: ../auth/logout.php");
    exit;
}

$user = mysqli_fetch_assoc($result);

include "../../includes/header.php";
include "../../includes/navbar.php";

$message = isset($_SESSION['profile_msg']) ? $_SESSION['profile_msg'] : '';
$error = isset($_SESSION['profile_error']) ? $_SESSION['profile_error'] : '';
unset($_SESSION['profile_msg'], $_SESSION['profile_error']);
?>

<section class="section" style="background: var(--background); min-height: 80vh;">
    <div class="container">
        <div class="row" style="justify-content: center;">
            <div class="col-md-8">
                <div class="card" style="padding: 3rem;">
                    <div style="text-align: center; margin-bottom: 3rem;">
                        <div style="width: 100px; height: 100px; background: var(--primary); color: white; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 3rem; margin: 0 auto 1.5rem;">
                            <i class="bi bi-person"></i>
                        </div>
                        <h2>My Profile</h2>
                        <p style="color: var(--text);">Manage your account details and information</p>
                    </div>
                    
                    <?php if ($message): ?>
                        <div style="background: var(--light-mint); color: var(--primary); padding: 1rem; border-radius: 8px; margin-bottom: 1.5rem; text-align: center;">
                            <i class="bi bi-check-circle-fill"></i> <?php echo htmlspecialchars($message); ?>
                        </div>
                    <?php endif; ?>
                    
                    <?php if ($error): ?>
                        <div style="background: #FEE2E2; color: #DC2626; padding: 1rem; border-radius: 8px; margin-bottom: 1.5rem; text-align: center;">
                            <i class="bi bi-exclamation-triangle-fill"></i> <?php echo htmlspecialchars($error); ?>
                        </div>
                    <?php endif; ?>
                    
                    <form action="../../actions/profile/update.php" method="POST">
                        <div class="row" style="margin-bottom: 1.5rem;">
                            <div class="col-md-6">
                                <label class="form-label">Full Name</label>
                                <input type="text" name="name" class="form-control" value="<?php echo htmlspecialchars($user['name']); ?>" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Email Address</label>
                                <input type="email" name="email" class="form-control" value="<?php echo htmlspecialchars($user['email']); ?>" readonly style="background: #F3F4F6;">
                                <div style="font-size: 0.8rem; color: #9CA3AF; margin-top: 0.25rem;">Email cannot be changed.</div>
                            </div>
                        </div>
                        
                        <div class="row" style="margin-bottom: 1.5rem;">
                            <div class="col-md-6">
                                <label class="form-label">Phone Number</label>
                                <input type="text" name="phone" class="form-control" value="<?php echo htmlspecialchars($user['phone']); ?>" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">City</label>
                                <input type="text" name="city" class="form-control" value="<?php echo htmlspecialchars($user['city']); ?>" required>
                            </div>
                        </div>
                        
                        <div style="margin-bottom: 2.5rem;">
                            <label class="form-label">Address</label>
                            <input type="text" name="address" class="form-control" value="<?php echo htmlspecialchars($user['address']); ?>" required>
                        </div>
                        
                        <div style="display: flex; gap: 1rem; justify-content: space-between;">
                            <a href="../orders/index.php" class="btn btn-secondary"><i class="bi bi-box-seam"></i> View My Orders</a>
                            <button type="submit" class="btn btn-primary px-5">Save Changes</button>
                        </div>
                    </form>
                </div>
                
                <div style="text-align: center; margin-top: 2rem;">
                    <a href="../auth/logout.php" style="color: #DC2626; text-decoration: none; font-weight: 500;"><i class="bi bi-box-arrow-right"></i> Logout of account</a>
                </div>
            </div>
        </div>
    </div>
</section>

<?php
include "../../includes/footer.php";
?>
