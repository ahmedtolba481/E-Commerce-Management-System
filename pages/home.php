<?php
include "../config/database.php";
include "../includes/header.php";
include "../includes/navbar.php";
?>

<!-- ================= HERO ================= -->
<section class="section" style="background: linear-gradient(135deg, #172B4D 0%, #19A974 100%); color: white; padding: 6rem 0;">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-6">
                <h1 style="color: white; font-size: 3rem; margin-bottom: 1rem;">Discover Everything You Need</h1>
                <p style="font-size: 1.2rem; margin-bottom: 2rem; opacity: 0.9;">Quality products. Simple shopping. Fast delivery.</p>
                <a href="/E-Commerce-Management-System/pages/products/index.php" class="btn btn-secondary btn-lg" style="padding: 1rem 2rem; font-size: 1.1rem;">Shop Now <i class="bi bi-arrow-right"></i></a>
            </div>
            <div class="col-md-6" style="text-align: center;">
                <img src="../assets/images/slider/slide1.jpg" alt="Hero Image" style="max-width: 100%; border-radius: 12px; box-shadow: 0 20px 40px rgba(0,0,0,0.2);">
            </div>
        </div>
    </div>
</section>

<section class="section">
    <div class="container">

        <div class="section-title">
            <h2>Shop by Category</h2>
            <p>Find what you're looking for easily</p>
        </div>

        <div class="row">

            <?php
            $categoryQuery = "SELECT * FROM categories ORDER BY id ASC LIMIT 4";
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
            }
            ?>

        </div>
<div style="text-align: center; margin-top: 3rem;">
            <a href="/E-Commerce-Management-System/pages/categories/index.php"
               class="btn btn-primary btn-lg">
                View All Categories
            </a>
        </div>




    </div>
</section>

<!-- ================= FEATURED PRODUCTS ================= -->
<section class="section" style="background: var(--background);">
    <div class="container">
        <div class="section-title">
            <h2>Featured Products</h2>
            <p>Our most popular items this week</p>
        </div>
        <div class="row">
            <?php
            $query = "SELECT products.*, categories.name AS category_name, brands.name AS brand_name 
                      FROM products 
                      LEFT JOIN categories ON products.category_id = categories.id 
                      LEFT JOIN brands ON products.brand_id = brands.id 
                      LIMIT 4";
            $result = mysqli_query($conn, $query);
            if ($result && mysqli_num_rows($result) > 0) {
                while ($product = mysqli_fetch_assoc($result)) {
            ?>
                <div class="col-md-3">
                    <div class="product-card">
                        <div class="product-image">
                            <img src="../assets/images/products/<?php echo htmlspecialchars($product['image'] ?? 'default.jpg'); ?>" onerror="this.src='../assets/images/products/<?php echo htmlspecialchars($product['image'] ?? 'iphone15.jpg'); ?>'" alt="<?php echo htmlspecialchars($product['name']); ?>">
                        </div>
                        <div class="product-info">
                            <?php if(!empty($product['brand_name'])): ?>
                                <div class="product-brand"><?php echo htmlspecialchars($product['brand_name']); ?></div>
                            <?php endif; ?>
                            <div class="product-name"><?php echo htmlspecialchars($product['name']); ?></div>
                            <div class="product-price">$<?php echo htmlspecialchars($product['price']); ?></div>
                            <div class="product-actions">
                                <a href="/E-Commerce-Management-System/pages/products/details.php?id=<?php echo $product['id']; ?>" class="btn btn-secondary icon-btn" title="View Details"><i class="bi bi-eye"></i></a>
                                <form action="/E-Commerce-Management-System/actions/cart/add.php" method="POST" style="flex:1;">
                                    <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">
                                    <input type="hidden" name="quantity" value="1">
                                    <button type="submit" class="btn btn-primary" style="width:100%;"><i class="bi bi-cart-plus"></i> Add</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            <?php
                }
            } else {
                echo "<p style='text-align:center;width:100%;'>No products found.</p>";
            }
            ?>
        </div>
        <div style="text-align: center; margin-top: 3rem;">
            <a href="/E-Commerce-Management-System/pages/products/index.php" class="btn btn-primary btn-lg">View All Products</a>
        </div>
    </div>
</section>

<!-- ================= BRANDS ================= -->
<section class="section">
    <div class="container">
        <div class="section-title">
            <h2>Top Brands</h2>
            <p>We work with the best in the industry</p>
        </div>
        <div class="row">
            <?php
            $query = "SELECT * FROM brands LIMIT 4";
            $result = mysqli_query($conn, $query);
            if ($result && mysqli_num_rows($result) > 0) {
                while ($brand = mysqli_fetch_assoc($result)) {
            ?>
                <div class="col-md-3">
                    <div class="brand-card card">
                        <div class="brand-image">
                            <img src="../admin/assets/images/brands/<?php echo htmlspecialchars($brand['logo'] ?? 'default.png'); ?>" onerror="this.src='../assets/images/brands/<?php echo htmlspecialchars($brand['logo'] ?? 'apple.png'); ?>'" alt="<?php echo htmlspecialchars($brand['name']); ?>">
                        </div>
                        <h4 style="margin-top: 1rem; margin-bottom: 0; font-size: 1.1rem;"><?php echo htmlspecialchars($brand['name']); ?></h4>
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

<!-- ================= WHY CHOOSE US ================= -->
<section class="section" style="background: var(--background);">
    <div class="container">
        <div class="section-title">
            <h2>Why Choose Us</h2>
            <p>What makes ShopEase different</p>
        </div>
        <div class="row">
            <div class="col-md-3">
                <div class="card" style="padding: 2rem; text-align: center; height: 100%;">
                    <div style="font-size: 2.5rem; color: var(--primary); margin-bottom: 1rem;"><i class="bi bi-truck"></i></div>
                    <h4>Fast Delivery</h4>
                    <p style="color: var(--text); font-size: 0.9rem;">We ensure your products arrive as quickly as possible with our express delivery partners.</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card" style="padding: 2rem; text-align: center; height: 100%;">
                    <div style="font-size: 2.5rem; color: var(--primary); margin-bottom: 1rem;"><i class="bi bi-shield-check"></i></div>
                    <h4>100% Secure</h4>
                    <p style="color: var(--text); font-size: 0.9rem;">Your payments are protected with industry-leading encryption and security protocols.</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card" style="padding: 2rem; text-align: center; height: 100%;">
                    <div style="font-size: 2.5rem; color: var(--primary); margin-bottom: 1rem;"><i class="bi bi-award"></i></div>
                    <h4>Original Products</h4>
                    <p style="color: var(--text); font-size: 0.9rem;">We only sell 100% genuine and original products sourced directly from manufacturers.</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card" style="padding: 2rem; text-align: center; height: 100%;">
                    <div style="font-size: 2.5rem; color: var(--primary); margin-bottom: 1rem;"><i class="bi bi-headset"></i></div>
                    <h4>24/7 Support</h4>
                    <p style="color: var(--text); font-size: 0.9rem;">Our dedicated customer support team is available around the clock to help you.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ================= PARTNERS ================= -->
<section class="section">
    <div class="container">
        <div class="section-title">
            <h2>Our Partners</h2>
            <p>Trusted companies we collaborate with</p>
        </div>
        <div class="row">
            <?php
            $query = "SELECT * FROM partners LIMIT 6";
            $result = mysqli_query($conn, $query);
            if ($result && mysqli_num_rows($result) > 0) {
                while ($partner = mysqli_fetch_assoc($result)) {
            ?>
                <div class="col-md-2" style="padding: 1rem;">
                    <div class="partner-card">
                        <div class="partner-image">
                            <img src="../admin/assets/images/partners/<?php echo htmlspecialchars($partner['logo'] ?? 'default.png'); ?>" onerror="this.src='../assets/images/partners/<?php echo htmlspecialchars($partner['logo'] ?? 'partner1.png'); ?>'" alt="<?php echo htmlspecialchars($partner['name']); ?>">
                        </div>
                    </div>
                </div>
            <?php
                }
            } else {
                echo "<p style='text-align:center;width:100%;'>No partners found.</p>";
            }
            ?>
        </div>
    </div>
</section>

<!-- ================= TEAM ================= -->
<section class="section" style="background: var(--background);">
    <div class="container">
        <div class="section-title">
            <h2>Meet Our Team</h2>
            <p>The people behind ShopEase</p>
        </div>
        <div class="row">
            <?php
            $query = "SELECT * FROM team LIMIT 3";
            $result = mysqli_query($conn, $query);
            if ($result && mysqli_num_rows($result) > 0) {
                while ($member = mysqli_fetch_assoc($result)) {
            ?>
                <div class="col-md-4">
                    <div class="team-card">
                        <div class="team-image">
                            <!-- Note: Old logic loaded team images from products. We will try products then team folder -->
                            <img src="../admin/assets/images/products/<?php echo htmlspecialchars($member['image'] ?? 'default.jpg'); ?>" onerror="this.src='../assets/images/team/<?php echo htmlspecialchars($member['image'] ?? 'ahmed.jpg'); ?>'" alt="<?php echo htmlspecialchars($member['name']); ?>">
                        </div>
                        <div class="team-info">
                            <h4 style="margin-bottom: 0.2rem;"><?php echo htmlspecialchars($member['name']); ?></h4>
                            <div style="color: var(--primary); font-weight: 500; margin-bottom: 1rem;"><?php echo htmlspecialchars($member['position'] ?? 'Team Member'); ?></div>
                            <p style="color: var(--text); font-size: 0.9rem; margin-bottom: 1.5rem;"><?php echo htmlspecialchars($member['description'] ?? ''); ?></p>
                            <div style="display: flex; gap: 0.5rem; justify-content: center;">
                                <a href="<?php echo htmlspecialchars($member['facebook'] ?? '#'); ?>" class="icon-btn"><i class="bi bi-facebook"></i></a>
                                <a href="<?php echo htmlspecialchars($member['instagram'] ?? '#'); ?>" class="icon-btn"><i class="bi bi-instagram"></i></a>
                                <a href="<?php echo htmlspecialchars($member['linkedin'] ?? '#'); ?>" class="icon-btn"><i class="bi bi-linkedin"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php
                }
            } else {
                echo "<p style='text-align:center;width:100%;'>No team members found.</p>";
            }
            ?>
        </div>
    </div>
</section>

<!-- ================= ABOUT US ================= -->
<section id="about" class="section">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-6">
                <img src="../assets/images/slider/slide2.jpg" alt="About Us" style="max-width: 100%; border-radius: 12px; box-shadow: 0 10px 30px rgba(0,0,0,0.1);">
            </div>
            <div class="col-md-6" style="padding-left: 2rem;">
                <div style="color: var(--primary); font-weight: 600; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 0.5rem;">About Us</div>
                <h2 style="font-size: 2.5rem; margin-bottom: 1.5rem;">Your Ultimate Destination for Smart Tech</h2>
                <p style="font-size: 1.1rem; margin-bottom: 1.5rem; color: var(--text);">Welcome to ShopEase! We specialize in bringing you the latest smartphones, premium wireless earbuds, and cutting-edge electronic devices. We are committed to offering 100% original products, competitive prices, and a seamless shopping experience.</p>
                <div style="display: flex; gap: 1rem; margin-bottom: 2rem;">
                    <div style="display: flex; align-items: center; gap: 0.5rem; font-weight: 500;"><i class="bi bi-check-circle-fill text-primary" style="color: var(--primary);"></i> Top Quality</div>
                    <div style="display: flex; align-items: center; gap: 0.5rem; font-weight: 500;"><i class="bi bi-check-circle-fill text-primary" style="color: var(--primary);"></i> Fast Support</div>
                </div>
                <a href="#contact" class="btn btn-primary">Contact Us</a>
            </div>
        </div>
    </div>
</section>

<!-- ================= CONTACT US ================= -->
<section id="contact" class="section" style="background: var(--background);">
    <div class="container">
        <div class="section-title">
            <h2>Contact Us</h2>
            <p>We'd love to hear from you</p>
        </div>
        <div class="row" style="justify-content: center;">
            <div class="col-md-8">
                <div class="card" style="padding: 3rem;">
                    <form action="#" method="POST">
                        <div class="row">
                            <div class="col-md-6">
                                <label class="form-label">Your Name</label>
                                <input type="text" class="form-control" name="name" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Your Email</label>
                                <input type="email" class="form-control" name="email" required>
                            </div>
                        </div>
                        <div class="row" style="margin-top: 1rem;">
                            <div class="col-12">
                                <label class="form-label">Subject</label>
                                <input type="text" class="form-control" name="subject" required>
                            </div>
                        </div>
                        <div class="row" style="margin-top: 1rem;">
                            <div class="col-12">
                                <label class="form-label">Message</label>
                                <textarea class="form-control" name="message" rows="5" required></textarea>
                            </div>
                        </div>
                        <div style="text-align: center; margin-top: 2rem;">
                            <button type="submit" class="btn btn-primary btn-lg" style="padding: 0.75rem 3rem;">Send Message</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<?php
include "../includes/footer.php";
?>
