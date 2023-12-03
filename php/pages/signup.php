<!DOCTYPE html>
<html lang="en">
<head>
    <!--Meta Tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--Web Appearance-->
    <link rel="icon" type="image/png" sizes="32x32" href="../../favicon.png">
    <meta name="theme-color" content="#ffffff">
    <title>Sign Up to BudgetMate</title>
    <!--CSS-->
    <link rel="stylesheet" href="../../css/bootstrap.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../../css/style.css">

    <style>
        .btn-custom {
            background-color: #03C988;
            border-color: #5FB9B0;
            color:#31304D;
            border-width: 3px;
        }

        .btn-custom:hover {
            background-color: #519872;
            color:#31304D;
            border-color: #557C55;
        }
    </style>
</head>

<body>

<?php
include '../functions/navigation.php';
session_start();

if (isset($_SESSION['username'])) {
    navigate_to_pages('home');
    exit();
}
?>

<script>
    window.onload = function() {
        const captchaText = generateRandomCaptcha();
        document.getElementById("captchaText").innerText = captchaText;
    };
</script>

    <main>
        <div class="center-page container">
            <div class="row">
                <div class="col-sm-12 col-md-6">
                    <h1 class="mb-3 mt-3">Sign Up</h1>
                    <form action="../handlers/signup_handler.php" method="POST" onsubmit="return validateSignUpForm()">
                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" class="form-control form-control-lg" id="username" name="username" placeholder="Enter Username" required>
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control form-control-lg" id="password" name="password" placeholder="Enter Password" required>
                        </div>
                        <div class="form-group">
                            <label for="password">Re-Type Password</label>
                            <input type="password" class="form-control form-control-lg" id="repassword" name="repassword" placeholder="ReType Password" required>
                        </div>
                        <div class="form-group">
                            <label for="currency">Currency</label>
                            <select class="custom-select custom-select-lg" name="currency" id="currency">
                                <option value="1" selected>INR</option>
                                <option value="2">USD</option>
                                <option value="3">GBP</option>
                                <option value="4">EUR</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="captcha">Enter the text you see below:</label>
                            <div class="input-group">
                                <input type="text" class="form-control form-control-lg" id="captcha" name="captcha" placeholder="Enter Captcha" required>
                                <div class="input-group-append">
                                    <span class="input-group-text" style="background-color: #B6BBC4;">
                                        <span id="captchaText" class="captcha-text"></span>
                                        <button type="button" class="btn btn-link" onclick="refreshCaptcha()">
                                            <i class="fas fa-sync-alt"></i>
                                        </button>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-custom btn-lg">Submit</button>
                    </form>
                    <p class="pt-3">
                        Already have an account?
                        <a href="./login.php">Sign in</a>
                    </p>
                </div>
                <div class="col-sm-12 col-md-6 pt-md-5 pt-sm-2">
                    <img src="../../img/signup.jpg" class="image mb-3 mt-3" alt="banner">
                </div>
            </div>
        </div>
    </main>

    <!--JS-->
    <script src="../../js/form_validations.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>

</body>
</html>