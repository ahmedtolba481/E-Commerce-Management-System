<?php

$pageTitle = "Add Category | SmartStore";
$pageKey = "categories";

include '../../../config/database.php';

if (isset($_POST['submit'])) {

    $name = $_POST['name'];
    $description = $_POST['description'];

    // Image upload
    $imageName = $_FILES['image']['name'];
    $imageTmpName = $_FILES['image']['tmp_name'];

    $uploadDirectory = '../../assets/images/categories/';

    // Create a unique filename
    $imageExtension = pathinfo($imageName, PATHINFO_EXTENSION);
    $newImageName = uniqid() . '.' . $imageExtension;

    // Move image to categories folder
    if (move_uploaded_file($imageTmpName, $uploadDirectory . $newImageName)) {

        $sql = "INSERT INTO categories (name, description, image)
                VALUES ('$name', '$description', '$newImageName')";

        if (mysqli_query($conn, $sql)) {

            header("Location: index.php");
            exit;

        } else {

            echo "Error: " . mysqli_error($conn);

        }

    } else {

        echo "Error uploading image.";

    }
}

include '../../includes/header.php';
include '../../includes/navbar.php';

?>

<div class="admin-layout">

    <?php include '../../includes/sidebar.php'; ?>

    <main class="admin-content">

        <div class="page-header">

            <div>

                <div class="page-eyebrow">
                    Category Management
                </div>

                <h1>Add Category</h1>

                <p>
                    Create a new category for the system.
                </p>

            </div>

        </div>

        <div class="form-card">

            <div class="form-header">

                <div class="section-eyebrow">
                    Category Information
                </div>

                <h2>Create New Category</h2>

                <p>
                    Enter the category's information below.
                </p>

            </div>

            <form method="POST" enctype="multipart/form-data">

                <div class="form-body">

                    <div class="row">

                        
                        <div class="col-md-6">

                            <div class="form-group">

                                <label
                                    for="name"
                                    class="form-label"
                                >
                                    Name <span>*</span>
                                </label>

                                <input
                                    type="text"
                                    id="name"
                                    name="name"
                                    class="form-input"
                                    placeholder="Enter category name"
                                    required
                                >

                            </div>

                        </div>


                       
                        <div class="col-md-6">

                            <div class="form-group">

                                <label
                                    for="image"
                                    class="form-label"
                                >
                                    Image <span>*</span>
                                </label>

                                <input
                                    type="file"
                                    id="image"
                                    name="image"
                                    class="form-input"
                                    accept="image/*"
                                    required
                                >

                                <small class="form-help">
                                    Select an image for this category.
                                </small>

                            </div>

                        </div>


                        
                        <div class="col-12">

                            <div class="form-group">

                                <label
                                    for="description"
                                    class="form-label"
                                >
                                    Description <span>*</span>
                                </label>

                                <textarea
                                    id="description"
                                    name="description"
                                    class="form-textarea"
                                    placeholder="Enter category description"
                                    required
                                ></textarea>

                            </div>

                        </div>

                    </div>

                </div>


                
                <div class="form-footer">

                    <a
                        href="index.php"
                        class="btn-secondary"
                    >
                        <i class="bi bi-arrow-left"></i>
                        Cancel
                    </a>

                    <button
                        type="submit"
                        name="submit"
                        class="btn-primary"
                    >
                        <i class="bi bi-plus-lg"></i>
                        Create Category
                    </button>

                </div>

            </form>

        </div>

    </main>

</div>

<?php include '../../includes/footer.php'; ?>