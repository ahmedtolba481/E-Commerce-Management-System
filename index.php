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
                <li class="nav-item"><a class="nav-link" href="#">ABOUT</a></li>
                <li class="nav-item"><a class="nav-link" href="#">CATEGORY</a></li>
                <li class="nav-item"><a class="nav-link" href="#">CHECKOUT</a></li>

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

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                        MEGAMENU
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#">Electronics</a></li>
                        <li><a class="dropdown-item" href="#">Fashion</a></li>
                        <li><a class="dropdown-item" href="#">Accessories</a></li>
                    </ul>
                </li>

                <li class="nav-item"><a class="nav-link" href="#">CART</a></li>
                <li class="nav-item"><a class="nav-link" href="#">CONTACT</a></li>
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

<!-- ================= PRODUCT COLLECTION ================= -->
<section class="product-collection">
    <div class="container">

        <div class="collection-actions d-flex justify-content-center align-items-center flex-wrap gap-3">
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

        <div class="collapse" id="categoriesList">
            <div class="categories-list d-flex justify-content-center gap-2 flex-wrap">
                <span>Hoodies</span>
                <span>Shoes</span>
                <span>Accessories</span>
                <span>New Arrivals</span>
            </div>
        </div>

        <div class="row g-4 mt-1">

            <div class="col-md-6 col-lg-4">
                <div class="collection-card h-100">
                    <div class="collection-image">
                        <span class="collection-badge">Top Rated</span>
                        <img src="images/hoodie.png" alt="Signature Audio Device">
                    </div>
                    <div class="collection-info">
                        <h3>Signature Audio Device</h3>
                        <div class="collection-price">
                            <span>$249</span>
                            <del>$349</del>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-4">
                <div class="collection-card featured-card h-100">
                    <div class="collection-image">
                        <span class="collection-badge">Most Popular</span>
                        <img src="images/shoes-black.png" alt="Elite Smart Accessory">
                    </div>
                    <div class="collection-info">
                        <h3>Elite Smart Accessory</h3>
                        <div class="collection-price">
                            <span>$179</span>
                            <del>$259</del>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-4">
                <div class="collection-card h-100">
                    <div class="collection-image">
                        <span class="collection-badge">New Arrival</span>
                        <img src="images/shoes-white.png" alt="Modern Lifestyle Gear">
                    </div>
                    <div class="collection-info">
                        <h3>Modern Lifestyle Gear</h3>
                        <div class="collection-price">
                            <span>$129</span>
                            <del>$189</del>
                        </div>
                    </div>
                </div>
            </div>

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

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<!-- Custom JS -->
<script src="assets/js/script.js"></script>

</body>
</html>
