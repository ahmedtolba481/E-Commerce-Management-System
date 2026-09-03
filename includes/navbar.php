<nav class="navbar">
    <div class="container">
        <a href="/E-Commerce-Management-System/pages/home.php" class="navbar-brand">
            <i class="bi bi-bag-check-fill"></i> ShopEase
        </a>
        
        <ul class="nav-links" id="navLinks">
            <li><a href="/E-Commerce-Management-System/pages/home.php">Home</a></li>
            <li><a href="/E-Commerce-Management-System/pages/products/index.php">Products</a></li>
            <li><a href="/E-Commerce-Management-System/pages/home.php#about">About</a></li>
            <li><a href="/E-Commerce-Management-System/pages/home.php#contact">Contact</a></li>
        </ul>

        <div class="nav-icons">
            <a href="/E-Commerce-Management-System/pages/cart/index.php" class="nav-icon">
                <i class="bi bi-cart3"></i>
                <?php if ($cartCount > 0): ?>
                    <span class="cart-badge"><?= $cartCount ?></span>
                <?php endif; ?>
            </a>
            
            <?php if (isset($_SESSION['user_id'])): ?>
                <a href="/E-Commerce-Management-System/pages/profile/index.php" class="user-menu">
                    <i class="bi bi-person-circle"></i> 
                    <?= htmlspecialchars($_SESSION['user_name'] ?? 'Profile') ?>
                </a>
            <?php else: ?>
                <a href="/E-Commerce-Management-System/pages/auth/login.php" class="btn btn-primary" style="padding: 0.4rem 1rem; font-size: 0.9rem;">Login</a>
            <?php endif; ?>

            <button class="mobile-menu-btn" onclick="document.getElementById('navLinks').classList.toggle('active')">
                <i class="bi bi-list"></i>
            </button>
        </div>
    </div>
</nav>
