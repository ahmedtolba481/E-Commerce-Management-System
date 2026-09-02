<?php
include '../../includes/auth.php';
require_admin_role();
$pageTitle = "Edit User | ShopEase Admin";
$pageHeading = "Edit User";

include '../../../config/database.php';

$id = (int)($_GET['id'] ?? 0);
$sql = "SELECT * FROM users WHERE id = $id";
$result = mysqli_query($conn, $sql);
$user = mysqli_fetch_assoc($result);

if (!$user) {
    header("Location: index.php");
    exit;
}

$error = "";

if (isset($_POST['submit'])) {
    $name = trim($_POST["name"]);
    $role = $_POST["role"];
    $email = trim($_POST["email"]);
    $password = $_POST["password"];

    if (!in_array($role, ['Admin', 'Staff', 'Client'], true)) {
        $error = "Invalid role selected.";
    } else {
        if ($password === "") {
            $sql = "UPDATE users SET name = ?, role = ?, email = ? WHERE id = ?";
            $stmt = mysqli_prepare($conn, $sql);
            mysqli_stmt_bind_param($stmt, "sssi", $name, $role, $email, $id);
        } else {
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            $sql = "UPDATE users SET name = ?, role = ?, email = ?, password = ? WHERE id = ?";
            $stmt = mysqli_prepare($conn, $sql);
            mysqli_stmt_bind_param($stmt, "ssssi", $name, $role, $email, $hashedPassword, $id);
        }

        if (mysqli_stmt_execute($stmt)) {
            header("Location: index.php");
            exit;
        } else {
            $error = "Database Error: " . mysqli_error($conn);
        }
    }
}

include '../../includes/header.php';
?>

<div class="admin-layout">
    <?php include '../../includes/sidebar.php'; ?>

    <main class="admin-content">
        <?php include '../../includes/navbar.php'; ?>

        <div class="page-header">
            <div>
                <span class="page-eyebrow">SYSTEM & ACCESS CONTROL</span>
                <h1>Edit User #<?= $user['id'] ?></h1>
                <p>Update user details, role permissions, or password.</p>
            </div>
            <div class="page-actions">
                <a href="index.php" class="btn btn-outline">
                    <i class="bi bi-arrow-left"></i>
                    <span>Back to Users</span>
                </a>
            </div>
        </div>

        <?php if (!empty($error)) { ?>
            <div class="alert alert-danger">
                <i class="bi bi-exclamation-triangle-fill"></i>
                <span><?= htmlspecialchars($error) ?></span>
            </div>
        <?php } ?>

        <div class="form-card">
            <div class="form-header">
                <h2>Account Details</h2>
                <p class="text-muted">Update fields below to edit account info.</p>
            </div>

            <form method="POST">
                <div class="form-grid">
                    <div class="form-group">
                        <label for="name" class="form-label">Full Name <span>*</span></label>
                        <input type="text" id="name" name="name" class="form-control" value="<?= htmlspecialchars($user['name']); ?>" required>
                    </div>

                    <div class="form-group">
                        <label for="email" class="form-label">Email Address <span>*</span></label>
                        <input type="email" id="email" name="email" class="form-control" value="<?= htmlspecialchars($user['email']); ?>" required>
                    </div>

                    <div class="form-group">
                        <label for="password" class="form-label">New Password</label>
                        <input type="password" id="password" name="password" class="form-control" placeholder="Leave blank to keep current password">
                    </div>

                    <div class="form-group">
                        <label for="role" class="form-label">User Role <span>*</span></label>
                        <select id="role" name="role" class="form-select" required>
                            <option value="">Select user role...</option>
                            <option value="Admin" <?= $user['role'] === 'Admin' ? 'selected' : '' ?>>Administrator (Full Access)</option>
                            <option value="Staff" <?= $user['role'] === 'Staff' ? 'selected' : '' ?>>Staff (Operations)</option>
                            <option value="Client" <?= $user['role'] === 'Client' ? 'selected' : '' ?>>Client Account</option>
                        </select>
                    </div>
                </div>

                <div class="form-actions">
                    <a href="index.php" class="btn btn-outline">Cancel</a>
                    <button type="submit" name="submit" class="btn btn-primary">
                        <i class="bi bi-check-lg"></i>
                        <span>Save Changes</span>
                    </button>
                </div>
            </form>
        </div>
    </main>
</div>

<?php include '../../includes/footer.php'; ?>