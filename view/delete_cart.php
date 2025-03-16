<?php
session_start();
include("../vendor/autoload.php");

use Libs\Database\MySQL;
use Libs\Database\UsersTable;
use Helpers\HTTP;


$product_id = $_POST['product_id'];
$user_id = $_SESSION['user_id'];

$db = new MySQL();
$usersTable = new UsersTable($db);

if (isset($_SESSION['cart'][$product_id])) {
    unset($_SESSION['cart'][$product_id]);
}

header('Location: ../view/cart.php');
exit();
