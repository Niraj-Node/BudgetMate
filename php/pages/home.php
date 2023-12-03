<!DOCTYPE html>
<html lang="en">
    <!--Meta Tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--Web Appearance-->
    <link rel="icon" type="image/png" sizes="32x32" href="../../favicon.png">
    <meta name="theme-color" content="#ffffff">
    <title>Home</title>
    <!--CSS-->
    <link rel="stylesheet" href="../../css/bootstrap.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../../css/style.css">
    <!--JS for Graph-->
    <script src="../../js/google_chart_loader.js"></script>
</head>

<body>
    <?php
        include '../functions/navigation.php';
        include '../functions/db_config.php';
        include '../functions/sql_queries.php';
        include './graph/chart_js_generator.php';

        if(!isset($_SESSION)) { 
            session_start(); 
        }
 
        if(!isset($_SESSION['username']))
        {
            navigate_to_pages('login', "Not logged in");
            exit();
        }
    ?>

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
                    <a class="nav-item nav-link active" href="./home.php">Home <span class="sr-only">(current)</span></a>
                    <a class="nav-item nav-link" href="./history.php">History</a>
                    <a class="nav-item nav-link" href="./settings.php">Settings</a>
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
    
    <!-- Pre fetching balances-->
    <?php
    $currency = "₹";
    $query = get_user_currency($conn, $username);
    $result = mysqli_query($conn,$query);
    if(!$result) 
    {
        show_alert("Database error!");
    } 
    else 
    {
        $row = mysqli_fetch_assoc($result);

        switch ($row['currency_default']) 
        {
            case 1:
                break;
            case 2:
                $currency = "$";
                break;
            case 3:
                $currency = "£";
                break;
            default:
                $currency = "€";
        } 

        $query = get_user_total_balance($conn, $username);
        $result = mysqli_query($conn,$query);
        if(!$result) {
            show_alert("Database error!");
        } 
        $row = mysqli_fetch_assoc($result);
        $total_balance = $row['total_balance'];
    }
    ?>

    <?php 
    $cash_bal = 0;
    $bank_bal = 0;
    $query = get_user_balances($conn,$username);
    $result = mysqli_query($conn,$query);
    if(!$result) {
        show_alert("Database error!");
    } else {
        $row = mysqli_fetch_assoc($result);
        $cash_bal = $row['cash_bal'];
        $bank_bal = $row['bank_bal'];
    }
    ?>

    <!--Main page-->
    <main>
        <div class="alert" style="background-color:#EEF296;">

            <div class="container p-2">
                <div class="row">
                    <div class="col-lg-4 col-md-6 col-sm-12 p-1">
                        <div class="card text-center border-secondary">
                            <div class="card-header" style="background-color:#22092C; color:#E0F4FF;">Cash Balance</div>
                            <div class="card-body" style="background-color:#E0F4FF; color:#22092C;">
                                <?php echo $currency.$cash_bal; ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-12 p-1">
                        <div class="card text-center border-secondary">
                            <div class="card-header" style="background-color:#872341; color:#FED9ED;">Bank Balance</div>
                            <div class="card-body" style="background-color:#FED9ED; color:#872341;">
                                <?php echo $currency.$bank_bal; ?>
                            </div>
                        </div>                
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-12 p-1">
                        <div class="card text-center border-secondary">
                            <div class="card-header" style="background-color:#22092C; color:#E0F4FF;">Total Balance</div>
                            <div class="card-body" style="background-color:#E0F4FF; color:#22092C;">
                                <?php echo $currency.$total_balance; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        
        <div style="background-color:#D0F288">
            <div class="container p-4">
                <div class="card">
                    <div class="card-header">Total Balance Chart</div> 
                    <div class="card-body">
                        <div id="div_balance_line_chart_1"></div>
                    </div>
                </div>
            </div>
        </div>

        <div style="background-color:#D0F288">
            <div class="container p-4">
                <div class="card">
                    <div class="card-header">Cash Balance Chart</div> 
                    <div class="card-body">
                        <div id="div_balance_line_chart_2"></div>
                    </div>
                </div>
            </div>
        </div>

        <div style="background-color:#D0F288">
            <div class="container p-4">
                <div class="card">
                    <div class="card-header">Bank Balance Chart</div> 
                    <div class="card-body">
                        <div id="div_balance_line_chart_3"></div>
                    </div>
                </div>
            </div>
        </div>

    </main>
    
    <!--Footer holding add and subtract buttons-->
    <div class="p-3 fixed-bottom d-flex justify-content-end">
        <button type="button" class="btn btn-success btn-lg shadow rounded-circle mx-2" data-toggle="modal" data-target="#addMoney">
            <i class="fa fa-plus"></i>
        </button>
        <button type="button" class="btn btn-danger btn-lg shadow rounded-circle mx-2" data-toggle="modal" data-target="#subMoney">
            <i class="fa fa-minus"></i>
        </button>
        <button type="button" class="btn btn-warning btn-lg shadow rounded-circle mx-2" data-toggle="modal" data-target="#transferMoney">
            <i class="fa fa-exchange-alt text-white"></i>
        </button>
    </div>

    <div class="modal fade" id="addMoney" tabindex="-1" role="dialog" aria-labelledby="addMoneyCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header bg-success text-white">
                    <h5 class="modal-title" id="addMoneyLongTitle">Add to balance</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="../routines/add_money.php" method="post" onsubmit="return validateAddAmount()" id="addMoneyForm">
                        <div class="form-group">
                            <label for="addAmount">Amount</label>
                            <input type="number" class="form-control form-control-lg" id="addAmount" name="amount" placeholder="Amount in Transaction" required>
                        </div>
                        <div class="form-group">
                            <label for="addDesc">Description</label>
                            <input type="text" class="form-control form-control-lg" id="addDesc" name="desc" placeholder="Description" required>
                        </div>
                        <input type="hidden" value="<?php echo $cash_bal+$debit_bal; ?>" name="balance">
                        <div class="form-group">
                            <label for="addAccount">Account</label>
                            <select class="custom-select custom-select-lg" name="account" id="addAccount">
                                <option value="1" selected>Cash</option>
                                <option value="2">Bank</option>
                            </select>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="submit" form="addMoneyForm" class="btn btn-success px-3">Add</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="subMoney" tabindex="-1" role="dialog" aria-labelledby="subMoneyCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title" id="subMoneyLongTitle">Subtract from balance</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="../routines/sub_money.php" method="post" onsubmit="return validateSubAmount()" id="subMoneyForm">
                        <div class="form-group">
                            <label for="subAmount">Amount</label>
                            <input type="number" class="form-control form-control-lg" id="subAmount" name="amount" placeholder="Amount in Transaction" required>
                        </div>
                        <div class="form-group">
                            <label for="subDesc">Description</label>
                            <input type="text" class="form-control form-control-lg" id="subDesc" name="desc" placeholder="Description" required>
                        </div>
                        <input type="hidden" value="<?php echo $cash_bal+$debit_bal; ?>" name="balance">
                        <div class="form-group">
                            <label for="account">Account</label>
                            <select class="custom-select custom-select-lg" name="account" id="subAccount">
                                <option value="1" selected>Cash</option>
                                <option value="2">Bank</option>
                            </select>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="submit" form="subMoneyForm" class="btn btn-danger px-3">Subtract</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="transferMoney" tabindex="-1" role="dialog" aria-labelledby="transferMoneyCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header bg-warning text-white">
                    <h5 class="modal-title" id="transferMoneyLongTitle">Transfer balance</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="../routines/transfer_money.php" method="post" onsubmit="return validateTransferAmount()" id="transferMoneyForm">
                        <div class="form-group">
                            <label for="transferAmount">Amount</label>
                            <input type="number" class="form-control form-control-lg" id="transferAmount" name="amount" placeholder="Amount in Transaction" required>
                        </div>
                        <div class="form-group">
                            <label for="transferDesc">Description</label>
                            <input type="text" class="form-control form-control-lg" id="transferDesc" name="desc" placeholder="Description" required>
                        </div>
                        <input type="hidden" value="<?php echo $cash_bal+$debit_bal; ?>" name="balance">
                        <div class="form-group">
                            <label for="transferFAccount">From</label>
                            <select class="custom-select custom-select-lg" name="faccount" id="transferFAccount">
                                <option value="1">Cash</option>
                                <option value="2" selected>Bank</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="transferTAccount">To</label>
                            <select class="custom-select custom-select-lg" name="taccount" id="transferTAccount">
                                <option value="1" selected>Cash</option>
                                <option value="2">Bank</option>
                            </select>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="submit" form="transferMoneyForm" class="btn btn-warning px-3 text-white">Transfer</button>
                </div>
            </div>
        </div>
    </div>

    <!--JS-->
    <script src="../../js/form_validations.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>

</body>
</html>