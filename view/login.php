<?php
include("../vendor/autoload.php");

use Libs\Database\MySQL;
use Libs\Database\AdminsTable;
use Helpers\User_Auth;

// if (!User_Auth::check()) {
//     header('Location: user-login.php'); // Redirect to login page if not logged in
//     exit;
// }


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="../node_modules/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="../assets/css/form.css">
</head>

<body>
    <div class="form_wrapper">
        <div class="form_container">
            <div class="title_container">
                <h2>Responsive Registration Form</h2>
            </div>
            <div class="row clearfix">
                <div class="">
                    <form id="loginForm" action="../user_actions/user_login.php" method="post" onsubmit="return validateForm()">
                        <div class="input_field"> <span><i aria-hidden="true" class="fa fa-envelope"></i></span>
                            <input type="email" name="email" placeholder="Email" required />
                        </div>
                        <div class="input_field"> <span><i aria-hidden="true" class="fa fa-lock"></i></span>
                            <input type="password" name="password" placeholder="Password" required />
                        </div>
                        <div class="checkbox-wrapper">
                            <input type="checkbox" id="remember" name="remember" class="custom-checkbox">
                            <label for="remember" class="custom-label">Remember Me</label>
                        </div> <br>
                        <!-- <div class="checkbox-wrapper">
                            <input type="checkbox" id="agree" name="agree" class="custom-checkbox" required>
                            <label for="agree" class="custom-label">I agree to the terms and conditions</label>
                            <div id="errorMessage" class="error" style="display: none;">You must agree to the terms and conditions.</div>
                        </div> <br> -->
                        <div>
                            <div class="input_field">
                                <label for="">If you not have an account.Please enter this
                                    <a style="list-style: none; text-decoration: none" href="register.php">REGISTER</a> .</label>
                            </div>
                            <input type="submit" value="Login" />
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- <p class="credit">Developed by <a href="http://www.designtheway.com" target="_blank">Design the way</a></p> -->
</body>
<script>
    function validateForm() {
        var agree = document.getElementById("agree").checked;
        if (!agree) {
            document.getElementById("errorMessage").style.display = "block";
            return false;
        }
        return true;
    }
</script>
<script src="../node_modules/bootstrap/dist/js/bootstrap.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>



</html>