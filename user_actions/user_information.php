<?php

session_start();
include("../vendor/autoload.php");

use Libs\Database\MySQL;
use Libs\Database\UsersTable;
use Helpers\HTTP;


if (!isset($_SESSION['user_id'])) {
    header('Location: ../login.php');
    exit();
}

$usersTable = new UsersTable(new MySQL());

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userId = $_SESSION['user_id'];
    $name = trim($_POST['name']);
    $phone = trim($_POST['phone']);
    $address = trim($_POST['address']);

    if ($usersTable->updateUserInfo($userId, $name, $phone, $address)) {
        header("location: ../index.php");
    } else {
        header("location: ../view/login.php");
        // $error = "Error: Update failed.";
    }
}
