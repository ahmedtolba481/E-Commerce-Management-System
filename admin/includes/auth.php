<?php

session_start();


// Check if user is logged in
if (!isset($_SESSION['admin_id'])) {

    header("Location: /E-Commerce-Management-System/admin/login.php");
    exit;

}


// Check if user has an allowed admin role
if (!isset($_SESSION['admin_role']) ||
    ($_SESSION['admin_role'] !== 'admin' &&
     $_SESSION['admin_role'] !== 'staff')) {

    session_unset();
    session_destroy();

    header("Location: /E-Commerce-Management-System/admin/login.php");
    exit;

}

?>