<!DOCTYPE html>
<html>
<head>
    <title>Local Brand</title>
</head>

<body>


<!DOCTYPE html>
<html lang="en">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>SmartStore</title>

    <!-- Bootstrap -->
    <link 
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" 
        rel="stylesheet"
    >

    <!-- Bootstrap Icons -->
    <link 
        rel="stylesheet" 
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"
    >

    <!-- CSS -->
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>

    <!-- ================= NAVBAR ================= -->

    <nav class="navbar navbar-expand-lg main-navbar">
        <div class="container">

            <!-- Mobile Button -->
            <button 
                class="navbar-toggler" 
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#mainNav"
            >
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="mainNav">

                <ul class="navbar-nav mx-auto">

                    <li class="nav-item">
                        <a class="nav-link active" href="#">HOME</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="#">ABOUT</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="#">CATEGORY</a>
                    </li>

                 
                   

                    <li class="nav-item">
                        <a class="nav-link" href="#">CHECKOUT</a>
                    </li>

                    <!-- Dropdown -->
                    <li class="nav-item dropdown">
                        <a 
                            class="nav-link dropdown-toggle" 
                            href="#" 
                            role="button"
                            data-bs-toggle="dropdown"
                        >
                            DROPDOWN
                        </a>

                        <ul class="dropdown-menu">
                            <li>
                                <a class="dropdown-item" href="#">Option 1</a>
                            </li>

                            <li>
                                <a class="dropdown-item" href="#">Option 2</a>
                            </li>

                            <li>
                                <a class="dropdown-item" href="#">Option 3</a>
                            </li>
                        </ul>
                    </li>

                    <!-- Mega Menu 1 -->
                    <li class="nav-item dropdown">
                        <a 
                            class="nav-link dropdown-toggle" 
                            href="#" 
                            data-bs-toggle="dropdown"
                        >
                            MEGAMENU 
                        </a>

                        <ul class="dropdown-menu">
                            <li>
                                <a class="dropdown-item" href="#">Electronics</a>
                            </li>

                            <li>
                                <a class="dropdown-item" href="#">Fashion</a>
                            </li>

                            <li>
                                <a class="dropdown-item" href="#">Accessories</a>
                            </li>
                        </ul>
                    </li>

                  <li class="nav-item">
                        <a class="nav-link" href="#">CART</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="#">CONTACT</a>
                    </li>

                </ul>

            </div>
        </div>
    </nav>


    <!-- ================= HEADER ================= -->

    <header class="store-header">

        <div class="container">

            <div class="header-content">

                <!-- Logo -->
                <div class="logo">
            Smart Devices
                </div>


                <!-- Search -->
                <div class="search-box">

                    <input 
                        type="text" 
                        id="searchInput"
                        placeholder="Search products, categories, brands..."
                    >

                    <button id="searchBtn">
                        <i class="bi bi-search"></i>
                        <span>Search</span>
                    </button>

                </div>


                <!-- Right Side -->
                <div class="header-actions">

                    <!-- Stores -->
                    <div class="header-item">
                        <i class="bi bi-geo-alt"></i>

                        <span>Location</span>
                    </div>


                    <!-- Account -->
                    <div class="header-item">
                        <i class="bi bi-person"></i>

                        <span>my Account</span>
                    </div>


                    <!-- Cart -->
                    <div class="header-item cart">

                        <div class="cart-icon">

                            <i class="bi bi-cart3"></i>

                            <span id="cartCount">
                                3
                            </span>

                        </div>

                        <span>Cart</span>

                    </div>

                </div>

            </div>

        </div>

    </header>


    <!-- ================= HERO ================= -->

    <!-- ================= HERO SLIDER ================= -->

<section class="hero-slider">

    <div id="heroCarousel" class="carousel slide" data-bs-ride="carousel">

        <!-- Indicators -->
        <div class="carousel-indicators">

            <button
                type="button"
                data-bs-target="#heroCarousel"
                data-bs-slide-to="0"
                class="active">
            </button>

            <button
                type="button"
                data-bs-target="#heroCarousel"
                data-bs-slide-to="1">
            </button>

            <button
                type="button"
                data-bs-target="#heroCarousel"
                data-bs-slide-to="2">
            </button>

        </div>


        <!-- Slides -->
        <div class="carousel-inner">


            <!-- ================= SLIDE 1 ================= -->

            <div class="carousel-item active">

                <div class="container">

                    <div class="hero-slide">

                        <!-- LEFT CONTENT -->

                        <div class="hero-text">

                            <div class="premium-badge">
                                PREMIUM COLLECTION
                            </div>

                            <h1>
                                Elevate Your
                                <br>
                                Everyday
                                <span>Style</span>
                            </h1>

                            <p>
                                Discover premium products designed
                                <br>
                                to make every day better.
                            </p>

                            <div class="hero-buttons">

                                <a href="#" class="btn-shop">
                                    SHOP NOW
                                    <i class="bi bi-arrow-right"></i>
                                </a>

                                <a href="#" class="btn-explore">
                                    EXPLORE
                                </a>

                            </div>

                        </div>


                        <!-- RIGHT IMAGE -->

                        <div class="hero-image">

                            <img 
                                src="images/img1.jpg"
                                alt="Premium Product"
                            >

                        </div>

                    </div>

                </div>

            </div>


            <!-- ================= SLIDE 2 ================= -->

            <div class="carousel-item">

                <div class="container">

                    <div class="hero-slide">

                        <div class="hero-text">

                            <div class="premium-badge">
                                NEW ARRIVALS
                            </div>

                            <h1>
                                Discover
                                <br>
                                <span>Something New</span>
                            </h1>

                            <p>
                                Explore our latest collection
                                <br>
                                and find your next favorite product.
                            </p>

                            <div class="hero-buttons">

                                <a href="#" class="btn-shop">
                                    SHOP NOW
                                    <i class="bi bi-arrow-right"></i>
                                </a>

                                <a href="#" class="btn-explore">
                                    VIEW COLLECTION
                                </a>

                            </div>

                        </div>


                        <div class="hero-image">

                            <img 
                                src="images/img2.png"
                                alt="New Arrivals"
                            >

                        </div>

                    </div>

                </div>

            </div>


            <!-- ================= SLIDE 3 ================= -->

            <div class="carousel-item">

                <div class="container">

                    <div class="hero-slide">

                        <div class="hero-text">

                            <div class="premium-badge">
                                SPECIAL OFFER
                            </div>

                            <h1>
                                Great Deals
                                <br>
                                <span>For You</span>
                            </h1>

                            <p>
                                Get amazing products at
                                <br>
                                prices you'll love.
                            </p>

                            <div class="hero-buttons">

                                <a href="#" class="btn-shop">
                                    SHOP NOW
                                    <i class="bi bi-arrow-right"></i>
                                </a>

                                <a href="#" class="btn-explore">
                                    VIEW OFFERS
                                </a>

                            </div>

                        </div>


                        <div class="hero-image">

                            <img 
                                src="images/img3.jpg"
                                alt="Special Offer"
                            >

                        </div>

                    </div>

                </div>

            </div>

        </div>


        <!-- Previous -->

        <button
            class="carousel-control-prev"
            type="button"
            data-bs-target="#heroCarousel"
            data-bs-slide="prev">

            <span class="slider-arrow">
                <i class="bi bi-chevron-left"></i>
            </span>

        </button>


        <!-- Next -->

        <button
            class="carousel-control-next"
            type="button"
            data-bs-target="#heroCarousel"
            data-bs-slide="next">

            <span class="slider-arrow">
                <i class="bi bi-chevron-right"></i>
            </span>

        </button>

    </div>

</section>


    <!-- Bootstrap JS -->
    <script 
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js">
    </script>

    <!-- JavaScript -->
    <script src="assets/js/script.js"></script>

</body>
</html>













</body>
</html>