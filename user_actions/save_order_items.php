<?php
session_start();

$orderItems = json_decode(file_get_contents('php://input'), true);

if (isset($orderItems['orderItems'])) {
    $_SESSION['orderItems'] = $orderItems['orderItems'];
    echo json_encode(['status' => 'success']);
} else {
    echo json_encode(['status' => 'error', 'message' => 'No order items found']);
}
