<?php

$pageTitle = "Products | SmartStore";
$pageKey = "products";

include '../../../config/database.php';

$query = "SELECT 
            products.id,
            categories.name AS category_name,
            brands.name AS brand_name,
            products.name,
            products.description,
            products.price,
            products.stock,
            products.image,
            products.created_at
          FROM products
          LEFT JOIN categories
            ON products.category_id = categories.id
          LEFT JOIN brands
            ON products.brand_id = brands.id";

$result = mysqli_query($conn, $query);

if (!$result) {
    die("Query Error: " . mysqli_error($conn));
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
                    Management
                </div>

                <h1>Products</h1>

                <p>
                    Manage system products.
                </p>

            </div>

            <div class="page-actions">

                <a href="create.php" class="btn btn-primary">
                    <i class="bi bi-plus-lg"></i>
                    Add Product
                </a>

            </div>

        </div>


        <div class="users-table-card">

            <div
                class="section-heading"
                style="padding: 22px 24px 0;"
            >

                <div>

                    <div class="section-eyebrow">
                        Products
                    </div>

                    <h2>All Products</h2>

                </div>

            </div>


            <div class="table-responsive">

                <table class="users-table">

                    <thead>

                        <tr>

                            <th>#</th>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Brand</th>
                            <th>Category</th>
                            <th>Price</th>
                            <th>Stock</th>
                            <th>Image</th>
                            <th>Actions</th>

                        </tr>

                    </thead>


                    <tbody>

                        <?php while ($product = mysqli_fetch_array($result)) { ?>

                            <tr>

                                <!-- ID -->

                                <td>
                                    <?php echo $product['id']; ?>
                                </td>


                                <!-- Name -->

                                <td>

                                    <strong>
                                        <?php echo htmlspecialchars($product['name']); ?>
                                    </strong>

                                </td>


                                <!-- Description -->

                                <td>

                                    <?php echo htmlspecialchars($product['description']); ?>

                                </td>


                                <!-- Brand -->

                                <td>

                                    <?php echo htmlspecialchars($product['brand_name'] ?? 'N/A'); ?>

                                </td>


                                <!-- Category -->

                                <td>

                                    <?php echo htmlspecialchars($product['category_name'] ?? 'N/A'); ?>

                                </td>


                                <!-- Price -->

                                <td>

                                    <?php echo number_format($product['price'], 2); ?>

                                </td>


                                <!-- Stock -->

                                <td>

                                    <?php echo $product['stock']; ?>

                                </td>


                                <!-- Image -->

                                <td>

                                    <?php if (!empty($product['image'])) { ?>

                                        <img
                                            src="/E-Commerce-Management-System/admin/assets/images/products/<?= htmlspecialchars($product['image']); ?>"
                                            alt="<?= htmlspecialchars($product['name']); ?>"
                                            style="width: 60px; height: 60px; object-fit: cover; border-radius: 8px;"
                                        >

                                    <?php } else { ?>

                                        <span>
                                            No Image
                                        </span>

                                    <?php } ?>

                                </td>


                                <!-- Actions -->

                                <td>

                                    <div class="product-actions">

                                        <a
                                            href="edit.php?id=<?= $product['id']; ?>"
                                            class="product-action edit"
                                            title="Edit"
                                        >
                                            <i class="bi bi-pencil"></i>
                                        </a>


                                        <a
                                            href="delete.php?id=<?= $product['id']; ?>"
                                            class="product-action delete"
                                            title="Delete"
                                        >
                                            <i class="bi bi-trash"></i>
                                        </a>

                                    </div>

                                </td>

                            </tr>

                        <?php } ?>

                    </tbody>

                </table>

            </div>

        </div>

    </main>

</div>


<?php include '../../includes/footer.php'; ?>