<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);
include("../vendor/autoload.php");

use Libs\Database\MySQL;
use Libs\Database\UsersTable;
use Helpers\HTTP;

$orderItems = json_decode(file_get_contents('php://input'), true)['orderItems'] ?? [];

if ($orderItems) {
    try {
        $pdo->beginTransaction();

        // Assuming you have a user_id stored in session
        $userId = $_SESSION['user_id'];

        $stmt = $pdo->prepare("INSERT INTO orders (user_id, total_price, created_at) VALUES (?, ?, NOW())");
        $totalPrice = calculateTotalPrice($orderItems, $pdo);
        $stmt->execute([$userId, $totalPrice]);
        $orderId = $pdo->lastInsertId();

        $stmt = $pdo->prepare("INSERT INTO order_items (order_id, product_id, quantity) VALUES (?, ?, ?)");

        foreach ($orderItems as $item) {
            $stmt->execute([$orderId, $item['cart_id'], $item['quantity']]);
        }

        $pdo->commit();

        unset($_SESSION['cart']);
        echo json_encode(['status' => 'success', 'order_id' => $orderId]);
    } catch (Exception $e) {
        $pdo->rollBack();
        echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
    }
}

function calculateTotalPrice($orderItems, $pdo)
{
    $total = 0;

    $stmt = $pdo->prepare("SELECT price FROM products WHERE id = ?");

    foreach ($orderItems as $item) {
        $stmt->execute([$item['cart_id']]);
        $product = $stmt->fetch();
        $total += $product['price'] * $item['quantity'];
    }
    return $total;
}
