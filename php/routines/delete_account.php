<?php
    include '../functions/navigation.php';
    include '../functions/db_config.php';
    include '../functions/sql_queries.php';

    if(!isset($_SESSION)) { 
        session_start(); 
    }

    if(!isset($_SESSION['username'])) {
        navigate_to_pages('login', "Not logged in");
    }
    else 
    {
        $username = $_SESSION['username'];
        $user_id = $_SESSION['user_id'];

        mysqli_autocommit($conn,FALSE);
        $query = delete_account_1($conn,$user_id);
        $result = mysqli_query($conn,$query);
        $query = delete_account_2($conn,$username);
        $result = mysqli_query($conn,$query);
        $commit = mysqli_commit($conn);
        mysqli_autocommit($conn,TRUE);
        if (!$commit) {
            navigate_to_pages('settings', "Database error");
        } 
        else 
        {
            session_destroy();
            echo '<script>';
            echo "alert('Account Deleted!');";
            echo "window.location.href = '$baseUrl';";
            echo '</script>';
        }
    }

    mysqli_close($conn);
?>