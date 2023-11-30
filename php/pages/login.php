<!DOCTYPE html>
<html lang="en">
<head>
    <!--Meta Tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--Web Appearance-->
    <link rel="icon" type="image/png" sizes="32x32" href="../../favicon.png">
    <meta name="theme-color" content="#ffffff">
    <title>Sign in into BudgetMate</title>
    <!--CSS-->
    <link rel="stylesheet" href="../../css/bootstrap.min.css">
    <link rel="stylesheet" href="../../css/fontawesome.all.min.css">
    <link rel="stylesheet" href="../../css/style.css">

    <style>
        .btn-custom {
            background-color: #C683D7;
            border-color: #B15EFF;
            color:#31304D;
            border-width: 3px;
        }

        .btn-custom:hover {
            background-color: #BB9CC0;
            color:#31304D;
            border-color: #f5cca0;
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

    <main>
        <div class="center-page container">
            <div class="row">
                <div class="col-sm-12 col-md-6">
                    <h1 class="mb-3 mt-3">Sign in</h1>
                    <form action="../handlers/login_handler.php" method="POST" onsubmit="return validateLoginForm()">
                        <div class="form-group">
                          <label for="username">Username</label>
                          <input type="text" class="form-control form-control-lg" id="username" name="username" placeholder="Enter Username" required>
                        </div>
                        <div class="form-group">
                          <label for="password">Password</label>
                          <input type="password" class="form-control form-control-lg" id="password" name="password" placeholder="Enter Password" required>
                        </div>
                        <button type="submit" class="btn btn-primary btn-custom btn-lg">Submit</button>
                    </form>
                    <p class="pt-3">
                        Don't have an account?
                        <a href="./signup.php">Register here</a>
                    </p>
                </div>
                <div class="col-sm-12 col-md-6">
                    <img src="../../img/login.jpg" class="image mb-3 mt-3" alt="banner">
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