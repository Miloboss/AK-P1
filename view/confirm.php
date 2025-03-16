<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Confirmation</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
            font-family: 'Arial', sans-serif;
        }

        .confirmation-container {
            text-align: center;
            background-color: #fff;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            animation: fadeIn 1s ease-in-out;
        }

        .confirmation-container h1 {
            font-size: 2em;
            margin-bottom: 20px;
        }

        .checkmark {
            font-size: 100px;
            color: #28a745;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @media (max-width: 768px) {
            .confirmation-container {
                padding: 20px;
            }

            .confirmation-container h1 {
                font-size: 1.5em;
            }

            .checkmark {
                font-size: 80px;
            }
        }
    </style>
    <script>
        setTimeout(function() {
            window.location.href = '../index.php'; // Change 'index.php' to your home page URL
        }, 2000); // 10 seconds timer
    </script>
</head>

<body>
    <div class="confirmation-container">
        <div class="checkmark">✔</div>
        <h1>Your Order is Confirmed!</h1>
        <p>Thank you for your purchase. Your order has been confirmed and is being processed.</p>
        <p>You will be redirected to the home page shortly.</p>
    </div>
</body>

</html>