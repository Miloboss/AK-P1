<?php
session_start();
include("../vendor/autoload.php");

use Libs\Database\MySQL;
use Libs\Database\UsersTable;

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

$db = new MySQL();
$usersTable = new UsersTable($db);

$userId = $_SESSION['user_id'];
$orderItems = isset($_SESSION['orderItems']) ? $_SESSION['orderItems'] : [];

function generateRandomString($length = 10)
{
    $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['confirm']) && !empty($orderItems)) {
    // Generate unique order ID
    do {
        $randomString = generateRandomString(10); // Generate a 10-character long random string
        $orderId = date('Ymd') . $userId . implode('', array_column($orderItems, 'product_id')) . $randomString;
        $orderExists = $usersTable->checkOrderExists($orderId);
    } while ($orderExists);

    // Get user information
    $user = $usersTable->getUserById($userId);
    $userAddress = $user['address'];
    $userPhoneNumber = $user['phone_number'];

    // Calculate total price
    $totalPrice = 0;
    foreach ($orderItems as $item) {
        $totalPrice += $item->price * $item->quantity;
    }

    // Save order to the database
    foreach ($orderItems as $item) {
        $productId = $item->product_id;
        $productColor = $item->product_color;
        $quantity = $item->quantity;
        $price = $item->price;

        // Save order to the orders table
        $usersTable->saveOrder($orderId, $userId, $productId, $productColor, $quantity, $price, $userAddress, $userPhoneNumber);

        // Update product stock in the products table
        $usersTable->updateProductStock($productId, $quantity);
    }

    // Save total price to the orders table
    $stmt = $db->connect()->prepare("UPDATE orders SET total_price = :total_price WHERE order_id = :order_id");
    $stmt->execute(['total_price' => $totalPrice, 'order_id' => $orderId]);

    $usersTable->clearCart($userId);

    // Clear the order items from session
    unset($_SESSION['orderItems']);

    // Clear the order items from session
    unset($_SESSION['orderItems']);

    header('Location: ../view/confirm.php');
    exit();
}

header('Location: ../view/order.php');
exit();
