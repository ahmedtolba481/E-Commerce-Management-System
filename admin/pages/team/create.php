<?php
include '../../includes/auth.php';
require_admin_role();
$pageTitle = "Add Team Member | ShopEase Admin";
$pageHeading = "Add Member";

include '../../../config/database.php';

$error = "";

if (isset($_POST['submit'])) {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $position = mysqli_real_escape_string($conn, $_POST['position']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    $facebook = mysqli_real_escape_string($conn, $_POST['facebook']);
    $instagram = mysqli_real_escape_string($conn, $_POST['instagram']);
    $linkedin = mysqli_real_escape_string($conn, $_POST['linkedin']);

    $imageName = $_FILES['image']['name'] ?? '';
    $imageTmpName = $_FILES['image']['tmp_name'] ?? '';

    $uploadDirectory = '../../assets/images/team/';
    if (!is_dir($uploadDirectory)) {
        mkdir($uploadDirectory, 0777, true);
    }

    $newImageName = "";
    if (!empty($imageName)) {
        $imageExtension = pathinfo($imageName, PATHINFO_EXTENSION);
        $newImageName = uniqid() . '.' . $imageExtension;
        move_uploaded_file($imageTmpName, $uploadDirectory . $newImageName);
    }

    $sql = "INSERT INTO team (name, position, description, image, facebook, instagram, linkedin)
            VALUES ('$name', '$position', '$description', '$newImageName', '$facebook', '$instagram', '$linkedin')";

    if (mysqli_query($conn, $sql)) {
        header("Location: index.php");
        exit;
    } else {
        $error = "Database Error: " . mysqli_error($conn);
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
                <span class="page-eyebrow">ORGANIZATION</span>
                <h1>Add Team Member</h1>
                <p>Register a new staff member or executive profile.</p>
            </div>
            <div class="page-actions">
                <a href="index.php" class="btn btn-outline">
                    <i class="bi bi-arrow-left"></i>
                    <span>Back to Team</span>
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
                <h2>Member Information</h2>
                <p class="text-muted">Enter position, bio, photo, and social links.</p>
            </div>

            <form method="POST" enctype="multipart/form-data">
                <div class="form-grid">
                    <div class="form-group">
                        <label for="name" class="form-label">Full Name <span>*</span></label>
                        <input type="text" id="name" name="name" class="form-control" placeholder="e.g. Sarah Connor" required>
                    </div>

                    <div class="form-group">
                        <label for="position" class="form-label">Position / Job Title <span>*</span></label>
                        <input type="text" id="position" name="position" class="form-control" placeholder="e.g. Head of Customer Operations" required>
                    </div>

                    <div class="form-group">
                        <label for="image" class="form-label">Profile Photo <span>*</span></label>
                        <input type="file" id="image" name="image" class="form-control" accept="image/*" required>
                    </div>

                    <div class="form-group">
                        <label for="facebook" class="form-label">Facebook Profile URL</label>
                        <input type="url" id="facebook" name="facebook" class="form-control" placeholder="https://facebook.com/username">
                    </div>

                    <div class="form-group">
                        <label for="instagram" class="form-label">Instagram Profile URL</label>
                        <input type="url" id="instagram" name="instagram" class="form-control" placeholder="https://instagram.com/username">
                    </div>

                    <div class="form-group">
                        <label for="linkedin" class="form-label">LinkedIn Profile URL</label>
                        <input type="url" id="linkedin" name="linkedin" class="form-control" placeholder="https://linkedin.com/in/username">
                    </div>

                    <div class="form-group full-width">
                        <label for="description" class="form-label">Biography / Description <span>*</span></label>
                        <textarea id="description" name="description" class="form-control" placeholder="Write a short summary about this team member..." required></textarea>
                    </div>

                    <div class="form-group full-width">
                        <label class="form-label">Profile Photo Preview</label>
                        <div class="image-preview-container" style="height: 220px;">
                            <div class="image-preview-placeholder">
                                <i class="bi bi-person fs-1 text-primary"></i>
                                <p class="m-0 small text-muted">Select a photo above to see live preview</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-actions">
                    <a href="index.php" class="btn btn-outline">Cancel</a>
                    <button type="submit" name="submit" class="btn btn-primary">
                        <i class="bi bi-plus-lg"></i>
                        <span>Add Member</span>
                    </button>
                </div>
            </form>
        </div>
    </main>
</div>

<?php include '../../includes/footer.php'; ?>