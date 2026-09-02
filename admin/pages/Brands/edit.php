<?php
include '../../includes/auth.php';
require_admin_role();
$pageTitle = "Edit Brand | ShopEase Admin";
$pageHeading = "Edit Brand";

include '../../../config/database.php';

$id = (int)($_GET['id'] ?? 0);
$sql = "SELECT * FROM brands WHERE id = $id";
$result = mysqli_query($conn, $sql);
$brand = mysqli_fetch_assoc($result);

if (!$brand) {
    header("Location: index.php");
    exit;
}

$error = "";

if (isset($_POST['submit'])) {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    $oldLogo = $brand['logo'];

    if (!empty($_FILES['logo']['name'])) {
        $logoName = $_FILES['logo']['name'];
        $logoTmpName = $_FILES['logo']['tmp_name'];
        $uploadDirectory = '../../assets/images/brands/';
        if (!is_dir($uploadDirectory)) {
            mkdir($uploadDirectory, 0777, true);
        }

        $logoExtension = pathinfo($logoName, PATHINFO_EXTENSION);
        $newLogoName = uniqid() . '.' . $logoExtension;

        if (move_uploaded_file($logoTmpName, $uploadDirectory . $newLogoName)) {
            $logo = $newLogoName;
            if (!empty($oldLogo) && file_exists($uploadDirectory . $oldLogo)) {
                unlink($uploadDirectory . $oldLogo);
            }
        } else {
            $error = "Error uploading logo image.";
            $logo = $oldLogo;
        }
    } else {
        $logo = $oldLogo;
    }

    if (empty($error)) {
        $sqlUpdate = "UPDATE brands SET name = '$name', description = '$description', logo = '$logo' WHERE id = $id";
        if (mysqli_query($conn, $sqlUpdate)) {
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
                <span class="page-eyebrow">CATALOG MANAGEMENT</span>
                <h1>Edit Brand #<?= $brand['id'] ?></h1>
                <p>Update brand information and logo image.</p>
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
                <h2>Modify Brand</h2>
                <p class="text-muted">Update fields below to edit brand details.</p>
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
                            value="<?= htmlspecialchars($brand['name']); ?>"
                            required
                        >
                    </div>

                    <div class="form-group">
                        <label for="logo" class="form-label">Update Logo</label>
                        <input
                            type="file"
                            id="logo"
                            name="logo"
                            class="form-control"
                            accept="image/*"
                        >
                        <small class="text-muted mt-1">Leave blank to keep existing logo.</small>
                    </div>

                    <div class="form-group full-width">
                        <label for="description" class="form-label">Description <span>*</span></label>
                        <textarea
                            id="description"
                            name="description"
                            class="form-control"
                            required
                        ><?= htmlspecialchars($brand['description']); ?></textarea>
                    </div>

                    <div class="form-group full-width">
                        <label class="form-label">Current Logo Preview</label>
                        <div class="image-preview-container" style="height: 160px;">
                            <?php if (!empty($brand['logo'])) { ?>
                                <img src="../../assets/images/brands/<?= htmlspecialchars($brand['logo']); ?>" alt="<?= htmlspecialchars($brand['name']); ?>">
                            <?php } else { ?>
                                <div class="image-preview-placeholder">
                                    <i class="bi bi-patch-check fs-1 text-muted"></i>
                                    <p class="m-0 small text-muted">No logo uploaded</p>
                                </div>
                            <?php } ?>
                        </div>
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