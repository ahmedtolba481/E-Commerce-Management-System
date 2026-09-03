<?php
include "../../config/database.php";
include "../../includes/header.php";
include "../../includes/navbar.php";
?>

<section class="section">

    <div class="container">

        <div class="section-title">
            <h2>All Brands</h2>
            <p>Browse all the brands we work with</p>
        </div>

        <div class="row">

            <?php

            $query = "SELECT * FROM brands ORDER BY id ASC";
            $result = mysqli_query($conn, $query);

            if ($result && mysqli_num_rows($result) > 0) {

                while ($brand = mysqli_fetch_assoc($result)) {
            ?>

                <div class="col-md-3">

                    <div class="brand-card card">

                        <div class="brand-image">

                            <img
                                src="../../admin/assets/images/brands/<?php echo htmlspecialchars($brand['logo'] ?? 'default.png'); ?>"
                                alt="<?php echo htmlspecialchars($brand['name']); ?>"
                            >

                        </div>

                        <h4 style="margin-top: 1rem; margin-bottom: 0; font-size: 1.1rem;">
                            <?php echo htmlspecialchars($brand['name']); ?>
                        </h4>

                    </div>

                </div>

            <?php

                }

            } else {

                echo "<p style='text-align:center;width:100%;'>No brands found.</p>";

            }

            ?>

        </div>

    </div>

</section>

<?php
include "../../includes/footer.php";
?>