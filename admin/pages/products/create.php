<?php
include '../../includes/auth.php';
$pageTitle = "Add Product | SmartStore";
$pageKey = "products";

include '../../../config/database.php';



$categoriesQuery = "SELECT * FROM categories";
$categoriesResult = mysqli_query($conn, $categoriesQuery);



$brandsQuery = "SELECT * FROM brands";
$brandsResult = mysqli_query($conn, $brandsQuery);



if (isset($_POST['submit'])) {

    $name = $_POST['name'];
    $description = $_POST['description'];
    $category_id = $_POST['category_id'];
    $brand_id = $_POST['brand_id'];
    $price = $_POST['price'];
    $stock = $_POST['stock'];

    // Image
    $imageName = $_FILES['image']['name'];
    $imageTmpName = $_FILES['image']['tmp_name'];

    $uploadDirectory = '../../assets/images/products/';

    $imageExtension = pathinfo($imageName, PATHINFO_EXTENSION);

    $newImageName = uniqid() . '.' . $imageExtension;


    // Upload image
    if (move_uploaded_file(
        $imageTmpName,
        $uploadDirectory . $newImageName
    )) {

        $sql = "INSERT INTO products
                (category_id, brand_id, name, description, price, stock, image)
                VALUES
                ('$category_id', '$brand_id', '$name', '$description', '$price', '$stock', '$newImageName')";


        if (mysqli_query($conn, $sql)) {

            header("Location: index.php");
            exit;

        } else {

            // Remove image if database insert fails
            unlink($uploadDirectory . $newImageName);

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
                    Product Management
                </div>

                <h1>Add Product</h1>

                <p>
                    Create a new product for the system.
                </p>

            </div>

        </div>


        <div class="form-card">

            <div class="form-header">

                <div class="section-eyebrow">
                    Product Information
                </div>

                <h2>Create New Product</h2>

                <p>
                    Enter the product's information below.
                </p>

            </div>


            <form method="POST" enctype="multipart/form-data">

                <div class="form-body">

                    <div class="row">


                        

                        <div class="col-md-6">

                            <div class="form-group">

                                <label for="name" class="form-label">
                                    Name <span>*</span>
                                </label>

                                <input
                                    type="text"
                                    id="name"
                                    name="name"
                                    class="form-input"
                                    placeholder="Enter product name"
                                    required
                                >

                            </div>

                        </div>


                        

                        <div class="col-md-6">

                            <div class="form-group">

                                <label for="category_id" class="form-label">
                                    Category <span>*</span>
                                </label>

                                <select
                                    id="category_id"
                                    name="category_id"
                                    class="form-select"
                                    required
                                >

                                    <option value="">
                                        Select category
                                    </option>

                                    <?php while ($category = mysqli_fetch_array($categoriesResult)) { ?>

                                        <option value="<?= $category['id']; ?>">
                                            <?= htmlspecialchars($category['name']); ?>
                                        </option>

                                    <?php } ?>

                                </select>

                            </div>

                        </div>


                        

                        <div class="col-md-6">

                            <div class="form-group">

                                <label for="brand_id" class="form-label">
                                    Brand <span>*</span>
                                </label>

                                <select
                                    id="brand_id"
                                    name="brand_id"
                                    class="form-select"
                                    required
                                >

                                    <option value="">
                                        Select brand
                                    </option>

                                    <?php while ($brand = mysqli_fetch_array($brandsResult)) { ?>

                                        <option value="<?= $brand['id']; ?>">
                                            <?= htmlspecialchars($brand['name']); ?>
                                        </option>

                                    <?php } ?>

                                </select>

                            </div>

                        </div>


                        

                        <div class="col-md-6">

                            <div class="form-group">

                                <label for="price" class="form-label">
                                    Price <span>*</span>
                                </label>

                                <input
                                    type="number"
                                    id="price"
                                    name="price"
                                    class="form-input"
                                    placeholder="Enter product price"
                                    step="0.01"
                                    min="0"
                                    required
                                >

                            </div>

                        </div>


                        

                        <div class="col-md-6">

                            <div class="form-group">

                                <label for="stock" class="form-label">
                                    Stock <span>*</span>
                                </label>

                                <input
                                    type="number"
                                    id="stock"
                                    name="stock"
                                    class="form-input"
                                    placeholder="Enter stock quantity"
                                    min="0"
                                    required
                                >

                            </div>

                        </div>


                        

                        <div class="col-md-6">

                            <div class="form-group">

                                <label for="image" class="form-label">
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
                                    Select an image for this product.
                                </small>

                            </div>

                        </div>


                        <!-- Description -->

                        <div class="col-12">

                            <div class="form-group">

                                <label for="description" class="form-label">
                                    Description <span>*</span>
                                </label>

                                <textarea
                                    id="description"
                                    name="description"
                                    class="form-textarea"
                                    placeholder="Enter product description"
                                    required
                                ></textarea>

                            </div>

                        </div>


                    </div>

                </div>


                <div class="form-footer">

                    <a href="index.php" class="btn-secondary">
                        <i class="bi bi-arrow-left"></i>
                        Cancel
                    </a>

                    <button
                        type="submit"
                        name="submit"
                        class="btn-primary"
                    >
                        <i class="bi bi-plus-lg"></i>
                        Create Product
                    </button>

                </div>

            </form>

        </div>

    </main>

</div>

<?php include '../../includes/footer.php'; ?>