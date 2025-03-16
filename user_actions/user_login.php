<?php

session_start();
include("../vendor/autoload.php");

use Libs\Database\MySQL;
use Libs\Database\UsersTable;
use Helpers\HTTP;

// if ($_SERVER["REQUEST_METHOD"] == "POST") {
//     $email = $_POST['email'];
//     $password = $_POST['password'];
//     $remember = isset($_POST['remember']);
//     $agree = isset($_POST['agree']);
//     print_r($remember);
//     if (!$agree) {
//         echo "You must agree to the terms and conditions.";
//         exit;
//     }

//     // Check user credentials
//     $usersTable = new UsersTable(new MySQL()); // Pass the database connection
//     $user = $usersTable->getUserByEmail($email);

//     if ($user && password_verify($password, $user['password'])) {
//         // Login successful
//         $_SESSION['user_id'] = $user['user_id'];
//         if ($remember) {
//             // Set cookies to remember the user
//             setcookie('user_id', $user['user_id'], time() + (86400 * 30), "/"); // 86400 = 1 day
//             setcookie('user_token', md5($user['user_id'] . $user['email']), time() + (86400 * 30), "/");
//         }
//         echo "Login successful. Welcome, " . $user['email'];
//         header('location: ../test.php');
//         // header('location: ../index.php?id=' . $user['user_id']);
//     } else {
//         echo "Invalid email or password.";
//     }
// } elseif (isset($_COOKIE['user_id']) && isset($_COOKIE['user_token'])) {
//     // Check if user is remembered
//     $userId = $_COOKIE['user_id'];
//     $userToken = $_COOKIE['user_token'];

//     $usersTable = new UsersTable(new MySQL()); // Pass the database connection
//     $user = $usersTable->getUserById($userId);

//     if ($user && md5($user['user_id'] . $user['email']) === $userToken) {
//         // Auto login successful
//         $_SESSION['user_id'] = $user['user_id'];
//         echo "Auto login successful. Welcome back, " . $user['email'];
//     }
// }


// if ($_SERVER["REQUEST_METHOD"] == "POST") {
//     $email = $_POST['email'];
//     $password = $_POST['password'];
//     $remember = isset($_POST['remember']);
//     $agree = isset($_POST['agree']);

//     if (!$agree) {
//         echo "You must agree to the terms and conditions.";
//         exit;
//     }

//     // Check user credentials
//     $usersTable = new UsersTable(new MySQL()); // Pass the database connection
//     $user = $usersTable->getUserByEmail($email);

//     if ($user && password_verify($password, $user['password'])) {
//         // Login successful
//         $_SESSION['user_id'] = $user['user_id'];
//         if ($remember) {
//             // Set cookies to remember the user for 1 hour (3600 seconds)
//             setcookie('user_id', $user['user_id'], time() + 3600, "/");
//             setcookie('user_token', md5($user['user_id'] . $user['email']), time() + 3600, "/");
//         }
//         echo "Login successful. Welcome, " . $user['email'];
//     } else {
//         echo "Invalid email or password.";
//     }
// }



if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $remember = isset($_POST['remember']);

    // Check user credentials
    $usersTable = new UsersTable(new MySQL()); // Pass the database connection
    $user = $usersTable->getUserByEmail($email);

    if ($user && password_verify($password, $user['password'])) {
        // Login successful
        $_SESSION['user_id'] = $user['user_id'];
        if ($remember) {
            // Set cookies to remember the user for 1 hour (3600 seconds)
            setcookie('user_id', $user['user_id'], time() + (86400 * 30), "/");
            setcookie('user_token', md5($user['user_id'] . $user['email']), time() + (86400 * 30), "/");
        }
        header('Location: ../index.php'); // Redirect to protected page
        print_r($remember);
        exit;
    } else {
        echo "Invalid email or password.";
    }
} elseif (isset($_COOKIE['user_id']) && isset($_COOKIE['user_token'])) {
    // Check if user is remembered
    $userId = $_COOKIE['user_id'];
    $userToken = $_COOKIE['user_token'];

    $usersTable = new UsersTable(new MySQL()); // Pass the database connection
    $user = $usersTable->getUserById($userId);

    if ($user && md5($user['user_id'] . $user['email']) === $userToken) {
        // Auto login successful
        $_SESSION['user_id'] = $user['user_id'];
        header('Location: ../index.php');
        // Redirect to protected page
        exit;
    }
}
