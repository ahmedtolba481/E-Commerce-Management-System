<?php
$currentUrl = $_SERVER["REQUEST_URI"];
?>
<?php
$currentUrl = $_SERVER["REQUEST_URI"];
?>

<aside class="admin-sidebar">

    <div class="sidebar-section-title">
        OVERVIEW
    </div>

    <a
        href="/E-Commerce-Management-System/admin/index.php"
        class="sidebar-link <?= strpos($currentUrl, '/admin/index.php') !== false ? 'active' : '' ?>"
        data-page="dashboard"
    >
        <div class="sidebar-icon">
            <i class="bi bi-grid-1x2-fill"></i>
        </div>

        <span>Dashboard</span>
    </a>


    <div class="sidebar-section-title">
        STORE MANAGEMENT
    </div>

    <a
        href="/E-Commerce-Management-System/admin/pages/categories/index.php"
        class="sidebar-link <?= strpos($currentUrl, '/categories/') !== false ? 'active' : '' ?>"
        data-page="categories"
    >
        <div class="sidebar-icon">
            <i class="bi bi-grid-fill"></i>
        </div>

        <span>Categories</span>
    </a>


    <a
        href="/E-Commerce-Management-System/admin/pages/brands/index.php"
        class="sidebar-link <?= strpos($currentUrl, '/brands/') !== false ? 'active' : '' ?>"
        data-page="brands"
    >
        <div class="sidebar-icon">
            <i class="bi bi-patch-check-fill"></i>
        </div>

        <span>Brands</span>
    </a>


    <a
        href="/E-Commerce-Management-System/admin/pages/products/index.php"
        class="sidebar-link <?= strpos($currentUrl, '/products/') !== false ? 'active' : '' ?>"
        data-page="products"
    >
        <div class="sidebar-icon">
            <i class="bi bi-box-seam-fill"></i>
        </div>

        <span>Products</span>
    </a>


    <div class="sidebar-section-title">
        SALES
    </div>


    <a
        href="/E-Commerce-Management-System/admin/pages/orders/index.php"
        class="sidebar-link <?= strpos($currentUrl, '/orders/') !== false ? 'active' : '' ?>"
        data-page="orders"
    >
        <div class="sidebar-icon">
            <i class="bi bi-cart-check-fill"></i>
        </div>

        <span>Orders</span>
    </a>


    <a
        href="/E-Commerce-Management-System/admin/pages/clients/index.php"
        class="sidebar-link <?= strpos($currentUrl, '/clients/') !== false ? 'active' : '' ?>"
        data-page="clients"
    >
        <div class="sidebar-icon">
            <i class="bi bi-people-fill"></i>
        </div>

        <span>Clients</span>
    </a>


    <div class="sidebar-section-title">
        WEBSITE
    </div>


    <a
        href="/E-Commerce-Management-System/admin/pages/team/index.php"
        class="sidebar-link <?= strpos($currentUrl, '/team/') !== false ? 'active' : '' ?>"
        data-page="team"
    >
        <div class="sidebar-icon">
            <i class="bi bi-person-badge-fill"></i>
        </div>

        <span>Team</span>
    </a>


    <a
        href="/E-Commerce-Management-System/admin/pages/partners/index.php"
        class="sidebar-link <?= strpos($currentUrl, '/partners/') !== false ? 'active' : '' ?>"
        data-page="partners"
    >
        <div class="sidebar-icon">
            <i class="bi bi-buildings-fill"></i>
        </div>

        <span>Partners</span>
    </a>


    <div class="sidebar-section-title">
        SYSTEM
    </div>


    <a
        href="/E-Commerce-Management-System/admin/pages/users/index.php"
        class="sidebar-link <?= strpos($currentUrl, '/users/') !== false ? 'active' : '' ?>"
        data-page="users"
    >
        <div class="sidebar-icon">
            <i class="bi bi-person-gear"></i>
        </div>

        <span>Users</span>
    </a>

</aside>