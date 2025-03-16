<?php
include("../vendor/autoload.php");

use Libs\Database\MySQL;
use Libs\Database\UsersTable;
use Helpers\User_Auth;

User_Auth::check();

$userId = $_SESSION['user_id'];
$usersTable = new UsersTable(new MySQL());
$user = $usersTable->getUserById($userId);


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <link rel="stylesheet" href="../assets/css/profile.css">
    <link href="../node_modules/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer">
</head>

<body>
    <div class="profile-container">
        <div class="profile-header">
            <div class="profile-img" id="profile-img">
                <?php if (!empty($user['user_profile'])) : ?>
                    <img id="profile-image" src="../assets/upload/<?php echo htmlspecialchars($user['user_profile']); ?>" alt="User Image">
                <?php else : ?>
                    <i class="fa fa-user-circle"></i>
                <?php endif; ?>
            </div>
            <div class="profile-info">
                <h3 class="user-name">
                    <?php if (!empty($user['user_name'])) : ?>
                        <?php echo htmlspecialchars($user['user_name']); ?>
                    <?php else : ?>
                        USER
                    <?php endif; ?>
                </h3>
                <!-- <div class="profile-stats">
                    <div class="stat">
                        <span>8</span>
                        <p>My Wishlist</p>
                    </div>
                    <div class="stat">
                        <span>11</span>
                        <p>Followed Stores</p>
                    </div>
                    <div class="stat">
                        <span>0</span>
                        <p>Vouchers</p>
                    </div>
                </div> -->
                <a href="setting.php" style="list-style: none; color: #ffff;">
                    <i style="color: #ffff;" class="fa fa-cog settings-icon "></i>
                </a>
            </div>
        </div>
        <div class="order-section">
            <h2>My Orders</h2>
            <div class="order-categories">
                <!-- <div class="category">
                    <i class="fa fa-credit-card"></i>
                    <p>To Pay</p>
                </div> -->
                <div class="category">

                    <a style="list-style: none; color: #000" href="order_history.php"><i class="fa fa-truck"></i></a>
                    <p>To Ship</p>
                </div>
                <div class="category">
                    <a style="list-style: none; color: #000" href="order_history.php"><i class="fa fa-box"></i></a>
                    <p>To Receive</p>
                </div>
                <!-- <div class="category">
                    <i class="fa fa-comment-dots"></i>
                    <p>To Review</p>
                </div> -->
                <!-- <div class="category">
                    <i class="fa fa-undo"></i>
                    <p>My Returns</p>
                </div>
                <div class="category">
                    <i class="fa fa-times"></i>
                    <p>My Cancellations</p>
                </div> -->
            </div>
            <div class="order-list" id="order-list">
                <!-- Orders will be inserted here by JavaScript -->
            </div>
            <button id="view-more" class="btn btn-primary">View More</button>
        </div>
        <div class="service-section">
            <h2>My Service</h2>
            <div class="service-categories">
                <div class="service-category">
                    <i class="fa fa-envelope"></i>
                    <p>Messages</p>
                </div>
                <div class="service-category">
                    <i class="fa fa-star"></i>
                    <p>My Review</p>
                </div>
                <div class="service-category">
                    <i class="fa fa-wallet"></i>
                    <p>Payment Options</p>
                </div>
                <div class="service-category">
                    <i class="fa fa-question-circle"></i>
                    <p>Help</p>
                </div>
            </div>
        </div>
    </div>

    <div id="uploadModal" class="modal">
        <div class="modal-content-1">
            <span id="closeModal" class="close">&times;</span>
            <h2>Upload Profile Image</h2>
            <form id="uploadForm" action="../user_actions/profile_upload.php" method="POST" class="" enctype="multipart/form-data">
                <!-- <input class=" mb-0 mt-1" type="file" name="profile_image" required> -->
                <input type="file" name="profile_image" class="form-control mb-0 mt-1" id="inputGroupFile04" aria-describedby="inputGroupFileAddon04" aria-label="Upload">
                <button type="submit" class=" mt-3 btn">Upload</button>
            </form>
        </div>
    </div>

    <script>
        document.getElementById('profile-img').addEventListener('click', function() {
            document.querySelector('.profile-container').classList.add('blur');
            document.getElementById('uploadModal').style.display = 'flex';
        });

        document.getElementById('closeModal').addEventListener('click', function() {
            document.querySelector('.profile-container').classList.remove('blur');
            document.getElementById('uploadModal').style.display = 'none';
        });
    </script>

</body>

</html>