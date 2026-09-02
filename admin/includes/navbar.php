<nav class="admin-navbar">

    <a
        href="/E-Commerce-Management-System/admin/index.php"
        class="admin-logo"
    >

        <div class="logo-icon">
            <i class="bi bi-bag-heart-fill"></i>
        </div>

        <div>
            <span class="logo-main">SmartStore</span>
            <!-- <span class="logo-small">ADMIN PANEL</span> -->
        </div>

    </a>


    <div class="navbar-right">

        <a
            href="/E-Commerce-Management-System/index.php"
            class="website-link"
        >
            <i class="bi bi-globe2"></i>
            <span>View Website</span>
        </a>


        <div class="admin-profile">

            <div class="admin-avatar">
                <?= strtoupper(substr($_SESSION['admin_name'] ?? 'A', 0, 1)) ?>
            </div>

            <div class="admin-info">
                <span class="admin-name">
                    <?= htmlspecialchars($_SESSION['admin_name'] ?? 'Admin') ?>
                </span>
                <span class="admin-role">
                    <?= htmlspecialchars($_SESSION['admin_role'] ?? 'Admin') ?>
                </span>
            </div>

        </div>


        <a href="/E-Commerce-Management-System/admin/logout.php">
            <i class="bi bi-box-arrow-right"></i>
            Logout
        </a>

    </div>

</nav>
