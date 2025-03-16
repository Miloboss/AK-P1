<?php
session_start();
include("../vendor/autoload.php");

use Libs\Database\MySQL;
use Libs\Database\UsersTable;

$db = new MySQL();
$usersTable = new UsersTable($db);

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['orderItems'])) {
    $_SESSION['orderItems'] = array_map('json_decode', $_POST['orderItems']);
}

$orderItems = isset($_SESSION['orderItems']) ? $_SESSION['orderItems'] : [];

$user = $usersTable->getUserById($_SESSION['user_id']);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Confirmation</title>
    <link href="../node_modules/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="../assets/css/order.css">
</head>

<body>
    <div class="container">
        <div class="order-container">
            <div class="order-header">
                <h1>Order Confirmation</h1>
                <div class="address-container">
                    <p><strong>Name:</strong> <?php echo htmlspecialchars($user['user_name']); ?></p>
                    <p><strong>Address:</strong> <?php echo htmlspecialchars($user['address']); ?>
                        <a href="edit_address.php" class="ml-2"><i class="fas fa-edit"></i></a>
                    </p>
                    <p><strong>Phone:</strong> <?php echo htmlspecialchars($user['phone_number']); ?></p>
                </div>
            </div>

            <?php if (!empty($orderItems)) : ?>
                <div class="order-summary">
                    <h3>Order Summary</h3>
                    <div class="product-list">
                        <?php
                        $total = 0;
                        $stock = 0;
                        foreach ($orderItems as $item) :
                            $subtotal = $item->price * $item->quantity;
                            $total += $subtotal;
                        ?>
                            <div class="product-item">
                                <img src="../image/<?php echo htmlspecialchars($item->product_image); ?>" alt="<?php echo htmlspecialchars($item->product_name); ?>" class="product-image">
                                <div class="product-details">
                                    <p><strong><?php echo htmlspecialchars($item->product_name); ?></strong></p>

                                    <p>Color: <?php echo htmlspecialchars($item->product_color); ?></p>
                                    <p>Quantity: <?php echo htmlspecialchars($item->quantity); ?></p>
                                    <p>Price: Ks <?php echo number_format($item->price, 2); ?></p>
                                    <p>Subtotal: Ks <?php echo number_format($subtotal, 2); ?></p>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <div class="total">Total: Ks <?php echo number_format($total, 2); ?></div>
                </div>
                <form action="../user_actions/order_confirmation.php" method="post" class="mt-4 mb-5">
                    <button type="submit" name="confirm" class="btn btn-success btn-block">Confirm Order</button>
                </form>
            <?php else : ?>
                <p>Your order is empty.</p>
            <?php endif; ?>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
</body>

</html>