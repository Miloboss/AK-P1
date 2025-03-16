<?php
session_start();
include("../vendor/autoload.php");

use Libs\Database\MySQL;
use Libs\Database\UsersTable;
use Helpers\HTTP;

$usersTable = new UsersTable(new MySQL());
$productsTable = new UsersTable(new MySQL());

$userId = $_SESSION['user_id'];
$productId = $_POST['product_id'];
$productColor = $_POST['color'];
$quantity = $_POST['quantity'];
$price = $_GET['price'];


// Save cart item to the database
$usersTable->saveCartItem($userId, $productId, $quantity, $productColor, $price);

header('Location: ../view/cart.php');
exit();
