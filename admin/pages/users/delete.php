<?php
include '../../includes/auth.php';
require_admin_role();
include '../../../config/database.php';

$id = $_GET['id'];

try {

    $sql = "DELETE FROM users WHERE id = $id";

    mysqli_query($conn, $sql);

    header("Location: index.php");
    exit;

} catch (mysqli_sql_exception $e) {

    header("Location: index.php?error=orders");
    exit;

}

?>