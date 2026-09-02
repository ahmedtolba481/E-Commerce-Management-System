<?php

include "../../config/database.php";

if (!isset($_GET["id"])) {
    header("Location: index.php");
    exit;
}

$id = (int) $_GET["id"];


// Get member image first
$query = mysqli_prepare(
    $conn,
    "SELECT image FROM team WHERE id = ?"
);

mysqli_stmt_bind_param(
    $query,
    "i",
    $id
);

mysqli_stmt_execute($query);

$result = mysqli_stmt_get_result($query);

$member = mysqli_fetch_assoc($result);


// If member exists
if ($member) {

    // Delete image from folder
    if (!empty($member["image"])) {

        $imagePath =
            "../assets/images/team/" . $member["image"];

        if (file_exists($imagePath)) {
            unlink($imagePath);
        }
    }


    // Delete member from database
    $delete = mysqli_prepare(
        $conn,
        "DELETE FROM team WHERE id = ?"
    );

    mysqli_stmt_bind_param(
        $delete,
        "i",
        $id
    );

    mysqli_stmt_execute($delete);
}


header("Location: index.php");
exit;

?>