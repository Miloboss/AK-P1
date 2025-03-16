<?php
// include("vendor/autoload.php");
// use Libs\Database\MySQL;
// use Libs\Database\AdminsTable;
// use Helpers\Auth;
// $table = new AdminsTable(new MySQL());
// $all = $table->getAll();
// $auth = Auth::check();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login System</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>
    <div class="login-container">
        <h2>Welcome to Login System</h2>
        <form action="../_actions/admin_login.php" id="loginForm" method="POST">
            <div class="input-group">
                <label for="username">Username</label>
                <input type="text" name="username" required>
            </div>
            <div class="input-group">
                <label for="password">Password</label>
                <input type="password" name="password" required>
            </div>
            <button type="submit">Login</button>
        </form>
        <div id="message"></div>
    </div>
    <!-- <script src="assets/js/script.js"></script> -->
</body>

</html>