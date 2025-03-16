<?php

session_start();
include("../vendor/autoload.php");

use Libs\Database\MySQL;
use Libs\Database\AdminsTable;
use Helpers\HTTP;


$username = $_POST['username'];
$password = $_POST['password'];
$table = new AdminsTable(new MySQL());
$admin = $table->findByEmailAndPasword($username, $password);

if ($admin) {
    if ($admin->suspended) {
        HTTP::redirect("admin/index.php", "suspended=1");
    }
    $_SESSION['admin'] = $admin;
    HTTP::redirect("admin/dashboard.php");
} else {
    HTTP::redirect("admin/index.php", "incorrect=1");
}
