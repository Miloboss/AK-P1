<?php
include("../vendor/autoload.php");

use Helpers\Auth;
use Helpers\HTTP;
use Libs\Database\MySQL;
use Libs\Database\AdminsTable;

$auth = Auth::check();
?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="assets/css/dashboard.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <?php
    include('navbar.php');
    ?>
    <div class="main-content" id="main-content">
        <header>
            <button id="menu-toggle">☰</button>
            <h1>Welcome to Admin Dashboard</h1>
        </header>
        <section class="cards">
            <div class="card">
                <h3>Products</h3>
                <p>Manage your products here</p>
            </div>
            <div class="card">
                <h3>Orders</h3>
                <p>View and manage orders</p>
            </div>
            <div class="card">
                <h3>Customers</h3>
                <p>View customer information</p>
            </div>
            <div class="card">
                <h3>Reports</h3>
                <p>Generate reports</p>
            </div>
        </section>

        <form action="../_actions/admin_logout.php">
            <button class=" btn btn-danger">Logout</button>
        </form>
    </div>
    <script src="assets/js/dashboard.js"></script>
</body>

</html>