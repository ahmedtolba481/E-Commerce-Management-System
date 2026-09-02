<?php
include '../../includes/auth.php';
require_admin_role();
include '../../../config/database.php';
$id = $_GET['id'];

$sql = "DELETE FROM categories
        WHERE id = $id";


if (mysqli_query($conn, $sql)) {

    header("Location: index.php");
    exit();

} else {

    echo "Error: " . mysqli_error($conn);

}

?>