<?php
session_start();
include("../vendor/autoload.php");

use Libs\Database\MySQL;
use Libs\Database\UsersTable;
use Helpers\HTTP;


$cartTable = new UsersTable(new MySQL());

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $cart_id = $_GET['cart_id'];
    if ($cartTable->removeCartItem($cart_id)) {
        header('location: ../view/cart.php?status=success');
    } else {
        header('location: ../view/cart.php?status=fail');
    }
}
