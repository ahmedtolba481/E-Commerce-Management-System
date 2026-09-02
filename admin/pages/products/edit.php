<?php

$pageTitle = "Edit Product | SmartStore";
$pageKey = "products";

include '../../../config/database.php';



$id = $_GET['id'];



$sql = "SELECT * FROM products WHERE id = $id";
$result = mysqli_query($conn, $sql);

$product = mysqli_fetch_array($result);

if (!$product) {

    die("Product not found.");

}



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

    $oldImage = $product['image'];

    $uploadDirectory = '../../assets/images/products/';


    // Check if a new image was selected

    if (!empty($_FILES['image']['name'])) {

        $imageName = $_FILES['image']['name'];
        $imageTmpName = $_FILES['image']['tmp_name'];

        $imageExtension = pathinfo($imageName, PATHINFO_EXTENSION);

        $newImageName = uniqid() . '.' . $imageExtension;


        // Upload new image

        if (move_uploaded_file(
            $imageTmpName,
            $uploadDirectory . $newImageName
        )) {

            $image = $newImageName;


            // Delete old image

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


    

    $sql = "UPDATE products SET
                category_id = '$category_id',
                brand_id = '$brand_id',
                name = '$name',
                description = '$description',
                price = '$price',
                stock = '$stock',
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
                    Product Management
                </div>

                <h1>Edit Product</h1>

                <p>
                    Update the product's information.
                </p>

            </div>

        </div>


        <div class="form-card">

            <div class="form-header">

                <div class="section-eyebrow">
                    Product Information
                </div>

                <h2>Edit Product</h2>

                <p>
                    Update the product's information below.
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
                                    value="<?= htmlspecialchars($product['name']); ?>"
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

                                        <option
                                            value="<?= $category['id']; ?>"
                                            <?= ($category['id'] == $product['category_id']) ? 'selected' : ''; ?>
                                        >
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

                                        <option
                                            value="<?= $brand['id']; ?>"
                                            <?= ($brand['id'] == $product['brand_id']) ? 'selected' : ''; ?>
                                        >
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
                                    value="<?= htmlspecialchars($product['price']); ?>"
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
                                    value="<?= htmlspecialchars($product['stock']); ?>"
                                    min="0"
                                    required
                                >

                            </div>

                        </div>


                       

                        <div class="col-md-6">

                            <div class="form-group">

                                <label for="image" class="form-label">
                                    New Image
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

                                <label for="description" class="form-label">
                                    Description <span>*</span>
                                </label>

                                <textarea
                                    id="description"
                                    name="description"
                                    class="form-textarea"
                                    required
                                ><?= htmlspecialchars($product['description']); ?></textarea>

                            </div>

                        </div>


                        <!-- Current Image -->

                        <div class="col-12">

                            <div class="form-group">

                                <label class="form-label">
                                    Current Image
                                </label>

                                <?php if (!empty($product['image'])) { ?>

                                    <img
                                        src="../../assets/images/products/<?= htmlspecialchars($product['image']); ?>"
                                        alt="<?= htmlspecialchars($product['name']); ?>"
                                        style="width:120px;height:120px;object-fit:cover;border-radius:10px;border:1px solid #e2e8f0;"
                                    >

                                <?php } else { ?>

                                    <small class="form-help">
                                        No image uploaded.
                                    </small>

                                <?php } ?>

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
                        <i class="bi bi-check-lg"></i>
                        Update Product
                    </button>

                </div>

            </form>

        </div>

    </main>

</div>

<?php include '../../includes/footer.php'; ?>