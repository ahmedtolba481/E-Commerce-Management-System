<?php
include '../../includes/auth.php';
require_admin_role();
$pageTitle = "Create Category | ShopEase Admin";
$pageHeading = "Create Category";

include '../../../config/database.php';

$error = "";

if (isset($_POST['submit'])) {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);

    // Image upload
    $imageName = $_FILES['image']['name'] ?? '';
    $imageTmpName = $_FILES['image']['tmp_name'] ?? '';

    $uploadDirectory = '../../assets/images/categories/';
    if (!is_dir($uploadDirectory)) {
        mkdir($uploadDirectory, 0777, true);
    }

    $newImageName = "";
    if (!empty($imageName)) {
        $imageExtension = pathinfo($imageName, PATHINFO_EXTENSION);
        $newImageName = uniqid() . '.' . $imageExtension;
        move_uploaded_file($imageTmpName, $uploadDirectory . $newImageName);
    }

    $sql = "INSERT INTO categories (name, description, image) VALUES ('$name', '$description', '$newImageName')";
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
                <h1>Add New Category</h1>
                <p>Create a new category for your store catalog.</p>
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
                <h2>Category Information</h2>
                <p class="text-muted">Enter the details below to add a new category.</p>
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
                            placeholder="e.g. Electronics & Gadgets"
                            required
                        >
                    </div>

                    <div class="form-group">
                        <label for="image" class="form-label">Category Image <span>*</span></label>
                        <input
                            type="file"
                            id="image"
                            name="image"
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
                            placeholder="Write a clear description for this category..."
                            required
                        ></textarea>
                    </div>

                    <div class="form-group full-width">
                        <label class="form-label">Image Preview</label>
                        <div class="image-preview-container">
                            <div class="image-preview-placeholder">
                                <i class="bi bi-image"></i>
                                <p class="m-0 small text-muted">Select an image above to see live preview</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-actions">
                    <a href="index.php" class="btn btn-outline">Cancel</a>
                    <button type="submit" name="submit" class="btn btn-primary">
                        <i class="bi bi-plus-lg"></i>
                        <span>Create Category</span>
                    </button>
                </div>
            </form>
        </div>
    </main>
</div>

<?php include '../../includes/footer.php'; ?>