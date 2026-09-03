<?php
include "../../config/database.php";
include "../../includes/header.php";
include "../../includes/navbar.php";
?>

<section class="section">

    <div class="container">

        <div class="section-title">
            <h2>All Categories</h2>
            <p>Browse all our product categories</p>
        </div>

        <div class="row">

            <?php
            $categoryQuery = "SELECT * FROM categories ORDER BY id ASC";
            $categoryResult = mysqli_query($conn, $categoryQuery);

            if ($categoryResult && mysqli_num_rows($categoryResult) > 0) {

                while ($category = mysqli_fetch_assoc($categoryResult)) {

                    $image = !empty($category['image'])
                        ? $category['image']
                        : 'default.jpg';
            ?>

                <div class="col-md-3">

                    <a href="/E-Commerce-Management-System/pages/products/index.php?category=<?php echo $category['id']; ?>"
                       class="category-card">

                        <div class="category-image">

                            <img
                                src="/E-Commerce-Management-System/assets/images/categories/<?php echo htmlspecialchars($image); ?>"
                                alt="<?php echo htmlspecialchars($category['name']); ?>"
                            >

                        </div>

                        <h3>
                            <?php echo htmlspecialchars($category['name']); ?>
                        </h3>

                    </a>

                </div>

            <?php
                }
            } else {
                echo "<p style='text-align:center;width:100%;'>No categories found.</p>";
            }
            ?>

        </div>

    </div>

</section>

<?php
include "../../includes/footer.php";
?>