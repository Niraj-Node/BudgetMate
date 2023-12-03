<!DOCTYPE html>
<html lang="en">
    <!--Meta Tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--Web Appearance-->
    <link rel="icon" type="image/png" sizes="32x32" href="../../favicon.png">
    <meta name="theme-color" content="#ffffff">
    <title>History</title>
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
                    <a class="nav-item nav-link" href="./home.php">Home<span class="sr-only">(current)</span></a>
                    <a class="nav-item nav-link active" href="./history.php">History</a>
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

    <main class="p-3" style="background-color:#EEF296;">
        <div class="card container p-1">
            <div class="card-header">History Log</div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover text-center">
                        <thead>
                            <tr class="table-active">
                                <th scope="col">Type</th>
                                <th scope="col">Account</th>
                                <th scope="col">Amount</th>
                                <th scope="col">Date</th>
                                <th scope="col">Description</th>
                                <th scope="col">Account Balance Before</th>
                                <th scope="col">Account Balance After</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $username = $_SESSION['username'];
                                $user_id = $_SESSION['user_id'];
                                $query = get_user_currency($conn,$username);
                                $result = mysqli_query($conn,$query);
                                if(!$result) {
                                    navigate_to_pages('home',"Database error");
                                    exit();
                                } else {
                                    $row = mysqli_fetch_assoc($result);

                                    switch ($row['currency_default']) {
                                        case 1:
                                            $currency = "₹";
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
                                }
                                $query = get_all_logs($conn,$user_id);
                                $result = mysqli_query($conn,$query);
                                render_from_data($conn,$username,$user_id,$currency,$result);

                                function render_from_data($conn,$username,$user_id,$currency,$result) 
                                {
                                    if(mysqli_num_rows($result)==0) {
                                        echo '<tr><td colspan="8" class="text-center">No history available.</td></tr>';
                                    } 
                                    else 
                                    {
                                        while($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
                                        {
                                            $log_id = $row['id'];
                                            $type = $row['type'];
                                            $account = $row['account'];
                                            $amount = $row['amount'];
                                            $mysqlDate = $row['log_date'];
                                            $phpdate = strtotime( $mysqlDate );
                                            $date = date('d/m/y g:i A', $phpdate );
                                            $desc = $row['description'];
                                            $balance_before = $row['balance_affected'];
                                            $balance_after = $row['balance_after'];
                                            echo '<tr>';
                                            echo '<td>';
                                            if($type == 1) {
                                                echo '<i class="fa fa-plus text-success"></i>';
                                            } else {
                                                echo '<i class="fa fa-minus text-danger"></i>';
                                            }
                                            echo '</td>';
                                            echo '<td>';
                                            switch($account) 
                                            {
                                                case 1 :
                                                    echo 'Cash';
                                                    break;
                                                case 2 :
                                                    echo 'Bank';
                                                    break;
                                            }
                                            echo '</td>';
                                            echo '<td>';
                                            echo $currency.$amount;
                                            echo '</td>';
                                            echo '<td>';
                                            echo $date;
                                            echo '</td>';
                                            echo '<td>';
                                            echo '<form action="../routines/update_description.php" onsubmit="return getUpdatedDescription('.$log_id.')" method="post">';
                                                echo $desc;
                                                echo '<input type="hidden" value="'.$desc.'" name="currentDesc" id="currentDesc'.$log_id.'">';
                                                echo '<input type="hidden" value="'.$log_id.'" name="logId" id="logId'.$log_id.'">';
                                                echo '<button type="submit" class="btn" 
                                                style="padding: 0.25rem 0.4rem;
                                                margin: 0.2rem;
                                                background-color: #96EFFF;
                                                color: #161A30;
                                                font-size: 0.700rem;">
                                                <i class="fas fa-pencil-alt">
                                                </i></button>';
                                            echo '</form>';
                                            echo '</td>';
                                            echo '<td>';
                                            echo $currency.$balance_before;
                                            echo '</td>';
                                            echo '<td>';
                                            echo $currency.$balance_after;
                                            echo '</td>'; 
                                            echo '<td style="background-color:#FFF5C2">';
                                            //Undo transaction button form
                                            echo '<form action="../routines/undo_log.php" onsubmit="return undoTransactionConfirm()" method="post">';
                                                echo '<button type="submit" class="btn" style="background-color:#F4F27E;"><i class="fa fa-history"></i></button>';
                                                echo '<input type="hidden" value="'.$mysqlDate.'" name="logDate" id="logDate">';
                                            echo '</form>';
                                            echo '</td>';                                    
                                            echo '</tr>';
                                        }
                                    }
                                }

                                mysqli_close($conn);
                            ?>
                        </tbody>
                    </table>
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