<?php

$pageTitle = "Add Partner | SmartStore";
$pageKey = "partners";

include '../../../config/database.php';

if (isset($_POST['submit'])) {

    $name = $_POST['name'];
    $website = $_POST['website'];

    // Image upload
    $imageName = $_FILES['logo']['name'];
    $imageTmpName = $_FILES['logo']['tmp_name'];

    $uploadDirectory = '../../assets/images/partners/';

    // Create a unique filename
    $imageExtension = pathinfo($imageName, PATHINFO_EXTENSION);
    $newImageName = uniqid() . '.' . $imageExtension;

    // Move logo to partners folder
    if (move_uploaded_file($imageTmpName, $uploadDirectory . $newImageName)) {

        $sql = "INSERT INTO partners (name, website, logo)
                VALUES ('$name', '$website', '$newImageName')";

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
                    Partner Management
                </div>

                <h1>Add Partner</h1>

                <p>
                    Create a new partner for the system.
                </p>

            </div>

        </div>

        <div class="form-card">

            <div class="form-header">

                <div class="section-eyebrow">
                    Partner Information
                </div>

                <h2>Create New Partner</h2>

                <p>
                    Enter the partner's information below.
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
                                    placeholder="Enter partner name"
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
                                    Select a logo for this partner.
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
                                    placeholder="Enter partner website"
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
                        Create Partner
                    </button>

                </div>

            </form>

        </div>

    </main>

</div>

<?php include '../../includes/footer.php'; ?>