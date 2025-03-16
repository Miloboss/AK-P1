<?php
session_start();
include("../vendor/autoload.php");

use Libs\Database\MySQL;
use Libs\Database\UsersTable;
use Helpers\HTTP;

$db = new MySQL();
$usersTable = new UsersTable($db);

$productId = $_POST['product_id'];
$productColor = $_POST['product_color'];
$quantity = $_POST['quantity'];
$userId = $_SESSION['user_id'];

// Update cart item in the database
$usersTable->updateCartItem($userId, $productId, $productColor, $quantity);

echo "Cart item updated";
