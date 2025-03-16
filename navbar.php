<link rel="stylesheet" href="assets/css/navbar.css">
<link rel="stylesheet" href="node_modules/bootstrap/dist/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer">
<!-- custom css -->
<link rel="stylesheet" href="assets/css/main.css">


<nav class="navbar navbar-expand-lg navbar-my fixed-top" style="padding-top: 10px; padding-bottom: 10px">
    <div class="container">
        <a class="navbar-brand d-flex justify-content-between align-items-center order-lg-0" href="index.html">
            <img src="images/shopping-bag-icon.png" alt="site icon">
            <span class="text-uppercase fw-lighter ms-2">Attire</span>
        </a>

        <div class="order-lg-2 nav-btns">
            <button type="button" class="btn position-relative">
                <a style=" color:black" href="view/cart.php"><i class="fa fa-shopping-cart"></i></a>
                <span class="position-absolute top-0 start-100 translate-middle badge bg-primary">
                    <?php if (isset($cartRowCount)) {
                        echo $cartRowCount;
                    } else {
                        echo "0";
                    } ?>

                </span>
            </button>
            <button type="button" class="btn position-relative">
                <a style=" color:black" href="view/profile.php"><i class="fa-solid fa-user"></i></a>
                <!-- <span class="position-absolute top-0 start-100 translate-middle badge bg-primary">2</span> -->
            </button>
            <button type="button" class="btn position-relative">
                <i class="fa fa-search"></i>
            </button>
        </div>

        <button class="navbar-toggler border-0" style="box-shadow: none;" type="button" data-bs-toggle="collapse" data-bs-target="#navMenu">
            <span class="navbar-toggler-icon border-0"></span>
        </button>

        <div class="collapse navbar-collapse v order-lg-1" id="navMenu">
            <ul class="navbar-nav  mx-auto text-center">
                <li class="nav-item px-2 py-2">
                    <a class="nav-link text-uppercase text-dark" href="#header">home</a>
                </li>
                <li class="nav-item px-2 py-2">
                    <a class="nav-link text-uppercase text-dark" href="#collection">collection</a>
                </li>
                <li class="nav-item px-2 py-2">
                    <a class="nav-link text-uppercase text-dark" href="#special">specials</a>
                </li>
                <li class="nav-item px-2 py-2">
                    <a class="nav-link text-uppercase text-dark" href="#blogs">blogs</a>
                </li>
                <li class="nav-item px-2 py-2">
                    <a class="nav-link text-uppercase text-dark" href="#about">about us</a>
                </li>
                <li class="nav-item px-2 py-2 border-0">
                    <a class="nav-link text-uppercase text-dark" href="#popular">popular</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
<!-- end of navbar -->

<!-- jquery -->
<script src="assets/js/jquery-3.6.0.js"></script>
<!-- isotope js -->
<script src="https://unpkg.com/isotope-layout@3/dist/isotope.pkgd.js"></script>
<!-- bootstrap js -->
<script src="node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- custom js -->
<!-- <script src="assets/js/script1.js"></script> -->
<script src="https://kit.fontawesome.com/f172167687.js" crossorigin="anonymous"></script>