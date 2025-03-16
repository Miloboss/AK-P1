<?php
session_start();
include("vendor/autoload.php");

use Libs\Database\MySQL;
use Libs\Database\UsersTable;
use Helpers\User_Auth;

if (!isset($_SESSION['user_id'])) {
} else {
    $user_id = $_SESSION['user_id'];
    $usersTable = new UsersTable(new MySQL());
    $cartRowCount = $usersTable->getCartRowCount($user_id);
}





$productTable = new UsersTable(new MySQL());
$limit = 8;
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $limit;

$products = $productTable->getProducts($offset, $limit);
$totalProducts = $productTable->getTotalProducts();
$totalPages = ceil($totalProducts / $limit);


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Online Shopping Navbar</title>
    <link rel="stylesheet" href="assets/css/styles.css">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <script src="assets/js/fontawesome.js" crossorigin="anonymous"></script>
</head>

</head>

<?php
include('navbar.php');
?>
<div class="mobile-menu-overlay"></div>

<div class="carousel-my">
    <div class="carousel-inner-my">
        <div class="carousel-item-my"><img src="assets/image/1.png" alt="Image 1"></div>
        <div class="carousel-item-my"><img src="assets/image/2.png" alt="Image 2"></div>
        <div class="carousel-item-my"><img src="assets/image/3.png" alt="Image 3"></div>
        <div class="carousel-item-my"><img src="assets/image/4.png" alt="Image 3"></div>
    </div>
</div>
<!-- products -->
<div class="container-fluid mt-4 products">
    <div class=" d-flex justify-content-between">
        <div class=" pro-title-name">
            <h3>Our Products</h3>
        </div>
        <div class=" pro-title-view ">
            <a href="#">
                <h3 class=" list-group-item">View All <i class="fa-solid fa-arrows-turn-right"></i></h3>
            </a>
        </div>
    </div>

    <div class="product-grid">
        <?php foreach ($products as $product) : ?>
            <a href="view/product-details.php?id=<?php echo htmlspecialchars($product['product_id']); ?>" style=" list-style: none; text-decoration: none; color: #000" class="product-item">
                <img src="image/<?php echo htmlspecialchars($product['image1']); ?>" alt="Product 1">
                <div class="product-details">
                    <div class="product-brand"><?php echo htmlspecialchars($product['product_brand']); ?></div>
                    <div class="product-name"><?php echo htmlspecialchars($product['product_name']); ?></div>
                    <div class="product-price">Ks <?php echo htmlspecialchars($product['price']); ?></div>
                </div>
            </a>
        <?php endforeach; ?>
    </div>

    <div>
        <?php if ($page < $totalPages) : ?>
            <button id="viewMoreBtn" onclick="loadMore()">View More</button>
        <?php endif; ?>
    </div>
</div>


<script src="assets/js/script.js"></script>
<!-- <script>
    let currentPage = <?php echo $page; ?>;
    const totalPages = <?php echo $totalPages; ?>;

    function loadMore() {
        currentPage++;
        if (currentPage <= totalPages) {
            fetch('index.php?page=' + currentPage)
                .then(response => response.text())
                .then(data => {
                    const parser = new DOMParser();
                    const doc = parser.parseFromString(data, 'text/html');
                    const newProducts = doc.querySelector('.product-grid').innerHTML;
                    document.querySelector('.product-grid').insertAdjacentHTML('beforeend', newProducts);

                    if (currentPage >= totalPages) {
                        document.getElementById('viewMoreBtn').style.display = 'none';
                    }
                });
        }
    }
</script> -->

</body>

</html>