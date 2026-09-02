<?php
include '../../includes/auth.php';
require_admin_role();
$pageTitle = "Edit Partner | SmartStore";
$pageKey = "partners";

include '../../../config/database.php';

$id = $_GET['id'];



$sql = "SELECT * FROM partners WHERE id = $id";
$result = mysqli_query($conn, $sql);

$partner = mysqli_fetch_array($result);

if (!$partner) {
    die("Partner not found.");
}




if (isset($_POST['submit'])) {

    $name = $_POST['name'];
    $website = $_POST['website'];

    $oldImage = $partner['logo'];

    

    if (!empty($_FILES['logo']['name'])) {

        $imageName = $_FILES['logo']['name'];
        $imageTmpName = $_FILES['logo']['tmp_name'];

        $uploadDirectory = '../../assets/images/partners/';

        
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


    

    $sql = "UPDATE partners SET
                name = '$name',
                website = '$website',
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
                    Partner Management
                </div>

                <h1>Edit Partner</h1>

                <p>
                    Update the partner's information.
                </p>

            </div>

        </div>


        <div class="form-card">

            <div class="form-header">

                <div class="section-eyebrow">
                    Partner Information
                </div>

                <h2>Edit Partner</h2>

                <p>
                    Update the partner's information below.
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
                                    value="<?= htmlspecialchars($partner['name']); ?>"
                                    placeholder="Enter part$partner name"
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
                                    Logo
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
                                    for="website"
                                    class="form-label"
                                >
                                    Website <span>*</span>
                                </label>

                                <textarea
                                    id="website"
                                    name="website"
                                    class="form-textarea"
                                    placeholder="Enter part$partner website"
                                    required
                                ><?= htmlspecialchars($partner['website']); ?></textarea>

                            </div>

                        </div>


                        

                        <div class="col-12">

                            <div class="form-group">

                                <label class="form-label">
                                    Current Image
                                </label>

                                <?php if (!empty($partner['logo'])) { ?>

                                    <img
                                        src="../../assets/images/partners/<?= htmlspecialchars($partner['logo']); ?>"
                                        alt="<?= htmlspecialchars($partner['name']); ?>"
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
                        Update Partner
                    </button>

                </div>

            </form>

        </div>

    </main>

</div>

<?php include '../../includes/footer.php'; ?>