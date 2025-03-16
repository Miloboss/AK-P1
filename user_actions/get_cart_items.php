<?php
session_start();
include("../vendor/autoload.php");

use Libs\Database\MySQL;
use Libs\Database\UsersTable;
use Helpers\HTTP;


$db = new MySQL();
$usersTable = new UsersTable($db);

$user_id = $_SESSION['user_id'];
$cartItems = $usersTable->getCartItems($user_id);

echo json_encode($cartItems);
