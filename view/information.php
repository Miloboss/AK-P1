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
                <h2>Responsive Information Form</h2>
            </div>
            <div class="row clearfix">
                <div class="">
                    <form action="../user_actions/user_information.php" method="POST">
                        <div class="input_field"> <span><i aria-hidden="true" class="fa fa-envelope"></i></span>
                            <input type="text" name="name" placeholder="Enter Your Full Name" required />
                        </div>
                        <div class="input_field"> <span><i aria-hidden="true" class="fa fa-lock"></i></span>
                            <input type="text" name="phone" placeholder="Enter Your Phone Number" required />
                        </div>
                        <label class="input_field" style="font-size: 14px; opacity: 0.7" for="">Enter Your Address</label>
                        <div class="input-group">
                            <!-- <span class="input-group-text">With textarea</span> -->

                            <textarea name="address" class="form-control" aria-label="With textarea"></textarea>
                        </div> <br>

                        <!-- <div class="input_field">
                            <label for="">If you have an account.Please enter this
                                <a style="list-style: none; text-decoration: none" href="user-login.php">LOGIN</a> .</label>
                        </div> -->

                        <input type="submit" value="Confirm" />
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- <p class="credit">Developed by <a href="http://www.designtheway.com" target="_blank">Design the way</a></p> -->
</body>

</html>