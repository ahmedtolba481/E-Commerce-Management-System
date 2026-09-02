<?php

if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

function require_admin(): void
{
    if (!isset($_SESSION['admin_id'])) {
        header("Location: /E-Commerce-Management-System/admin/login.php");
        exit;
    }

    if (!in_array($_SESSION['admin_role'] ?? '', ['Admin', 'Staff'], true)) {
        $_SESSION = [];
        session_destroy();
        header("Location: /E-Commerce-Management-System/admin/login.php");
        exit;
    }
}

function require_admin_role(): void
{
    require_admin();

    if ($_SESSION['admin_role'] !== 'Admin') {
        http_response_code(403);
        exit('You are not authorized to access this page.');
    }
}

require_admin();

?>