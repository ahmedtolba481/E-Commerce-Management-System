<?php
include '../../includes/auth.php';
require_admin_role();
$pageTitle = "Edit Partner | ShopEase Admin";
$pageHeading = "Edit Partner";

include '../../../config/database.php';

$id = (int)($_GET['id'] ?? 0);
$sql = "SELECT * FROM partners WHERE id = $id";
$result = mysqli_query($conn, $sql);
$partner = mysqli_fetch_assoc($result);

if (!$partner) {
    header("Location: index.php");
    exit;
}

$error = "";

if (isset($_POST['submit'])) {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $website = mysqli_real_escape_string($conn, $_POST['website']);
    $oldLogo = $partner['logo'];

    if (!empty($_FILES['logo']['name'])) {
        $logoName = $_FILES['logo']['name'];
        $logoTmpName = $_FILES['logo']['tmp_name'];
        $uploadDirectory = '../../assets/images/partners/';
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
            $error = "Error uploading logo.";
            $logo = $oldLogo;
        }
    } else {
        $logo = $oldLogo;
    }

    if (empty($error)) {
        $sqlUpdate = "UPDATE partners SET name = '$name', website = '$website', logo = '$logo' WHERE id = $id";
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
                <span class="page-eyebrow">ORGANIZATION & SUPPLIERS</span>
                <h1>Edit Partner #<?= $partner['id'] ?></h1>
                <p>Update partner details or logo image.</p>
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
                <h2>Modify Partner</h2>
                <p class="text-muted">Update fields below to edit partner information.</p>
            </div>

            <form method="POST" enctype="multipart/form-data">
                <div class="form-grid">
                    <div class="form-group">
                        <label for="name" class="form-label">Partner Name <span>*</span></label>
                        <input type="text" id="name" name="name" class="form-control" value="<?= htmlspecialchars($partner['name']); ?>" required>
                    </div>

                    <div class="form-group">
                        <label for="website" class="form-label">Website URL</label>
                        <input type="url" id="website" name="website" class="form-control" value="<?= htmlspecialchars($partner['website']); ?>">
                    </div>

                    <div class="form-group full-width">
                        <label for="logo" class="form-label">Update Logo</label>
                        <input type="file" id="logo" name="logo" class="form-control" accept="image/*">
                        <small class="text-muted mt-1">Leave empty to keep existing logo.</small>
                    </div>

                    <div class="form-group full-width">
                        <label class="form-label">Current Logo Preview</label>
                        <div class="image-preview-container" style="height: 160px;">
                            <?php if (!empty($partner['logo'])) { ?>
                                <img src="../../assets/images/partners/<?= htmlspecialchars($partner['logo']); ?>" alt="<?= htmlspecialchars($partner['name']); ?>" style="object-fit: contain;">
                            <?php } else { ?>
                                <div class="image-preview-placeholder">
                                    <i class="bi bi-buildings fs-1 text-muted"></i>
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