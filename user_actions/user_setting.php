<?php

session_start();
include("../vendor/autoload.php");

use Libs\Database\MySQL;
use Libs\Database\UsersTable;
use Helpers\HTTP;


$userTable = new UsersTable(new MySQL());

$id = $_SESSION['user_id']; // session မှာရှိတဲ့ user_id ကိုယူပါ
$userId = $_SESSION['user_id'];
$user = $userTable->getUserById($id);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $field = $_POST['field_name'];
    $value = $_POST['field_value'];
    $password = $_POST['password'];

    $data = [$field => $value];
    if ($field === 'password') {
        $data['password'] = password_hash($value, PASSWORD_DEFAULT);
    }

    if ($field === 'email') {
        if (password_verify($password, $user['password'])) {
            $userTable->updateUser($userId, $data);
            header('Location: ../view/setting.php?success=1');
        } else {
            header('Location: ../view/setting.php?error=1');
        }
    } else {
        $userTable->updateUser($userId, $data);
        header('Location: ../view/setting.php?success=1');
    }

    // $userTable->updateUser($userId, $data);
    // header('Location: ../view/setting.php?success=1');
    exit;
}
