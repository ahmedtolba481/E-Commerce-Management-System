<?php

include '../../../config/database.php';

$id = $_GET['id'];



$sql = "SELECT image FROM products WHERE id = $id";

$result = mysqli_query($conn, $sql);

$product = mysqli_fetch_array($result);


if (!$product) {

    die("Product not found.");

}



$sql = "DELETE FROM products WHERE id = $id";

if (mysqli_query($conn, $sql)) {

    
    if (!empty($product['image'])) {

        $imagePath = '../../assets/images/products/' . $product['image'];

        if (file_exists($imagePath)) {
            unlink($imagePath);
        }

    }

    header("Location: index.php");
    exit;

} else {

    echo "Error: " . mysqli_error($conn);

}

?>