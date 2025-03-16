<?php
include("../vendor/autoload.php");

use Libs\Database\MySQL;
use Libs\Database\UsersTable;
use Helpers\User_Auth;

$productTable = new UsersTable(new MySQL());
$product_id = $_GET['id'];
$products = $productTable->getFilterProduct($product_id);


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Details</title>
    <link rel="stylesheet" href="../assets/css/styles.css">
    <link href="../node_modules/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="../assets/css/products-detail.css">
    <!-- <script src="https://kit.fontawesome.com/f172167687.js" crossorigin="anonymous"></script> -->

    <style>
        .form-group_1 {
            display: flex;
        }

        .color-options {
            display: flex;
            justify-content: center;
            gap: 10px;
            margin-top: 10px;
        }

        .color-option {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 40px;
            height: 40px;
            border: 2px solid #ddd;
            border-radius: 50%;
            overflow: hidden;
            cursor: pointer;
            transition: border 0.3s ease;
            margin-right: 10px;
        }

        .color-option input[type="radio"] {
            display: none;
        }

        .color-option .color-display {
            display: block;
            width: 100%;
            height: 100%;
            border-radius: 50%;
        }

        .color-option input[type="radio"]:checked+.color-display {
            border: 2px solid #007bff;
        }
    </style>
</head>

<body>
    <?php
    // include('navbar.php');
    ?>

    <div class="details-container mt-4">
        <div class="image-gallery">
            <div class="image-container">
                <button class="nav-btn prev-btn" id="prevBtn">&#10094;</button>
                <!-- <img src="assets/image/products/9.png" alt="Product Image 1" class="product-image">
                <img src="assets/image/products/10.png" alt="Product Image 2" class="product-image">
                <img src="assets/image/products/10.png" alt="Product Image 2" class="product-image">
                <img src="assets/image/products/9.png" alt="Product Image 1" class="product-image"> -->

                <?php if ($products['main_image']) : ?>
                    <img src="../image/<?php echo $products['main_image']; ?>" alt="Product Image 1" class="product-image">
                <?php endif; ?>

                <?php if ($products['image1']) : ?>
                    <img src="../image/<?php echo $products['image1']; ?>" alt="Product Image 1" class="product-image">
                <?php endif; ?>

                <?php if ($products['image2']) : ?>
                    <img src="../image/<?php echo $products['image2']; ?>" alt="Product Image 1" class="product-image">
                <?php endif; ?>

                <?php if ($products['image3']) : ?>
                    <img src="../image/<?php echo $products['image3']; ?>" alt="Product Image 1" class="product-image">
                <?php endif; ?>
                <button class="nav-btn next-btn" id="nextBtn">&#10095;</button>
                <span class="zoom-icon" id="zoomIcon">&#128269;</span>
            </div>
        </div>
        <div class="product-details">
            <h2 style=" font-weight: bold;"><?php echo $products['product_name']; ?></h2>
            <p>Brand: <?php echo $products['product_brand']; ?></p>
            <!-- <P>Warranty: 2Years</P> -->
            <h3 name="price" style=" font-weight: bold;">Price: <?php echo $products['price']; ?> Ks</h3>
            <form id="orderForm" action="../user_actions/add_cart.php?price=<?php echo $products['price']; ?>" method="post">
                <input type="hidden" name="product_id" value="<?php echo htmlspecialchars($products['product_id']); ?>">
                <?php if ($products['has_colors']) : ?>
                    <div class="form-group_1">
                        <div class="form-group_1">
                            <label class=" pt-2 mr-1" for="color">Select Color:</label>
                            <?php foreach (json_decode($products['colors']) as $color) : ?>
                                <label class="color-option">
                                    <input type="radio" name="color" value="<?php echo htmlspecialchars($color); ?>">
                                    <span class="color-display" style="background-color: <?php echo htmlspecialchars($color); ?>;"></span>
                                </label>
                            <?php endforeach; ?>
                        </div>
                    </div>
                <?php endif; ?>

                <div class="product">
                    <div class="quantity-control">
                        <button type="button" id="decrease-quantity">-</button>
                        <input name="quantity" type="text" id="quantity" value="1" readonly>
                        <button type="button" id="increase-quantity">+</button>
                    </div>
                    <div class="add-1">
                        <button type="submit" id="add-to-cart">ADD TO CART</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="product-description mb-4">
        <div class=" desc-txt d-flex justify-content-between">
            <h2>Description</h2>
            <i id="toggle-icon">+</i>
        </div>

        <div id="dsc-more" class="description-content">
            <h5 class="ps-1 mt-3 mb-5" style=" font-weight: bold;"><?php echo $products['product_name']; ?></h5>
            <p class="ps-1"><?php echo $products['product_description']; ?></p>
        </div>
    </div>

    <div id="zoomModal" class="zoom-modal">
        <span class="close">&times;</span>
        <img class="zoom-modal-content" id="zoomedImage">
    </div>

    <script src="../assets/js/products-detail.js"></script>

</body>

</html>