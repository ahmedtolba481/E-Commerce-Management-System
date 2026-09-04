<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include "../../config/database.php";

if (!isset($_SESSION['client_id'])) {
    header("Location: ../../pages/auth/login.php");
    exit;
}
if (empty($_SESSION['cart'])) {
    header("Location: ../../pages/cart/index.php");
    exit;
}

$client_id = (int)$_SESSION['client_id'];


$cart = $_SESSION['cart'];
$subtotal = 0;
$items = [];

foreach ($cart as $item) {
    $product_id = $item['id'];
    $quantity = $item['quantity'];
    
    $query = "SELECT id, name, price, stock FROM products WHERE id = $product_id";
    $result = mysqli_query($conn, $query);
    
    if ($result && mysqli_num_rows($result) > 0) {
        $product = mysqli_fetch_assoc($result);
        
        // Final stock check
        if ($quantity > $product['stock']) {
            $_SESSION['checkout_error'] = "Insufficient stock for product: " . htmlspecialchars($product['name']) . ". Only " . $product['stock'] . " available.";
            header("Location: ../../pages/checkout/index.php");
            exit;
        }
        
        if ($quantity > 0) {
            $item_total = $product['price'] * $quantity;
            $subtotal += $item_total;
            
            $items[] = [
                'id' => $product['id'],
                'quantity' => $quantity,
                'price' => $product['price']
            ];
        }
    } else {
        $_SESSION['checkout_error'] = "One of the products in your cart is invalid.";
        header("Location: ../../pages/checkout/index.php");
        exit;
    }
}

if (empty($items)) {
    $_SESSION['checkout_error'] = 'Your items are out of stock.';
    header("Location: ../../pages/checkout/index.php");
    exit;
}

$delivery = ($subtotal > 0 && $subtotal < 300) ? 4.99 : 0;
$total = $subtotal + $delivery;

// Simple transaction logic
$order_query = "INSERT INTO orders (client_id, total_price, status) VALUES ($client_id, $total, 'pending')";
if (mysqli_query($conn, $order_query)) {
    $order_id = mysqli_insert_id($conn);
    
    $success = true;
    
    foreach ($items as $item) {
        $pid = $item['id'];
        $qty = $item['quantity'];
        $price = $item['price'];
        
        // Insert order item
        $item_query = "INSERT INTO order_items (order_id, product_id, quantity, price) VALUES ($order_id, $pid, $qty, $price)";
        if (!mysqli_query($conn, $item_query)) {
            $success = false;
        }
        
        // Update stock
        $stock_query = "UPDATE products SET stock = stock - $qty WHERE id = $pid AND stock >= $qty";
        if (!mysqli_query($conn, $stock_query)) {
            $success = false;
        }
    }
    
    if ($success) {
        $_SESSION['cart'] = [];
        header("Location: ../../pages/orders/index.php");
        exit;
    } else {
        $_SESSION['checkout_error'] = 'Failed to place some items. Please check your orders.';
        header("Location: ../../pages/orders/index.php");
        exit;
    }
} else {
    $_SESSION['checkout_error'] = 'Failed to create order.';
    header("Location: ../../pages/checkout/index.php");
    exit;
}
?>
