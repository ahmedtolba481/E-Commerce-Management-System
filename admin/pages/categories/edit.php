<?php
include '../../includes/auth.php';
require_admin_role();
$pageTitle = "Edit Category | ShopEase Admin";
$pageHeading = "Edit Category";

include '../../../config/database.php';

$id = (int)($_GET['id'] ?? 0);
$sql = "SELECT * FROM categories WHERE id = $id";
$result = mysqli_query($conn, $sql);
$category = mysqli_fetch_assoc($result);

if (!$category) {
    header("Location: index.php");
    exit;
}

$error = "";

if (isset($_POST['submit'])) {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    $oldImage = $category['image'];

    if (!empty($_FILES['image']['name'])) {
        $imageName = $_FILES['image']['name'];
        $imageTmpName = $_FILES['image']['tmp_name'];
        $uploadDirectory = '../../assets/images/categories/';
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
            $error = "Error uploading new image.";
            $image = $oldImage;
        }
    } else {
        $image = $oldImage;
    }

    if (empty($error)) {
        $sqlUpdate = "UPDATE categories SET name = '$name', description = '$description', image = '$image' WHERE id = $id";
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
                <h1>Edit Category #<?= $category['id'] ?></h1>
                <p>Update category details and image.</p>
            </div>
            <div class="page-actions">
                <a href="index.php" class="btn btn-outline">
                    <i class="bi bi-arrow-left"></i>
                    <span>Back to Categories</span>
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
                <h2>Category Details</h2>
                <p class="text-muted">Modify the fields below to update this category.</p>
            </div>

            <form method="POST" enctype="multipart/form-data">
                <div class="form-grid">
                    <div class="form-group">
                        <label for="name" class="form-label">Category Name <span>*</span></label>
                        <input
                            type="text"
                            id="name"
                            name="name"
                            class="form-control"
                            value="<?= htmlspecialchars($category['name']); ?>"
                            required
                        >
                    </div>

                    <div class="form-group">
                        <label for="image" class="form-label">Update Image</label>
                        <input
                            type="file"
                            id="image"
                            name="image"
                            class="form-control"
                            accept="image/*"
                        >
                        <small class="text-muted mt-1">Leave blank to keep the current image.</small>
                    </div>

                    <div class="form-group full-width">
                        <label for="description" class="form-label">Description <span>*</span></label>
                        <textarea
                            id="description"
                            name="description"
                            class="form-control"
                            required
                        ><?= htmlspecialchars($category['description']); ?></textarea>
                    </div>

                    <div class="form-group full-width">
                        <label class="form-label">Current Image Preview</label>
                        <div class="image-preview-container">
                            <?php if (!empty($category['image'])) { ?>
                                <img src="../../assets/images/categories/<?= htmlspecialchars($category['image']); ?>" alt="<?= htmlspecialchars($category['name']); ?>">
                            <?php } else { ?>
                                <div class="image-preview-placeholder">
                                    <i class="bi bi-grid fs-1 text-muted"></i>
                                    <p class="m-0 small text-muted">No image uploaded</p>
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