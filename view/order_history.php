<?php
session_start();
include("../vendor/autoload.php");

use Libs\Database\MySQL;
use Libs\Database\UsersTable;

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

$db = new MySQL();
$usersTable = new UsersTable($db);

$user_id = $_SESSION['user_id'];
$orderHistory = $usersTable->getOrderHistory($user_id);

// Group orders by order_id
$groupedOrders = [];
foreach ($orderHistory as $order) {
    if (!isset($groupedOrders[$order['order_id']])) {
        $groupedOrders[$order['order_id']] = [
            'order_id' => $order['order_id'],
            'created_at' => $order['created_at'],
            'total_price' => 0,
            'products' => []
        ];
    }
    $groupedOrders[$order['order_id']]['total_price'] += $order['price'] * $order['quantity'];
    $groupedOrders[$order['order_id']]['products'][] = $order;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order History</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/order_history.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
        .no-orders {
            text-align: center;
            margin-top: 50px;
        }

        .no-orders .fas {
            font-size: 100px;
            color: #ccc;
        }

        .no-orders p {
            font-size: 1.2em;
            margin-top: 20px;
        }

        .header-title {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .header-icon {
            font-size: 40px;
            color: #007bff;
            cursor: pointer;
        }

        .header-icon:hover {
            color: #0056b3;
        }

        @media (max-width: 768px) {
            .header-icon {
                font-size: 40px;
            }
        }
    </style>
</head>

<body>
    <div class="container mt-5">
        <div class="header-title">
            <h1>Order History</h1>
            <a href="profile.php" class="header-icon">
                <i class="fas fa-arrow-right"></i>
            </a>
        </div>
        <?php if (!empty($groupedOrders)) : ?>
            <?php foreach ($groupedOrders as $order) : ?>
                <div class="order mb-3 p-3 border rounded">
                    <div class="row">
                        <div class="col-12 col-md-6">
                            <h4>Order ID: <?php echo htmlspecialchars($order['order_id']); ?></h4>
                            <p><strong>Placed on:</strong> <?php echo htmlspecialchars($order['created_at']); ?></p>
                        </div>
                        <div class="col-12 col-md-6 text-md-right">
                            <p><strong>Total:</strong> Ks <?php echo number_format($order['total_price'], 2); ?></p>
                            <p><span class="badge badge-success">Delivered</span></p>
                        </div>
                    </div>
                    <?php foreach ($order['products'] as $product) : ?>
                        <div class="row mt-2">
                            <div class="col-3">
                                <img src="../image/<?php echo htmlspecialchars($product['main_image']); ?>" alt="<?php echo htmlspecialchars($product['product_name']); ?>" class="img-fluid">
                            </div>
                            <div class="col-9">
                                <p><strong><?php echo htmlspecialchars($product['product_name']); ?></strong></p>
                                <p>Color: <?php echo htmlspecialchars($product['product_color']); ?></p>
                                <p>Quantity: <?php echo htmlspecialchars($product['quantity']); ?></p>
                                <p>Price: Ks <?php echo number_format($product['price'], 2); ?></p>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endforeach; ?>
        <?php else : ?>
            <div class="no-orders">
                <i class="fas fa-box-open"></i>
                <p>No orders found</p>
            </div>
        <?php endif; ?>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>