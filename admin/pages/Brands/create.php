<?php
include '../../includes/auth.php';
require_admin_role();
$pageTitle = "Add Brand | ShopEase Admin";
$pageHeading = "Add Brand";

include '../../../config/database.php';

$error = "";

if (isset($_POST['submit'])) {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);

    // Logo upload
    $logoName = $_FILES['logo']['name'] ?? '';
    $logoTmpName = $_FILES['logo']['tmp_name'] ?? '';

    $uploadDirectory = '../../assets/images/brands/';
    if (!is_dir($uploadDirectory)) {
        mkdir($uploadDirectory, 0777, true);
    }

    $newLogoName = "";
    if (!empty($logoName)) {
        $logoExtension = pathinfo($logoName, PATHINFO_EXTENSION);
        $newLogoName = uniqid() . '.' . $logoExtension;
        move_uploaded_file($logoTmpName, $uploadDirectory . $newLogoName);
    }

    $sql = "INSERT INTO brands (name, description, logo) VALUES ('$name', '$description', '$newLogoName')";
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
                <span class="page-eyebrow">CATALOG MANAGEMENT</span>
                <h1>Add New Brand</h1>
                <p>Register a new manufacturer or brand logo.</p>
            </div>
            <div class="page-actions">
                <a href="index.php" class="btn btn-outline">
                    <i class="bi bi-arrow-left"></i>
                    <span>Back to Brands</span>
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
                <h2>Brand Details</h2>
                <p class="text-muted">Enter the brand details and logo image.</p>
            </div>

            <form method="POST" enctype="multipart/form-data">
                <div class="form-grid">
                    <div class="form-group">
                        <label for="name" class="form-label">Brand Name <span>*</span></label>
                        <input
                            type="text"
                            id="name"
                            name="name"
                            class="form-control"
                            placeholder="e.g. Apple, Nike, Samsung"
                            required
                        >
                    </div>

                    <div class="form-group">
                        <label for="logo" class="form-label">Brand Logo <span>*</span></label>
                        <input
                            type="file"
                            id="logo"
                            name="logo"
                            class="form-control"
                            accept="image/*"
                            required
                        >
                    </div>

                    <div class="form-group full-width">
                        <label for="description" class="form-label">Description <span>*</span></label>
                        <textarea
                            id="description"
                            name="description"
                            class="form-control"
                            placeholder="Brief information about this brand..."
                            required
                        ></textarea>
                    </div>

                    <div class="form-group full-width">
                        <label class="form-label">Logo Preview</label>
                        <div class="image-preview-container" style="height: 160px;">
                            <div class="image-preview-placeholder">
                                <i class="bi bi-patch-check"></i>
                                <p class="m-0 small text-muted">Select a logo file above to view preview</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-actions">
                    <a href="index.php" class="btn btn-outline">Cancel</a>
                    <button type="submit" name="submit" class="btn btn-primary">
                        <i class="bi bi-plus-lg"></i>
                        <span>Create Brand</span>
                    </button>
                </div>
            </form>
        </div>
    </main>
</div>

<?php include '../../includes/footer.php'; ?>