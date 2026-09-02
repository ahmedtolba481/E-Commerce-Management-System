<?php
include('../../includes/database.php');
$id = $_GET['id'];

$sql = "DELETE FROM users
        WHERE id = $id";


if (mysqli_query($connection, $sql)) {

    header("Location: index.php");
    exit();

} else {

    echo "Error: " . mysqli_error($connection);

}

?>