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
          LEFT JOIN clients ON users.id = clients.user_id
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

<section class="section profile-page">
    <div class="container">
        <div class="profile-heading">
            <div>
                <span class="profile-kicker">Account settings</span>
                <h1>My profile</h1>
                <p>Keep your contact and delivery details up to date.</p>
            </div>
            <a href="../home.php" class="profile-back-link"><i class="bi bi-arrow-left"></i> Back to shop</a>
        </div>

        <div class="profile-layout">
            <aside class="card profile-identity">
                <div class="profile-avatar"><i class="bi bi-person"></i></div>
                <h2><?php echo htmlspecialchars($user['name']); ?></h2>
                <p><?php echo htmlspecialchars($user['email']); ?></p>
                <span class="profile-role"><i class="bi bi-person-badge"></i> <?php echo htmlspecialchars($_SESSION['user_role'] ?? 'Client'); ?></span>
                <div class="profile-identity-divider"></div>
                <div class="profile-identity-note"><i class="bi bi-shield-check"></i><span>Your account details are kept private and secure.</span></div>
                <a href="../auth/logout.php" class="profile-logout"><i class="bi bi-box-arrow-right"></i> Log out</a>
            </aside>

            <div class="card profile-details">
                <div class="profile-section-heading">
                    <div class="profile-section-icon"><i class="bi bi-person-lines-fill"></i></div>
                    <div><span class="profile-kicker">Personal details</span><h2>Contact information</h2></div>
                </div>
                    
                    <?php if ($message): ?>
                        <div class="profile-alert profile-alert-success">
                            <i class="bi bi-check-circle-fill"></i> <?php echo htmlspecialchars($message); ?>
                        </div>
                    <?php endif; ?>
                    
                    <?php if ($error): ?>
                        <div class="profile-alert profile-alert-error">
                            <i class="bi bi-exclamation-triangle-fill"></i> <?php echo htmlspecialchars($error); ?>
                        </div>
                    <?php endif; ?>
                    
                    <form action="../../actions/profile/update.php" method="POST" class="profile-form">
                        <div class="profile-form-grid">
                            <div>
                                <label class="form-label">Full Name</label>
                                <input type="text" name="name" class="form-control" value="<?php echo htmlspecialchars($user['name']); ?>" required>
                            </div>
                            <div>
                                <label class="form-label">Email Address</label>
                                <input type="email" name="email" class="form-control" value="<?php echo htmlspecialchars($user['email']); ?>" readonly style="background: #F3F4F6;">
                                <div style="font-size: 0.8rem; color: #9CA3AF; margin-top: 0.25rem;">Email cannot be changed.</div>
                            </div>
                        
                            <div>
                                <label class="form-label">Phone Number</label>
                                <input type="text" name="phone" class="form-control" value="<?php echo htmlspecialchars($user['phone'] ?? ''); ?>" required>
                            </div>
                            <div>
                                <label class="form-label">City</label>
                                <input type="text" name="city" class="form-control" value="<?php echo htmlspecialchars($user['city'] ?? ''); ?>" required>
                            </div>
                        </div>
                        <div class="profile-address-field">
                            <label class="form-label">Address</label>
                            <input type="text" name="address" class="form-control" value="<?php echo htmlspecialchars($user['address'] ?? ''); ?>" required>
                        </div>
                        
                        <div class="profile-form-actions">
                            <a href="../orders/index.php" class="btn btn-secondary"><i class="bi bi-box-seam"></i> View my orders</a>
                            <button type="submit" class="btn btn-primary"><i class="bi bi-check2"></i> Save changes</button>
                        </div>
                    </form>
            </div>
        </div>
    </div>
</section>

<?php
include "../../includes/footer.php";
?>
