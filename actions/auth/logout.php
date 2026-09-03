<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
// Unset all of the session variables
$_SESSION = array();

// Destroy the session.
session_destroy();

header("Location: ../../pages/home.php");
exit;
?>
