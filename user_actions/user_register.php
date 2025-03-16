<?php

session_start();
include("../vendor/autoload.php");

use Libs\Database\MySQL;
use Libs\Database\UsersTable;
use Helpers\HTTP;


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirmPassword'];
    $agree = isset($_POST['agree']) ? $_POST['agree'] : '';
    $userTable = new UsersTable(new MySQL());
    $ifEmail = $userTable->getUserByEmail($email);

    if ($email == $ifEmail['email']) {
        header('location: ../register.php?error=0');
    } elseif ($password !== $confirmPassword) {
        header('location: ../register.php?error=1');
    } elseif (empty($agree)) {
        header('location: ../register.php?error=2');
        $error = "You must agree to the terms and conditions.";
    } else {
        // Encrypt the password
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

        // Insert user into the database
        $usersTable = new UsersTable(new MySQL()); // Pass the database connection
        $userId = $usersTable->registerUser($email, $hashedPassword);

        if ($userId) {
            $_SESSION['user_id'] = $userId;
            $_SESSION['email'] = $email;
            setcookie('user_id', $userId, time() + 3600, "/"); // 30 days
            setcookie('user_token', md5($userId . $email), time() + 3600, "/");
            header('location: ../view/information.php');
        } else {
            header('location: ../view/register.php?error=3');
        }
    }
}
