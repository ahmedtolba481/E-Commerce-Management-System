<?php
// ابدأ الـ Session عشان تقدر توصل لها
session_start();

// احذف كل متغيرات الـ Session
$_SESSION = array();

// تدمير الـ Session تماماً من السيرفر
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

session_destroy();

// تحويل المستخدم لصفحة تسجيل الدخول أو الرئيسية بعد الخروج
header("Location: login.php");
exit();
?>