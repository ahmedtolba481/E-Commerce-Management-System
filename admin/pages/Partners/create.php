<?php
include '../../includes/auth.php';
require_admin_role();
$pageTitle = "Add Partner | ShopEase Admin";
$pageHeading = "Add Partner";

include '../../../config/database.php';

$error = "";

if (isset($_POST['submit'])) {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $website = mysqli_real_escape_string($conn, $_POST['website']);

    $logoName = $_FILES['logo']['name'] ?? '';
    $logoTmpName = $_FILES['logo']['tmp_name'] ?? '';

    $uploadDirectory = '../../assets/images/partners/';
    if (!is_dir($uploadDirectory)) {
        mkdir($uploadDirectory, 0777, true);
    }

    $newLogoName = "";
    if (!empty($logoName)) {
        $logoExtension = pathinfo($logoName, PATHINFO_EXTENSION);
        $newLogoName = uniqid() . '.' . $logoExtension;
        move_uploaded_file($logoTmpName, $uploadDirectory . $newLogoName);
    }

    $sql = "INSERT INTO partners (name, website, logo) VALUES ('$name', '$website', '$newLogoName')";

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
                <span class="page-eyebrow">ORGANIZATION & SUPPLIERS</span>
                <h1>Add Partner</h1>
                <p>Register a new partner company or sponsor.</p>
            </div>
            <div class="page-actions">
                <a href="index.php" class="btn btn-outline">
                    <i class="bi bi-arrow-left"></i>
                    <span>Back to Partners</span>
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
                <h2>Partner Details</h2>
                <p class="text-muted">Enter partner name, website link, and logo image.</p>
            </div>

            <form method="POST" enctype="multipart/form-data">
                <div class="form-grid">
                    <div class="form-group">
                        <label for="name" class="form-label">Partner Name <span>*</span></label>
                        <input type="text" id="name" name="name" class="form-control" placeholder="e.g. DHL Express" required>
                    </div>

                    <div class="form-group">
                        <label for="website" class="form-label">Website URL</label>
                        <input type="url" id="website" name="website" class="form-control" placeholder="https://www.dhl.com">
                    </div>

                    <div class="form-group full-width">
                        <label for="logo" class="form-label">Partner Logo <span>*</span></label>
                        <input type="file" id="logo" name="logo" class="form-control" accept="image/*" required>
                    </div>

                    <div class="form-group full-width">
                        <label class="form-label">Logo Preview</label>
                        <div class="image-preview-container" style="height: 160px;">
                            <div class="image-preview-placeholder">
                                <i class="bi bi-buildings fs-1 text-primary"></i>
                                <p class="m-0 small text-muted">Select a logo image file above to see preview</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-actions">
                    <a href="index.php" class="btn btn-outline">Cancel</a>
                    <button type="submit" name="submit" class="btn btn-primary">
                        <i class="bi bi-plus-lg"></i>
                        <span>Add Partner</span>
                    </button>
                </div>
            </form>
        </div>
    </main>
</div>

<?php include '../../includes/footer.php'; ?>