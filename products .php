<?php
include 'config/database.php';
session_start();

// جلب كل المنتجات من قاعدة البيانات (تأكد إن اسم الجدول عندك products)
$sql = "SELECT * FROM products ORDER BY id DESC";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SmartStore - All Products</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
    <link href="assets/css/style.css" rel="stylesheet">
</head>
<body class="bg-light">

    <!-- Header / Navbar المختصر أو تقدر تضمن الـ header بتاعك -->
    <div class="bg-dark text-white py-4 mb-4">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center">
                <h1 class="fw-bold fs-3 mb-0">All Products</h1>
                <a href="index.php" class="text-white text-decoration-none small"><i class="bi bi-arrow-left"></i> Back to Home</a>
            </div>
        </div>
    </div>

    <!-- Products Section -->
    <div class="container mb-5">
        <div class="row g-4">
            <?php 
            if ($result && $result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    // افتح الكارت لكل منتج
                    ?>
                    <div class="col-lg-3 col-md-4 col-sm-6">
                        <div class="card h-100 border-0 shadow-sm rounded-4 overflow-hidden product-card">
                            <div class="position-relative bg-white text-center p-3">
                                <img src="images/<?php echo htmlspecialchars($row['image']); ?>" alt="<?php echo htmlspecialchars($row['name']); ?>" class="img-fluid" style="height: 180px; object-fit: contain;">
                                <span class="badge bg-success position-absolute top-0 start-0 m-3">New</span>
                            </div>
                            <div class="card-body d-flex flex-column bg-white">
                                <h5 class="fw-bold fs-6 mb-2"><?php echo htmlspecialchars($row['name']); ?></h5>
                                <p class="text-muted small mb-3 flex-grow-1"><?php echo substr(htmlspecialchars($row['description']), 0, 60); ?>...</p>
                                <div class="d-flex align-items-center justify-content-between mt-auto">
                                    <span class="fw-bold text-success fs-5">$<?php echo htmlspecialchars($row['price']); ?></span>
                                    <a href="product-details.php?id=<?php echo $row['id']; ?>" class="btn btn-outline-dark btn-sm rounded-pill px-3">View Details</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                }
            } else {
                echo '<div class="col-12 text-center py-5"><p class="text-muted">No products found at the moment.</p></div>';
            }
            ?>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
<?php include 'footer.php'; ?>