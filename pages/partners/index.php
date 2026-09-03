<?php

include "../../config/database.php";
include "../../includes/header.php";
include "../../includes/navbar.php";

?>

<section class="section">

    <div class="container">

        <div class="section-title">

            <h2>All Partners</h2>

            <p>Trusted companies we collaborate with</p>

        </div>


        <div class="row">

            <?php

            $query = "SELECT * FROM partners";

            $result = mysqli_query($conn, $query);


            if ($result && mysqli_num_rows($result) > 0) {

                while ($partner = mysqli_fetch_assoc($result)) {

            ?>

                <div class="col-md-3">

                    <div class="partner-card">

                        <div class="partner-image">

                            <img
                                src="../../admin/assets/images/partners/<?php echo htmlspecialchars($partner['logo'] ?? 'default.png'); ?>"
                                alt="<?php echo htmlspecialchars($partner['name']); ?>"
                            >

                        </div>

                    </div>

                </div>

            <?php

                }

            } else {

                echo "<p style='text-align:center;width:100%;'>
                        No partners found.
                      </p>";

            }

            ?>

        </div>

    </div>

</section>


<?php

include "../../includes/footer.php";

?>