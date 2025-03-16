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
    <title>User Settings</title>


    <link href="../node_modules/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="../assets/css/setting.css">
</head>


<body>
    <?php
    include('navbar.php');
    ?>
    <div class="container_m">
        <h1>User Settings</h1>
        <?php if (isset($_GET['success'])) : ?>
            <p class="success">User information updated successfully!</p>
        <?php endif; ?>
        <?php if (isset($_GET['error'])) : ?>
            <p class="danger">Your Password is Wrong.Try Again!</p>
        <?php endif; ?>
        <div class="info-group">
            <span>Full Name:</span>
            <span><?php echo htmlspecialchars($user['user_name']); ?></span>
            <button class="button_1" onclick="openEditModal('user_name', '<?php echo htmlspecialchars($user['user_name']); ?>')">Edit</button>
        </div>
        <div class="info-group">
            <span>Change Mobile:</span>
            <span><?php echo htmlspecialchars($user['phone_number']); ?></span>
            <button class="button_1" onclick="openEditModal('phone_number', '<?php echo htmlspecialchars($user['phone_number']); ?>')">Edit</button>
        </div>
        <div class="info-group">
            <span>Change Address:</span>
            <span style="width: 250px; text-algin: justify;"><?php echo htmlspecialchars($user['address']); ?></span>
            <button class="button_1" onclick="openEditModal('address', '<?php echo htmlspecialchars($user['address']); ?>')">Edit</button>
        </div>
        <div class="info-group">
            <span>Change Email:</span>
            <span><?php echo htmlspecialchars($user['email']); ?></span>
            <button class="button_1" onclick="openEditModal('email', '<?php echo htmlspecialchars($user['email']); ?>')">Edit</button>
        </div>
    </div>

    <!-- Edit Modal -->
    <div id="editModal" class="modal">
        <div class="modal-content">
            <div class=" d-flex justify-content-between">
                <label class="form-label mb-0 pt-1" for="fieldValue" id="fieldLabel"></label>
                <span class="close" onclick="closeEditModal()">&times;</span>
            </div>

            <form id="editForm" action="../user_actions/user_setting.php" method="post">


                <input type="hidden" id="fieldName" name="field_name">
                <input class="form-control" type="text" id="fieldValue" name="field_value" required>
                <input class="form-control mt-3 mb-3" type="password" id="fieldValue_1" name="password" placeholder="Please Enter Your Password">
                <button class="ed-btn class=" button_1"" type="submit">Save</button>
            </form>
        </div>
    </div>

    <script>
        function openEditModal(field, value) {
            document.getElementById('editModal').style.display = 'block';
            document.getElementById('fieldName').value = field;
            document.getElementById('fieldValue').value = value;
            let show = document.getElementById('fieldValue_1');
            document.getElementById('fieldLabel').textContent = 'Edit ' + field.charAt(0).toUpperCase() + field.slice(1);

            if (field == 'email') {
                show.style.display = 'block';
            } else {
                show.style.display = 'none';
            }
            // Apply specific modal content styles based on screen size
            if (window.innerWidth <= 600) {
                document.querySelector('.modal-content').style.position = 'fixed';
                document.querySelector('.modal-content').style.bottom = '0';
                document.querySelector('.modal-content').style.transform = 'none';
                document.querySelector('.modal-content').style.top = 'auto';
            } else {
                document.querySelector('.modal-content').style.position = 'relative';
                document.querySelector('.modal-content').style.top = '50%';
                document.querySelector('.modal-content').style.transform = 'translateY(-50%)';
                document.querySelector('.modal-content').style.bottom = 'auto';
            }
        }

        function closeEditModal() {
            document.getElementById('editModal').style.display = 'none';
        }

        // Close modal when clicking outside of it
        window.onclick = function(event) {
            var modal = document.getElementById('editModal');
            if (event.target == modal) {
                modal.style.display = 'none';
            }
        }
    </script>
</body>

</html>