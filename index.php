<!DOCTYPE html>
<html lang="en">
<head>
    <!--Meta Tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--Web Appearance-->
    <link rel="icon" type="image/png" sizes="32x32" href="./favicon.png">
    <meta name="theme-color" content="#ffffff">
    <title>BudgetMate</title>
    <!--CSS-->
    <link rel="stylesheet" href="./css/bootstrap.min.css">
    <link rel="stylesheet" href="./css/fontawesome.all.min.css">
    <link rel="stylesheet" href="./css/style.css">
</head>

<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-light">
            <?php include './php/functions/navigation.php'; ?>
            <a class="navbar-brand" href="<?php echo $baseUrl; ?>">
                <img src="./favicon.png" width="30" height="30" class="d-inline-block align-top" alt="Logo">
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav">
                    <a class="nav-item nav-link active" href=".">BudgetMate<span class="sr-only">(current)</span></a>
                    <a class="nav-item nav-link" href="./php/pages/home.php">Home</a>
                    <a class="nav-item nav-link" href="./about.php">About</a>
                    <a class="nav-item nav-link" href="./faq.php">FAQ</a>
                </div>
            </div>
        </nav>
    </header>

    <!--Main page-->
    <main>
        <div>
            <!--First-->
            <div class="container p-4">
                <div class="row">
                    <div class="col-md-6 col-sm-12">
                        <img src="./img/index1.jpg" class="image" alt="banner">
                    </div>
                    <div class="col-md-6 col-sm-12 pt-5">
                        <h2>BudgetMate</h2>
                        <div class="pt-3">
                            <p>BudgetMate is your comprehensive solution for managing and tracking your expenses effortlessly. Seamlessly designed to assist you in budgeting and monitoring your spending, BudgetMate simplifies expense tracking. Sign up today to embark on your journey towards effective expense management</p>
                        </div>
                            <div class="row">
                                <div class="col-12">
                                    <a href="./php/pages/login.php" class="btn mt-2 btn-lg btn-custom btn-block">Sign In</a>
                                </div>
                                <div class="col-12">
                                    <a href="./php/pages/signup.php" class="btn mt-2 btn-lg btn-custom btn-block">Sign Up</a>
                                </div>
                        </div>
                    </div>
                </div>
            </div>

            <!--Second-->
            <div class="container p-2 p">
                <div class="row">
                    <div class="col-md-6 col-sm-12 mb-sm-5 mt-sm-5">
                        <img src="./img/index2.jpg" class="image img-fluid" alt="banner">
                    </div>
                    <div class="col-md-6 col-sm-12 d-flex align-items-center">
                        <div>
                            <h2>Concerned about your spending?</h2>
                            <div class="pt-3">
                                <p">With BudgetMate, effortlessly monitor your expenses and take control of your financial habits. Visualize your expenditure patterns through intuitive graphical representations of your balances. Say goodbye to traditional paper tracking and embrace a more efficient way to manage your finances!</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!--Third-->
            <div class="container p-5">
                <div class="row">
                    <div class="col-md-6 col-sm-12 mb-sm-5">
                        <img src="./img/index3.jpg" class="image" alt="banner">
                    </div>
                    <div class="col-md-6 col-sm-12 d-flex align-items-center">
                        <div>
                            <h2>Never forget crucial financial details again!</h2>
                            <p?>Avoid overspending and the stress of post-expense debt by harnessing BudgetMate. Say goodbye to miscalculations and the human tendency to forget. With BudgetMate, ensure a proactive and accurate approach to managing your finances.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!--Footer-->
    <footer id="footer">
        <div class="container">
            <div class="text-center copyright">
                &copy; Copyright <strong><a href="https://niraj-node.github.io/" target="_blank">Niraj Aghera</a></strong>
            </div>
            <div class="text-center credits">
                Designed by <a href="https://niraj-node.github.io/" target="_blank">Niraj Aghera</a>
            </div>
        </div>
   </footer>

    <!--JS-->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>

</body>

</html>
