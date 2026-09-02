<?php
include '../../includes/auth.php';
require_admin_role();
$pageTitle = "Edit Team Member | ShopEase Admin";
$pageHeading = "Edit Member";

include '../../../config/database.php';

$id = (int)($_GET['id'] ?? 0);
$sql = "SELECT * FROM team WHERE id = $id";
$result = mysqli_query($conn, $sql);
$member = mysqli_fetch_assoc($result);

if (!$member) {
    header("Location: index.php");
    exit;
}

$error = "";

if (isset($_POST['submit'])) {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $position = mysqli_real_escape_string($conn, $_POST['position']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    $facebook = mysqli_real_escape_string($conn, $_POST['facebook']);
    $instagram = mysqli_real_escape_string($conn, $_POST['instagram']);
    $linkedin = mysqli_real_escape_string($conn, $_POST['linkedin']);

    $oldImage = $member['image'];

    if (!empty($_FILES['image']['name'])) {
        $imageName = $_FILES['image']['name'];
        $imageTmpName = $_FILES['image']['tmp_name'];
        $uploadDirectory = '../../assets/images/team/';
        if (!is_dir($uploadDirectory)) {
            mkdir($uploadDirectory, 0777, true);
        }

        $imageExtension = pathinfo($imageName, PATHINFO_EXTENSION);
        $newImageName = uniqid() . '.' . $imageExtension;

        if (move_uploaded_file($imageTmpName, $uploadDirectory . $newImageName)) {
            $image = $newImageName;
            if (!empty($oldImage) && file_exists($uploadDirectory . $oldImage)) {
                unlink($uploadDirectory . $oldImage);
            }
        } else {
            $error = "Error uploading profile image.";
            $image = $oldImage;
        }
    } else {
        $image = $oldImage;
    }

    if (empty($error)) {
        $sqlUpdate = "UPDATE team SET
                        name = '$name',
                        position = '$position',
                        description = '$description',
                        facebook = '$facebook',
                        instagram = '$instagram',
                        linkedin = '$linkedin',
                        image = '$image'
                    WHERE id = $id";

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
                <span class="page-eyebrow">ORGANIZATION</span>
                <h1>Edit Team Member #<?= $member['id'] ?></h1>
                <p>Update staff details, position, or photo.</p>
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
                <h2>Modify Profile</h2>
                <p class="text-muted">Update fields below to edit profile info.</p>
            </div>

            <form method="POST" enctype="multipart/form-data">
                <div class="form-grid">
                    <div class="form-group">
                        <label for="name" class="form-label">Full Name <span>*</span></label>
                        <input type="text" id="name" name="name" class="form-control" value="<?= htmlspecialchars($member['name']); ?>" required>
                    </div>

                    <div class="form-group">
                        <label for="position" class="form-label">Position / Job Title <span>*</span></label>
                        <input type="text" id="position" name="position" class="form-control" value="<?= htmlspecialchars($member['position']); ?>" required>
                    </div>

                    <div class="form-group">
                        <label for="image" class="form-label">Update Photo</label>
                        <input type="file" id="image" name="image" class="form-control" accept="image/*">
                        <small class="text-muted mt-1">Leave empty to keep existing photo.</small>
                    </div>

                    <div class="form-group">
                        <label for="facebook" class="form-label">Facebook Profile URL</label>
                        <input type="url" id="facebook" name="facebook" class="form-control" value="<?= htmlspecialchars($member['facebook']); ?>">
                    </div>

                    <div class="form-group">
                        <label for="instagram" class="form-label">Instagram Profile URL</label>
                        <input type="url" id="instagram" name="instagram" class="form-control" value="<?= htmlspecialchars($member['instagram']); ?>">
                    </div>

                    <div class="form-group">
                        <label for="linkedin" class="form-label">LinkedIn Profile URL</label>
                        <input type="url" id="linkedin" name="linkedin" class="form-control" value="<?= htmlspecialchars($member['linkedin']); ?>">
                    </div>

                    <div class="form-group full-width">
                        <label for="description" class="form-label">Biography / Description <span>*</span></label>
                        <textarea id="description" name="description" class="form-control" required><?= htmlspecialchars($member['description']); ?></textarea>
                    </div>

                    <div class="form-group full-width">
                        <label class="form-label">Current Photo Preview</label>
                        <div class="image-preview-container" style="height: 220px;">
                            <?php if (!empty($member['image'])) { ?>
                                <img src="../../assets/images/team/<?= htmlspecialchars($member['image']); ?>" alt="<?= htmlspecialchars($member['name']); ?>" style="object-fit: cover;">
                            <?php } else { ?>
                                <div class="image-preview-placeholder">
                                    <i class="bi bi-person fs-1 text-muted"></i>
                                    <p class="m-0 small text-muted">No photo uploaded</p>
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