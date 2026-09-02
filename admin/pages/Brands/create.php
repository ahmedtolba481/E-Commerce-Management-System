<?php
include '../../includes/auth.php';
require_admin_role();
$pageTitle = "Add Brand | SmartStore";
$pageKey = "brands";

include '../../../config/database.php';

if (isset($_POST['submit'])) {

    $name = $_POST['name'];
    $description = $_POST['description'];

    // Image upload
    $imageName = $_FILES['logo']['name'];
    $imageTmpName = $_FILES['logo']['tmp_name'];

    $uploadDirectory = '../../assets/images/brands/';

    // Create a unique filename
    $imageExtension = pathinfo($imageName, PATHINFO_EXTENSION);
    $newImageName = uniqid() . '.' . $imageExtension;

    // Move logo to brands folder
    if (move_uploaded_file($imageTmpName, $uploadDirectory . $newImageName)) {

        $sql = "INSERT INTO brands (name, description, logo)
                VALUES ('$name', '$description', '$newImageName')";

        if (mysqli_query($conn, $sql)) {

            header("Location: index.php");
            exit;

        } else {

            echo "Error: " . mysqli_error($conn);

        }

    } else {

        echo "Error uploading logo.";

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
                    Brand Management
                </div>

                <h1>Add Brand</h1>

                <p>
                    Create a new category for the system.
                </p>

            </div>

        </div>

        <div class="form-card">

            <div class="form-header">

                <div class="section-eyebrow">
                    Brand Information
                </div>

                <h2>Create New Brand</h2>

                <p>
                    Enter the brand's information below.
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
                                    for="logo"
                                    class="form-label"
                                >
                                    Logo <span>*</span>
                                </label>

                                <input
                                    type="file"
                                    id="logo"
                                    name="logo"
                                    class="form-input"
                                    accept="logo/*"
                                    required
                                >

                                <small class="form-help">
                                    Select a logo for this category.
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
                        Create Brand
                    </button>

                </div>

            </form>

        </div>

    </main>

</div>

<?php include '../../includes/footer.php'; ?>