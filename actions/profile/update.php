<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include "../../config/database.php";

if (!isset($_SESSION['user_id'])) {
    header("Location: ../../pages/auth/login.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = (int)$_SESSION['user_id'];
    $name = trim($_POST['name'] ?? '');
    $phone = trim($_POST['phone'] ?? '');
    $address = trim($_POST['address'] ?? '');
    $city = trim($_POST['city'] ?? '');
    
    if (!$name || !$phone || !$address || !$city) {
        $_SESSION['profile_error'] = 'All fields are required.';
        header("Location: ../../pages/profile/index.php");
        exit;
    }
    
    $name = mysqli_real_escape_string($conn, $name);
    $phone = mysqli_real_escape_string($conn, $phone);
    $address = mysqli_real_escape_string($conn, $address);
    $city = mysqli_real_escape_string($conn, $city);
    
    $user_query = "UPDATE users SET name = '$name' WHERE id = $user_id";
    $client_query = "UPDATE clients SET phone = '$phone', address = '$address', city = '$city' WHERE user_id = $user_id";
    
    if (mysqli_query($conn, $user_query) && mysqli_query($conn, $client_query)) {
        $_SESSION['user_name'] = $name;
        $_SESSION['profile_msg'] = 'Profile updated successfully.';
    } else {
        $_SESSION['profile_error'] = 'Failed to update profile.';
    }
    
    header("Location: ../../pages/profile/index.php");
    exit;
}
?>
