<?php
    include '../functions/navigation.php';
    include '../functions/db_config.php';
    include '../functions/sql_queries.php';
    session_start();
 
    if(!isset($_POST['logDate']) || !isset($_SESSION['username'])) {
        navigate_to_pages('history',"Cannot fetch data");
        exit();
    } 
    else 
    {
        $logDate = $_POST['logDate'];
        $username = $_SESSION['username'];
        $user_id = $_SESSION['user_id'];

        $query = del_logs_FROM($conn,$logDate,$user_id);
        $result = mysqli_query($conn,$query);
        mysqli_autocommit($conn,FALSE);

        $query = get_latest_log($conn,$user_id);
        $result = mysqli_query($conn,$query);
        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
        if($row)
        {
            $account = $row['account'];
            $other_balance = $row['other_balance'];
            $balance_after = $row['balance_after'];
            $query = update_user_bal_after_del($conn, $username, $account, $balance_after, $other_balance);
            $result = mysqli_query($conn,$query);
            $commit = mysqli_commit($conn);
            mysqli_autocommit($conn,TRUE);
            mysqli_autocommit($conn,TRUE);
            if (!$commit) {
                navigate_to_pages('history',"Database error");
                exit();
            } else {
                navigate_to_pages('history');
            }
        }
    }
    
    mysqli_close($conn);
?>