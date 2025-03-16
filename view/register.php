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
                    <form action="../user_actions/user_register.php" method="POST">
                        <div class="input_field"> <span><i aria-hidden="true" class="fa fa-envelope"></i></span>
                            <input type="email" name="email" placeholder="Email" required />
                        </div>
                        <div class="input_field"> <span><i aria-hidden="true" class="fa fa-lock"></i></span>
                            <input type="password" name="password" placeholder="Password" required />
                        </div>
                        <div class="input_field"> <span><i aria-hidden="true" class="fa fa-lock"></i></span>
                            <input type="password" name="confirmPassword" placeholder=" Re-type Password" required />
                        </div>
                        <div class="checkbox-wrapper">
                            <input type="checkbox" id="agree" name="agree" class="custom-checkbox" required>
                            <label for="agree" class="custom-label">I agree to the terms and conditions</label>
                            <div id="errorMessage" class="error" style="display: none;">You must agree to the terms and conditions.</div>
                        </div><br>
                        <div class="input_field">
                            <label for="">If you have an account.Please enter this
                                <a style="list-style: none; text-decoration: none" href="login.php">LOGIN</a> .</label>
                        </div>

                        <input type="submit" value="Register" />
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- <p class="credit">Developed by <a href="http://www.designtheway.com" target="_blank">Design the way</a></p> -->
</body>

</html>