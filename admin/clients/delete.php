<?php

include "../../config/database.php";

if (!isset($_GET["id"])) {
    header("Location: index.php");
    exit;
}

$id = (int) $_GET["id"];

$delete = mysqli_prepare(
    $conn,
    "DELETE FROM clients WHERE id = ?"
);

mysqli_stmt_bind_param(
    $delete,
    "i",
    $id
);

mysqli_stmt_execute($delete);

header("Location: index.php");
exit;

?>