<?php
include '../../includes/auth.php';
require_admin_role();
$pageTitle = "Edit Category | SmartStore";
$pageKey = "categories";

include '../../../config/database.php';

$id = $_GET['id'];



$sql = "SELECT * FROM categories WHERE id = $id";
$result = mysqli_query($conn, $sql);

$category = mysqli_fetch_array($result);

if (!$category) {
    die("Category not found.");
}




if (isset($_POST['submit'])) {

    $name = $_POST['name'];
    $description = $_POST['description'];

    $oldImage = $category['image'];

    

    if (!empty($_FILES['image']['name'])) {

        $imageName = $_FILES['image']['name'];
        $imageTmpName = $_FILES['image']['tmp_name'];

        $uploadDirectory = '../../assets/images/categories/';

        
        $imageExtension = pathinfo($imageName, PATHINFO_EXTENSION);

        
        $newImageName = uniqid() . '.' . $imageExtension;

        
        if (move_uploaded_file(
            $imageTmpName,
            $uploadDirectory . $newImageName
        )) {

            $image = $newImageName;

            

            if (!empty($oldImage)) {

                $oldImagePath = $uploadDirectory . $oldImage;

                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }
            }

        } else {

            echo "Error uploading image.";
            exit;
        }

    } else {

        
        $image = $oldImage;
    }


    

    $sql = "UPDATE categories SET
                name = '$name',
                description = '$description',
                image = '$image'
            WHERE id = $id";

    if (mysqli_query($conn, $sql)) {

        header("Location: index.php");
        exit;

    } else {

        echo "Error: " . mysqli_error($conn);
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

                <h1>Edit Category</h1>

                <p>
                    Update the category's information.
                </p>

            </div>

        </div>


        <div class="form-card">

            <div class="form-header">

                <div class="section-eyebrow">
                    Category Information
                </div>

                <h2>Edit Category</h2>

                <p>
                    Update the category's information below.
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
                                    value="<?= htmlspecialchars($category['name']); ?>"
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
                                    Image
                                </label>

                                <input
                                    type="file"
                                    id="image"
                                    name="image"
                                    class="form-input"
                                    accept="image/*"
                                >

                                <small class="form-help">
                                    Leave empty to keep the current image.
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
                                ><?= htmlspecialchars($category['description']); ?></textarea>

                            </div>

                        </div>


                        

                        <div class="col-12">

                            <div class="form-group">

                                <label class="form-label">
                                    Current Image
                                </label>

                                <?php if (!empty($category['image'])) { ?>

                                    <img
                                        src="../../assets/images/categories/<?= htmlspecialchars($category['image']); ?>"
                                        alt="<?= htmlspecialchars($category['name']); ?>"
                                        style="width: 120px; height: 120px; object-fit: cover; border-radius: 10px; border: 1px solid #e2e8f0;"
                                    >

                                <?php } else { ?>

                                    <p class="form-help">
                                        No image uploaded.
                                    </p>

                                <?php } ?>

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
                        <i class="bi bi-check-lg"></i>
                        Update Category
                    </button>

                </div>

            </form>

        </div>

    </main>

</div>

<?php include '../../includes/footer.php'; ?>