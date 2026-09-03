<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include "../../config/database.php";

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';
    
    // Using simple mysqli queries as requested
    $email = mysqli_real_escape_string($conn, $email);
    
    $query = "SELECT id, name, email, password, role FROM users WHERE email = '$email' LIMIT 1";
    $result = mysqli_query($conn, $query);
    
    if ($result && mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);
        
        $allowed_roles = ['Admin', 'Staff', 'Client'];

        if (in_array($user['role'], $allowed_roles, true) && password_verify($password, $user['password'])) {
            $user_id = (int)$user['id'];

            session_regenerate_id(true);
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_name'] = $user['name'];
            $_SESSION['user_email'] = $user['email'];
            $_SESSION['user_role'] = $user['role'];
            unset($_SESSION['client_id']);

            $client_query = "SELECT id FROM clients WHERE user_id = $user_id LIMIT 1";
            $client_result = mysqli_query($conn, $client_query);

            if ($client_result && mysqli_num_rows($client_result) > 0) {
                $client = mysqli_fetch_assoc($client_result);
                $_SESSION['client_id'] = $client['id'];
            } elseif ($user['role'] === 'Client') {
                    session_unset();
                    $_SESSION['auth_error'] = 'Customer profile not found.';
            }

            if (isset($_SESSION['user_id'])) {
                header("Location: ../../pages/home.php");
                exit;
            }
        } else {
            $_SESSION['auth_error'] = 'Invalid email or password.';
        }
    } else {
        $_SESSION['auth_error'] = 'Invalid email or password.';
    }
    
    header("Location: ../../pages/auth/login.php");
    exit;
}
?>
