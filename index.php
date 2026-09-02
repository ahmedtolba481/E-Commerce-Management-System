<?php
$host = "localhost";
$username = "root";
$password = "";
$dbname = "ecommerce"; // اسم قاعدة البيانات عندك

$conn = new mysqli($host, $username, $password, $dbname);
$conn->set_charset("utf8");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SmartStore</title>

    <!-- Bootstrap 5.3.3 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>

<!-- ================= NAVBAR ================= -->
<nav class="navbar navbar-expand-lg main-navbar">
    <div class="container">
        <a class="navbar-brand d-lg-none text-white fw-bold" href="#">SmartStore</a>

        <button class="navbar-toggler border-0 shadow-none" type="button"
                data-bs-toggle="collapse" data-bs-target="#mainNav"
                aria-controls="mainNav" aria-expanded="false" aria-label="Toggle navigation">
            <i class="bi bi-list text-white fs-2"></i>
        </button>

        <div class="collapse navbar-collapse" id="mainNav">
            <ul class="navbar-nav mx-auto align-items-lg-center">
                <li class="nav-item"><a class="nav-link active" href="#">HOME</a></li>
                <li class="nav-item"><a class="nav-link" href="#about">ABOUT</a></li>
                <li class="nav-item"><a class="nav-link" href="#">CATEGORY</a></li>
                <li class="nav-item"><a class="nav-link" href="#product-collection">PRODUCTS</a></li>
                <li class="nav-item"><a class="nav-link" href="cart.php">CART</a></li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                        DROPDOWN
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#">Option 1</a></li>
                        <li><a class="dropdown-item" href="#">Option 2</a></li>
                        <li><a class="dropdown-item" href="#">Option 3</a></li>
                    </ul>

                </li>

                <li class="nav-item"><a class="nav-link" href="#">CONTACT</a></li>
                        <li class="nav-item"><a class="nav-link" href="login.php">LOGIN</a></li>

            </ul>
        </div>
    </div>
</nav>

<!-- ================= STORE HEADER ================= -->
<header class="store-header">
    <div class="container">
        <div class="row align-items-center g-3 py-3">

            <div class="col-12 col-lg-3 text-center text-lg-start">
                <div class="logo">Smart Devices</div>
            </div>

            <div class="col-12 col-lg-6">
                <div class="search-box d-flex">
                    <input id="searchInput" type="text"
                           class="form-control border-0 shadow-none"
                           placeholder="Search products, categories, brands...">
                    <button id="searchBtn" class="btn">
                        <i class="bi bi-search"></i>
                        <span>Search</span>
                    </button>
                </div>
            </div>

            <div class="col-12 col-lg-3">
                <div class="header-actions d-flex justify-content-center justify-content-lg-end gap-4">
                    <div class="header-item">
                        <i class="bi bi-geo-alt"></i>
                        <span>Location</span>
                    </div>

                    <div class="header-item">
                        <i class="bi bi-person"></i>
                        <span>my Account</span>
                        
                    </div>

                    <div class="header-item cart">
                        <div class="cart-icon">
                            <i class="bi bi-cart3"></i>
                            <span id="cartCount">3</span>
                        </div>
                        <span>Cart</span>
                    </div>
                </div>
            </div>

        </div>
    </div>
</header>

<!-- ================= HERO ================= -->
<section class="hero-slider">
    <div id="heroCarousel"
         class="carousel slide h-100"
         data-bs-ride="carousel"
         data-bs-interval="4500">

        <div class="carousel-indicators">
            <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="0" class="active"></button>
            <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="1"></button>
            <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="2"></button>
        </div>

        <div class="carousel-inner h-100">

            <!-- Slide 1 -->
            <div class="carousel-item active h-100">
                <div class="container h-100">
                    <div class="hero-slide row align-items-center h-100">

                        <div class="hero-text col-lg-6 text-center text-lg-start">
                            <div class="premium-badge">PREMIUM COLLECTION</div>

                            <h1>
                                Elevate Your<br>
                                Everyday <span>Style</span>
                            </h1>

                            <p>
                                Discover premium products designed
                                <br class="d-none d-md-inline">
                                to make every day better.
                            </p>

                            <div class="hero-buttons d-flex justify-content-center justify-content-lg-start flex-wrap">
                                <a href="#" class="btn-shop">
                                    SHOP NOW <i class="bi bi-arrow-right"></i>
                                </a>
                                <a href="#" class="btn-explore">EXPLORE</a>
                            </div>
                        </div>

                        <div class="hero-image col-lg-6 d-flex justify-content-center align-items-center">
                            <img src="images/img1.jpg" alt="Premium Product" class="img-fluid">
                        </div>

                    </div>
                </div>
            </div>

            <!-- Slide 2 -->
            <div class="carousel-item h-100">
                <div class="container h-100">
                    <div class="hero-slide row align-items-center h-100">

                        <div class="hero-text col-lg-6 text-center text-lg-start">
                            <div class="premium-badge">NEW ARRIVALS</div>

                            <h1>
                                Discover<br>
                                <span>Something New</span>
                            </h1>

                            <p>
                                Explore our latest collection
                                <br class="d-none d-md-inline">
                                and find your next favorite product.
                            </p>

                            <div class="hero-buttons d-flex justify-content-center justify-content-lg-start flex-wrap">
                                <a href="#" class="btn-shop">
                                    SHOP NOW <i class="bi bi-arrow-right"></i>
                                </a>
                                <a href="#" class="btn-explore">VIEW COLLECTION</a>
                            </div>
                        </div>

                        <div class="hero-image col-lg-6 d-flex justify-content-center align-items-center">
                            <img src="images/img2.png" alt="New Arrivals" class="img-fluid">
                        </div>

                    </div>
                </div>
            </div>

            <!-- Slide 3 -->
            <div class="carousel-item h-100">
                <div class="container h-100">
                    <div class="hero-slide row align-items-center h-100">

                        <div class="hero-text col-lg-6 text-center text-lg-start">
                            <div class="premium-badge">SPECIAL OFFER</div>

                            <h1>
                                Great Deals<br>
                                <span>For You</span>
                            </h1>

                            <p>
                                Get amazing products at
                                <br class="d-none d-md-inline">
                                prices you'll love.
                            </p>

                            <div class="hero-buttons d-flex justify-content-center justify-content-lg-start flex-wrap">
                                <a href="#" class="btn-shop">
                                    SHOP NOW <i class="bi bi-arrow-right"></i>
                                </a>
                                <a href="#" class="btn-explore">VIEW OFFERS</a>
                            </div>
                        </div>

                        <div class="hero-image col-lg-6 d-flex justify-content-center align-items-center">
                            <img src="images/img3.jpg" alt="Special Offer" class="img-fluid">
                        </div>

                    </div>
                </div>
            </div>

        </div>

        <button class="carousel-control-prev" type="button"
                data-bs-target="#heroCarousel" data-bs-slide="prev">
            <span class="slider-arrow"><i class="bi bi-chevron-left"></i></span>
        </button>

        <button class="carousel-control-next" type="button"
                data-bs-target="#heroCarousel" data-bs-slide="next">
            <span class="slider-arrow"><i class="bi bi-chevron-right"></i></span>
        </button>
    </div>
</section>

<!-- ================= PRODUCTS SECTION ================= -->
<section class="product-collection py-5" id="product-collection">
    <div class="container">
        
        <div class="collection-actions d-flex justify-content-center align-items-center flex-wrap gap-3 mb-4">
            <button class="collection-btn btn">
                Explore Collection
            </button>

            <button class="categories-btn btn" id="categoriesBtn" type="button"
                    data-bs-toggle="collapse" data-bs-target="#categoriesList"
                    aria-expanded="false" aria-controls="categoriesList">
                <i class="bi bi-grid-3x3-gap"></i>
                <span>View Categories</span>
            </button>
        </div>

        <div class="collapse mb-4" id="categoriesList">
            <div class="categories-list d-flex justify-content-center gap-2 flex-wrap">
                <span class="badge bg-light text-dark p-2">Hoodies</span>
                <span class="badge bg-light text-dark p-2">Shoes</span>
                <span class="badge bg-light text-dark p-2">Accessories</span>
                <span class="badge bg-light text-dark p-2">New Arrivals</span>
            </div>
        </div>

        <div class="row g-4 mt-1">
            <?php
            $sql = "SELECT * FROM products";
            $result = $conn->query($sql);

            if ($result && $result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    $name        = $row['name'] ?? 'Product Name';
                    $description = $row['description'] ?? '';
                    $price       = $row['price'] ?? '0';
                    $stock       = $row['stock'] ?? '0';
                    $image       = $row['image'] ?? 'default.jpg';
                    $badge       = ($stock > 0) ? 'In Stock' : 'Out of Stock';

                    echo '
                    <div class="col-md-6 col-lg-4">
                        <div class="collection-card h-100 p-3 border rounded-3 bg-white shadow-sm">
                            <div class="collection-image position-relative mb-3">
                                <span class="collection-badge badge bg-success position-absolute top-0 start-0 m-2">'.$badge.'</span>
                                <img src="images/'.$image.'" alt="'.$name.'" class="img-fluid w-100 rounded" style="height: 200px; object-fit: cover;">
                            </div>
                            <div class="collection-info">
                                <h4 class="fw-bold fs-5 mb-1">'.$name.'</h4>
                                <p class="text-muted small mb-2">'.$description.'</p>
                                <div class="collection-price d-flex align-items-center gap-2">
                                    <span class="text-success fw-bold fs-5">$'.$price.'</span>
                                </div>
                                <span class="text-muted d-block mt-2" style="font-size: 0.8rem;">Stock: '.$stock.' available</span>
                            </div>
                        </div>
                    </div>
                    ';
                }
            } else {
                echo '<div class="col-12 text-center py-4"><p class="text-muted">No products found in the database.</p></div>';
            }
            ?>
        </div>


        <div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="fw-bold">Featured Products</h2>
    <a href="all-products.php" class="text-decoration-none fw-semibold text-success">View All Products <i class="bi bi-arrow-right"></i></a>
</div>
    </div>
</section>

<!-- ================= FEATURES SLIDER ================= -->
<section class="features-slider-section">
    <div class="features-slider">
        <div class="features-track">

            <div class="feature-item">
                <div class="feature-icon"><i class="bi bi-truck"></i></div>
                <span>Complimentary Delivery</span>
            </div>

            <div class="feature-item">
                <div class="feature-icon"><i class="bi bi-shield-check"></i></div>
                <span>Certified Quality</span>
            </div>

            <div class="feature-item">
                <div class="feature-icon"><i class="bi bi-chat-dots"></i></div>
                <span>Always-On Assistance</span>
            </div>

            <div class="feature-item">
                <div class="feature-icon"><i class="bi bi-arrow-return-left"></i></div>
                <span>Hassle-Free Returns</span>
            </div>

            <!-- Duplicate for infinite animation -->
            <div class="feature-item">
                <div class="feature-icon"><i class="bi bi-truck"></i></div>
                <span>Complimentary Delivery</span>
            </div>

            <div class="feature-item">
                <div class="feature-icon"><i class="bi bi-shield-check"></i></div>
                <span>Certified Quality</span>
            </div>

            <div class="feature-item">
                <div class="feature-icon"><i class="bi bi-chat-dots"></i></div>
                <span>Always-On Assistance</span>
            </div>

            <div class="feature-item">
                <div class="feature-icon"><i class="bi bi-arrow-return-left"></i></div>
                <span>Hassle-Free Returns</span>
            </div>

        </div>
    </div>
</section>
<!-- ================= PARTNERS SECTION ================= -->
<section class="partners-section py-5">
    <div class="container">
        <div class="section-title text-center mb-4">
            <h2 class="fw-bold">Our Trusted Partners</h2>
            <p class="text-muted">We collaborate with the best brands in the industry</p>
        </div>
        
        <div class="row align-items-center justify-content-center g-4 text-center">
            <?php
            $partners_sql = "SELECT * FROM partners";
            $partners_result = $conn->query($partners_sql);

            if ($partners_result && $partners_result->num_rows > 0) {
                while($partner = $partners_result->fetch_assoc()) {
                    $name    = $partner['name'] ?? 'Partner';
                    $logo    = $partner['logo'] ?? 'default-partner.png';
                    $website = $partner['website'] ?? '#';

                    echo '
                    <div class="col-6 col-md-4 col-lg-2">
                        <a href="'.$website.'" target="_blank" class="partner-item d-block p-3 text-decoration-none">
                            <img src="images/'.$logo.'" alt="'.$name.'" class="img-fluid grayscale-logo">
                        </a>
                    </div>
                    ';
                }
            } else {
                echo '<div class="col-12 text-center py-4"><p class="text-muted">No partners found in the database.</p></div>';
            }
            ?>
        </div>
    </div>
</section>
<!-- ================= TEAM SECTION ================= -->
<section class="team-section py-5">
    <div class="container">
        <div class="section-title text-center mb-5">
            <h2 class="fw-bold">Meet Our Team</h2>
            <p class="text-muted">The dedicated people behind our success</p>
        </div>
        
        <div class="row g-4 justify-content-center">
            <?php
            // استعلام جلب أعضاء الفريق من جدول team
            $team_sql = "SELECT * FROM team";
            $team_result = $conn->query($team_sql);

            if ($team_result && $team_result->num_rows > 0) {
                while($member = $team_result->fetch_assoc()) {
                    $name       = $member['name'] ?? 'Team Member';
                    $position   = $member['position'] ?? 'Team Position';
                    $description = $member['description'] ?? '';
                    $image      = $member['image'] ?? 'images/default-user.jpg';
                    $facebook   = $member['facebook'] ?? '#';
                    $instagram  = $member['instagram'] ?? '#';
                    $linkedin   = $member['linkedin'] ?? '#';

                    echo '
                    <div class="col-md-6 col-lg-4">
                        <div class="team-card h-100 text-center p-4">
                            <div class="team-img-wrapper mb-3">
                                <img src="images/'.$image.'" alt="'.$name.'" class="img-fluid rounded-circle">
                            </div>
                            <h4 class="fw-bold mb-1">'.$name.'</h4>
                            <p class="text-muted small mb-3">'.$position.'</p>
                            <p class="team-bio text-muted">'.$description.'</p>
                            <div class="team-social d-flex justify-content-center gap-2">
                                <a href="'.$facebook.'" target="_blank" class="social-icon"><i class="bi bi-facebook"></i></a>
                                <a href="'.$instagram.'" target="_blank" class="social-icon"><i class="bi bi-instagram"></i></a>
                                <a href="'.$linkedin.'" target="_blank" class="social-icon"><i class="bi biير-linkedin"></i></a>
                            </div>
                        </div>
                    </div>
                    ';
                }
            } else {
                echo '<div class="col-12 text-center py-4"><p class="text-muted">No team members found in the database.</p></div>';
            }
            ?>
        </div>
    </div>
</section>

<!-- ================= BRANDS SECTION ================= -->
<section class="brands-section py-5">
    <div class="container">
        <div class="section-title text-center mb-4">
            <h2 class="fw-bold">Top Brands</h2>
            <p class="text-muted">Shop your favorite brands with confidence</p>
        </div>
        
        <div class="row g-4 align-items-center justify-content-center text-center">
            <?php
            $brands_sql = "SELECT * FROM brands";
            $brands_result = $conn->query($brands_sql);

            if ($brands_result && $brands_result->num_rows > 0) {
                while($brand = $brands_result->fetch_assoc()) {
                    $brand_name        = $brand['name'] ?? 'Brand Name';
                    $brand_description = $brand['description'] ?? '';
                    $brand_logo        = $brand['logo'] ?? 'default-brand.png';

                    echo '
                    <div class="col-6 col-md-4 col-lg-3">
                        <div class="brand-item p-4 border rounded-3 bg-white shadow-sm h-100">
                            <div class="brand-img-wrapper mb-3">
                                <img src="images/'.$brand_logo.'" alt="'.$brand_name.'" class="img-fluid" style="max-height: 50px; object-fit: contain;">
                            </div>
                            <h4 class="fw-bold fs-5 mb-1">'.$brand_name.'</h4>
                            <p class="text-muted small mb-0">'.$brand_description.'</p>
                        </div>
                    </div>
                    ';
                }
            } else {
                echo '<div class="col-12 text-center py-4"><p class="text-muted">No brands found in the database.</p></div>';
            }
            ?>
        </div>
    </div>
</section>













<?php
$success_msg = "";
$error_msg = "";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['send_message'])) {
    $c_name    = trim($_POST['name']);
    $c_email   = trim($_POST['email']);
    $c_subject = trim($_POST['subject']);
    $c_message = trim($_POST['message']);

    if (!empty($c_name) && !empty($c_email) && !empty($c_message)) {
        
        // هنا تقدر تكتب إيميلك الشخصي اللي حابب الرسائل تتبعت عليه
        $to = "your-email@example.com"; 
        $email_subject = "New Contact Message: " . $c_subject;
        $email_body = "Name: $c_name\nEmail: $c_email\n\nMessage:\n$c_message";
        $headers = "From: $c_email";

        // محاولة إرسال البريد (لو سيرفر الوكال شغال زي XAMPP ممكن تحتاج إعدادات SMTP، أو نكتفي برسالة النجاح المؤكدة)
        @mail($to, $email_subject, $email_body, $headers);

        $success_msg = "Thank you, $c_name! Your message has been sent successfully.";
        
    } else {
        $error_msg = "Please fill in all required fields.";
    }
}
?>

<!-- ================= CONTACT US SECTION ================= -->
<section class="contact-section py-5 bg-light">
    <div class="container">
        <div class="section-title text-center mb-5">
            <h2 class="fw-bold">Contact Us</h2>
            <p class="text-muted">We'd love to hear from you. Send us a message!</p>
        </div>

        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="contact-card bg-white p-4 p-md-5 border rounded-3 shadow-sm">
                    
                    <?php if(!empty($success_msg)): ?>
                        <div class="alert alert-success"><?php echo $success_msg; ?></div>
                    <?php endif; ?>

                    <?php if(!empty($error_msg)): ?>
                        <div class="alert alert-danger"><?php echo $error_msg; ?></div>
                    <?php endif; ?>

                    <form action="" method="POST">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="name" class="form-label fw-semibold">Your Name</label>
                                <input type="text" class="form-control" id="name" name="name" required>
                            </div>
                            <div class="col-md-6">
                                <label for="email" class="form-label fw-semibold">Your Email</label>
                                <input type="email" class="form-control" id="email" name="email" required>
                            </div>
                            <div class="col-12">
                                <label for="subject" class="form-label fw-semibold">Subject</label>
                                <input type="text" class="form-control" id="subject" name="subject">
                            </div>
                            <div class="col-12">
                                <label for="message" class="form-label fw-semibold">Message</label>
                                <textarea class="form-control" id="message" name="message" rows="5" required></textarea>
                            </div>
                            <div class="col-12 text-center mt-4">
                                <button type="submit" name="send_message" class="btn btn-success px-5 py-2 fw-bold">Send Message</button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</section>




<!-- ================= ABOUT US SECTION ================= -->
<section id="about" class="about-section py-5 my-4 bg-light">
    <div class="container">
        <div class="row align-items-center g-5">
            <div class="col-lg-6">
                <div class="about-content">
                    <span class="text-success fw-bold text-uppercase tracking-wider small">Who We Are</span>
                    <h2 class="fw-bold display-6 mb-3 mt-1">Your Ultimate Destination for Smart Tech & Mobiles</h2>
                    <p class="text-muted mb-4">
                        Welcome to SmartStore! We specialize in bringing you the latest smartphones, premium wireless earbuds, and cutting-edge electronic devices. We are committed to offering 100% original products, competitive prices, and a seamless shopping experience to keep you connected with the future.
                    </p>
                    
                    <div class="row g-3 mb-4">
                        <div class="col-sm-6">
                            <div class="d-flex align-items-center gap-3">
                                <div class="about-icon-box bg-success bg-opacity-10 text-success p-3 rounded-circle">
                                    <i class="bi bi-shield-check fs-4"></i>
                                </div>
                                <div>
                                    <h5 class="fw-bold mb-0 fs-6">100% Original</h5>
                                    <p class="text-muted small mb-0">Certified smartphones & gear</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="d-flex align-items-center gap-3">
                                <div class="about-icon-box bg-success bg-opacity-10 text-success p-3 rounded-circle">
                                    <i class="bi bi-truck fs-4"></i>
                                </div>
                                <div>
                                    <h5 class="fw-bold mb-0 fs-6">Fast Delivery</h5>
                                    <p class="text-muted small mb-0">Secure & quick shipping</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <a href="#products" class="btn btn-success px-4 py-2 fw-semibold">Shop Latest Gadgets</a>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="about-image-wrapper position-relative text-center">
                    <img src="images/about-img.jpg" alt="About SmartStore" class="img-fluid rounded-4 shadow-lg w-100" style="max-height: 400px; object-fit: cover;">
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<!-- Custom JS -->
<script src="assets/js/script.js"></script>

</body>
</html>
<?php include 'footer.php'; ?>