<?php
    include '../functions/navigation.php';
    include '../functions/db_config.php';
    include '../functions/sql_queries.php';
    session_start();

    if(!isset($_SESSION['username']) || !isset($_POST['amount']) || !isset($_POST['faccount']) || !isset($_POST['taccount']) || !isset($_POST['desc'])) {
        navigate_to_login_page("Error sending data!");
        exit();
    } 
    else
    {
        $username = $_SESSION['username'];
        $user_id = $_SESSION['user_id'];
        $amount = (int)$_POST['amount'];
        $description = $_POST['desc'];
        $faccount = (int)$_POST['faccount'];
        $taccount = (int)$_POST['taccount'];
        $type = 2;

        if($faccount == $taccount)
        {
            navigate_to_pages('home',"Both accounts cannot be same");
            exit();
        }

        $query = get_user_balances($conn,$username);
        $result = mysqli_query($conn,$query);
        if (!$result) {
            navigate_to_pages('home',"Database error");
            exit();
        } 
        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
        
        //subtracting
        if($faccount == 1) {
            $balance_affected = $row['cash_bal'];
            $other_balance = $row['bank_bal'];
        }
        else {
            $balance_affected = $row['bank_bal'];
            $other_balance = $row['cash_bal'];
        }
        $balance_after = $balance_affected - $amount;

        if($balance_after<0) {
            $error_message = "Subtraction amount ($amount) is greater than the current balance ($balance_affected)";
            navigate_to_pages('home',$error_message);
            exit();
        } 

        mysqli_autocommit($conn,FALSE);
        $query = add_to_log($conn,$user_id,$faccount,$type,$amount,$description,$balance_affected,$balance_after,$other_balance);
        $result = mysqli_query($conn,$query);
        $query = update_user_bal($conn,$username,$faccount,$balance_after);
        $result = mysqli_query($conn,$query);
        
        //adding
        $type = 1;
        $query = get_user_balances($conn,$username);
        $result = mysqli_query($conn,$query);
        if (!$result) {
            navigate_to_pages('home',"Database error");
            exit();
        } 
        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
        
        if($taccount == 1) {
            $balance_affected = $row['cash_bal'];
            $other_balance = $row['bank_bal'];
        }
        else {
            $balance_affected = $row['bank_bal'];
            $other_balance = $row['cash_bal'];
        }
        $balance_after = $balance_affected + $amount;
        
        $query = add_to_log($conn,$user_id,$taccount,$type,$amount,$description,$balance_affected,$balance_after,$other_balance);
        $result = mysqli_query($conn,$query);
        $query = update_user_bal($conn,$username,$taccount,$balance_after);
        $result = mysqli_query($conn,$query);
        
        //committing
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