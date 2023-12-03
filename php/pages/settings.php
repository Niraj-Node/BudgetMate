<!DOCTYPE html>
<html lang="en">
<head>
    <!--Meta Tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--Web Appearance-->
    <link rel="icon" type="image/png" sizes="32x32" href="../../favicon.png">
    <meta name="theme-color" content="#ffffff">
    <title>Settings</title>
    <!--CSS-->
    <link rel="stylesheet" href="../../css/bootstrap.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../../css/style.css">
</head>

<body>
    
    <?php
        include '../functions/navigation.php';
        include '../functions/db_config.php';
        include '../functions/sql_queries.php';

        if(!isset($_SESSION)) { 
            session_start(); 
        }
 
        if(!isset($_SESSION['username']))
        {
            navigate_to_pages('login', "Not logged in");
            exit();
        }
    ?>

    <script>
        var baseUrl = "<?php echo $baseUrl; ?>";
    </script>
    <script src="../../js/event_listeners.js"></script>
    
    <header>
        <nav class="navbar navbar-expand-lg navbar-light">
            <a class="navbar-brand" href="<?php echo $baseUrl; ?>">
                <img src="../../favicon.png" width="30" height="30" class="d-inline-block align-top" alt="Logo">
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav mr-auto">
                    <a class="nav-item nav-link" href=".">Home <span class="sr-only">(current)</span></a>
                    <a class="nav-item nav-link" href="./history.php">History</a>
                    <a class="nav-item nav-link active" href="./settings.php">Settings</a>
                    <a class="nav-item nav-link text-danger" href="../handlers/logout.php">Log Out</a>
                </div>
                <span class="navbar-text">
                    Welcome, 
                    <span class="font-weight-bold">
                        <?php
                        $username =  $_SESSION['username'];
                        $user_id = $_SESSION['user_id'];
                        echo '@'.$username; ?>
                    </span>
                </span>
            </div>
        </nav>
    </header>

    <?php
        $username = $_SESSION['username'];
        $query = get_user_currency($conn,$username);
        $result = mysqli_query($conn,$query);
        if(!$result) {
            show_alert("Database error!");
        } else {
            $row = mysqli_fetch_assoc($result);
            $currencyChoice = $row['currency_default'];
        } 
    ?>

    <main style="background-color:#D0F288;">
        <div class="container py-5">
            <div class="card">
                <h5 class="card-header">Account Settings</h5>
                <div class="card-body" style="background-color:#EEF296;">
                    <form action="../handlers/password_change.php" onsubmit="return validateAccountSettingsForm()" method="post">
                        <div class="form-group">
                            <label for="cpassword">Enter Current Password</label>
                            <input type="password" class="form-control form-control-lg" id="cpassword" name="cpassword" placeholder="Enter Current Password" required>
                        </div>
                        <div class="form-group">
                            <label for="npassword">Enter New Password</label>
                            <input type="password" class="form-control form-control-lg" id="npassword" name="npassword" placeholder="Enter New Password" required>
                        </div>
                        <button type="submit" class="btn btn-primary btn-lg btn-block">Change Password</button>
                    </form>
                </div>
            </div>
        </div>

        <div class="container py-5">
            <div class="row">
                <div class="col-sm-12 col-md-4 text-center mb-4">
                    <button class="btn btn-danger btn-lg btn-block" onclick="confirmDeleteAccount()">Delete Account</button>
                    <small class="d-block text-muted">Deletes your account permanently.</small>
                </div>
                <div class="col-sm-12 col-md-4 text-center mb-4">
                    <button class="btn btn-danger btn-lg btn-block" onclick="confirmResetData()">Reset Data</button>
                    <small class="d-block text-muted">This only deletes your price history and not your account.</small>
                </div>
                <div class="col-sm-12 col-md-4 text-center mb-4">
                    <button class="btn btn-success btn-lg btn-block">Download PDF</button>
                    <small class="d-block text-muted">This exports all your transactions as an PDF File.</small>
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