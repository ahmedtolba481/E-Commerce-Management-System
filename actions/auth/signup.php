<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include "../../config/database.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $phone = trim($_POST['phone'] ?? '');
    $address = trim($_POST['address'] ?? '');
    $city = trim($_POST['city'] ?? '');
    $password = $_POST['password'] ?? '';
    
    if (!$name || !filter_var($email, FILTER_VALIDATE_EMAIL) || !$phone || !$address || !$city || strlen($password) < 6) {
        $_SESSION['auth_error'] = 'Please complete all fields correctly. Password must be at least 6 characters.';
        header("Location: ../../pages/auth/signup.php");
        exit;
    }
    
    // Check if email already registered
    $email = mysqli_real_escape_string($conn, $email);
    $check_query = "SELECT id FROM users WHERE email = '$email'";
    $check_result = mysqli_query($conn, $check_query);
    
    if ($check_result && mysqli_num_rows($check_result) > 0) {
        $_SESSION['auth_error'] = 'Email already registered.';
        header("Location: ../../pages/auth/signup.php");
        exit;
    }
    
    // Hash password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    
    // Transaction-like functionality (simple mysqli queries as requested)
    // We will do it without PDO or complicated try-catch if possible, but we need to ensure both inserts work.
    
    $name = mysqli_real_escape_string($conn, $name);
    $hashed_password = mysqli_real_escape_string($conn, $hashed_password);
    
    $user_insert = "INSERT INTO users (name, email, password, role) VALUES ('$name', '$email', '$hashed_password', 'user')";
    
    if (mysqli_query($conn, $user_insert)) {
        $user_id = mysqli_insert_id($conn);
        
        $phone = mysqli_real_escape_string($conn, $phone);
        $address = mysqli_real_escape_string($conn, $address);
        $city = mysqli_real_escape_string($conn, $city);
        
        $client_insert = "INSERT INTO clients (user_id, phone, address, city) VALUES ($user_id, '$phone', '$address', '$city')";
        
        if (mysqli_query($conn, $client_insert)) {
            $client_id = mysqli_insert_id($conn);
            
            session_regenerate_id(true);
            $_SESSION['user_id'] = $user_id;
            $_SESSION['user_name'] = $name;
            $_SESSION['user_email'] = $email;
            $_SESSION['client_id'] = $client_id;
            
            header("Location: ../../pages/home.php");
            exit;
        } else {
            // Rollback manually
            mysqli_query($conn, "DELETE FROM users WHERE id = $user_id");
            $_SESSION['auth_error'] = 'Registration failed due to client details error.';
        }
    } else {
        $_SESSION['auth_error'] = 'Registration failed.';
    }
    
    header("Location: ../../pages/auth/signup.php");
    exit;
}
?>
