<?php
include '../../includes/auth.php';
require_admin_role();
$pageTitle = "Edit Brand | SmartStore";
$pageKey = "brands";

include '../../../config/database.php';

$id = $_GET['id'];



$sql = "SELECT * FROM brands WHERE id = $id";
$result = mysqli_query($conn, $sql);

$brand = mysqli_fetch_array($result);

if (!$brand) {
    die("Brand not found.");
}




if (isset($_POST['submit'])) {

    $name = $_POST['name'];
    $description = $_POST['description'];

    $oldImage = $brand['logo'];

    

    if (!empty($_FILES['logo']['name'])) {

        $imageName = $_FILES['logo']['name'];
        $imageTmpName = $_FILES['logo']['tmp_name'];

        $uploadDirectory = '../../assets/images/brands/';

        
        $imageExtension = pathinfo($imageName, PATHINFO_EXTENSION);

        
        $newImageName = uniqid() . '.' . $imageExtension;

        
        if (move_uploaded_file(
            $imageTmpName,
            $uploadDirectory . $newImageName
        )) {

            $logo = $newImageName;

            

            if (!empty($oldImage)) {

                $oldImagePath = $uploadDirectory . $oldImage;

                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }
            }

        } else {

            echo "Error uploading logo.";
            exit;
        }

    } else {

        
        $logo = $oldImage;
    }


    

    $sql = "UPDATE brands SET
                name = '$name',
                description = '$description',
                logo = '$logo'
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
                    Brand Management
                </div>

                <h1>Edit Brand</h1>

                <p>
                    Update the brand's information.
                </p>

            </div>

        </div>


        <div class="form-card">

            <div class="form-header">

                <div class="section-eyebrow">
                    Brand Information
                </div>

                <h2>Edit Brand</h2>

                <p>
                    Update the brand's information below.
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
                                    value="<?= htmlspecialchars($brand['name']); ?>"
                                    placeholder="Enter brand name"
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
                                    Image
                                </label>

                                <input
                                    type="file"
                                    id="logo"
                                    name="logo"
                                    class="form-input"
                                    accept="logo/*"
                                >

                                <small class="form-help">
                                    Leave empty to keep the current logo.
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
                                    placeholder="Enter brand description"
                                    required
                                ><?= htmlspecialchars($brand['description']); ?></textarea>

                            </div>

                        </div>


                        

                        <div class="col-12">

                            <div class="form-group">

                                <label class="form-label">
                                    Current Image
                                </label>

                                <?php if (!empty($brand['logo'])) { ?>

                                    <img
                                        src="../../assets/images/brands/<?= htmlspecialchars($brand['logo']); ?>"
                                        alt="<?= htmlspecialchars($brand['name']); ?>"
                                        style="width: 120px; height: 120px; object-fit: cover; border-radius: 10px; border: 1px solid #e2e8f0;"
                                    >

                                <?php } else { ?>

                                    <p class="form-help">
                                        No logo uploaded.
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
                        Update Brand
                    </button>

                </div>

            </form>

        </div>

    </main>

</div>

<?php include '../../includes/footer.php'; ?>