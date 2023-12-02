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
    else 
    {
        $username = $_SESSION['username'];
        $user_id = $_SESSION['user_id'];

        mysqli_autocommit($conn,FALSE);
        $query = delete_data_1($conn,$user_id);
        $result = mysqli_query($conn,$query);
        $query = delete_data_2($conn,$username);
        $result = mysqli_query($conn,$query);
        $commit = mysqli_commit($conn);
        mysqli_autocommit($conn,TRUE);

        if (!$commit) {
            navigate_to_pages('settings', "Database error");
            exit();
        } 
        else {
            successfulReg('home',"All Expense Records have been Deleted");
        }
    }

    mysqli_close($conn);
?>
