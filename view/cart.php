<?php
session_start();
include("../vendor/autoload.php");

use Libs\Database\MySQL;
use Libs\Database\UsersTable;
use Helpers\User_Auth;

$db = new MySQL();
$usersTable = new UsersTable($db);

$user_id = $_SESSION['user_id'];
$cartItems = $usersTable->getCartItems($user_id);
$total = 0;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart</title>
    <link href="../node_modules/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/cart.css">
</head>

<body>
    <div class="container mt-5">
        <h1>Cart Item</h1>
        <div id="cart-items">
            <?php foreach ($cartItems as $item) : ?>
                <?php
                $subtotal = $item['price'] * $item['quantity'];
                $total += $subtotal;
                ?>
                <div class="cart-item mb-3" data-cart-id="<?php echo $item['product_id']; ?>" data-product-color="<?php echo $item['product_color']; ?>" data-price="<?php echo $item['price']; ?>">
                    <div class="row align-items-center">
                        <div class="col-3 col-md-2">
                            <img src="../image/<?php echo $item['product_image']; ?>" alt="<?php echo $item['product_name']; ?>" class="img-fluid">
                        </div>
                        <div class="col-9 col-md-4">
                            <h5 style="font-weight: bold; line-height: 1.6"><?php echo $item['product_name']; ?></h5>
                            <p class="text-muted"><?php echo $item['product_color']; ?></p>
                        </div>
                        <div class="col-6 col-md-2 text-right price">
                            <p class="font-weight-bold">Ks <?php echo number_format($item['price']); ?></p>
                        </div>
                        <div class="col-12 col-md-4 d-flex justify-content-between align-items-center detete">
                            <div class="quantity-control d-inline-block">
                                <button type="button" onclick="updateQuantity('<?php echo $item['product_id']; ?>', '<?php echo $item['product_color']; ?>', 'decrement')" class="btn btn-secondary">-</button>
                                <input type="number" value="<?php echo $item['quantity']; ?>" min="1" class="form-control d-inline-block text-center w-25" readonly>
                                <button type="button" onclick="updateQuantity('<?php echo $item['product_id']; ?>', '<?php echo $item['product_color']; ?>', 'increment')" class="btn btn-secondary">+</button>
                            </div>
                            <form class="del" action="../user_actions/remove_cart_item.php?cart_id=<?php echo $item['cart_id']; ?>" method="post">
                                <button type="submit" class="btn btn-danger">&times;</button>
                            </form>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        <div class="cart-summary mt-4">
            <h2 style="font-weight: bold">Total: Ks <span id="cart-total"><?php echo number_format($total); ?></span></h2>
        </div>
        <form id="checkout-form" action="order.php" method="post">
            <?php foreach ($cartItems as $item) : ?>
                <input type="hidden" name="orderItems[]" value="<?php echo htmlspecialchars(json_encode($item)); ?>">
            <?php endforeach; ?>
            <button id="checkout-btn" style="font-weight: bold" type="submit" class="checkout-btn btn btn-primary">Check Out</button>
        </form>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="../assets/js/cart.js"></script>
    <script>
        function updateQuantity(productId, productColor, action) {
            const item = document.querySelector(`.cart-item[data-cart-id="${productId}"][data-product-color="${productColor}"]`);
            const quantityInput = item.querySelector('input');
            let quantity = parseInt(quantityInput.value);

            if (action === 'decrement' && quantity > 1) {
                quantity--;
            } else if (action === 'increment') {
                quantity++;
            }

            quantityInput.value = quantity;

            // Update total price
            let total = 0;
            document.querySelectorAll('.cart-item').forEach(item => {
                const price = parseFloat(item.getAttribute('data-price'));
                const quantity = parseInt(item.querySelector('input').value);
                total += price * quantity;
            });
            document.getElementById('cart-total').textContent = total.toFixed(2);

            // Update hidden input fields
            const hiddenInput = document.querySelector(`input[name="orderItems[]"][value*="${productId}"]`);
            hiddenInput.value = JSON.stringify({
                product_id: productId,
                product_color: productColor,
                quantity: quantity,
                price: item.getAttribute('data-price'),
                product_name: item.querySelector('h5').textContent,
                product_image: item.querySelector('img').src
            });
        }
    </script>
</body>

</html>