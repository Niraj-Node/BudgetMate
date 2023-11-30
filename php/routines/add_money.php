<?php
    include '../functions/navigation.php';
    include '../functions/db_config.php';
    include '../functions/sql_queries.php';
    session_start();

    if(!isset($_SESSION['username']) || !isset($_POST['amount']) || !isset($_POST['account']) || !isset($_POST['desc'])) {
        navigate_to_pages('login',"Error sending data!");
        exit();
    } 
    else 
    {
        $username = $_SESSION['username'];
        $user_id = $_SESSION['user_id'];
        $account = (int)$_POST['account'];
        $amount = (int)$_POST['amount'];
        $type = 1;
        $description = $_POST['desc'];
        
        $query = get_user_balances($conn,$username);
        $result = mysqli_query($conn,$query);
        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
        if($account == 1) {
            $balance_affected = $row['cash_bal'];
            $other_balance = $row['bank_bal'];
        }
        else {
            $balance_affected = $row['bank_bal'];
            $other_balance = $row['cash_bal'];
        }
        $balance_after = $balance_affected + $amount;
        
        mysqli_autocommit($conn,FALSE);
        $query = add_to_log($conn,$user_id,$account,$type,$amount,$description,$balance_affected,$balance_after,$other_balance);
        $result = mysqli_query($conn,$query);
        $query = update_user_bal($conn,$username,$account,$balance_after);
        $result = mysqli_query($conn,$query);
        $commit = mysqli_commit($conn);
        mysqli_autocommit($conn,TRUE);
        if (!$commit) {
            navigate_to_pages('home',"Database error");
            exit();
        } else {
            navigate_to_pages('home');
        }
    }
    
    mysqli_close($conn);
?>