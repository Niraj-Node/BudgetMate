<?php
    include '../functions/navigation.php';
    include '../functions/db_config.php';
    include '../functions/sql_queries.php';
    session_start();

    if(!isset($_SESSION['username']) || !isset($_POST['currentDesc']) || !isset($_POST['logId'])) {
        navigate_to_pages('history',"Cannot fetch data");
        exit();
    } 
    else 
    {
        $username = $_SESSION['username'];
        $user_id = $_SESSION['user_id'];
        $desc = $_POST['currentDesc'];
        $logId = (int) $_POST['logId'];

        $query = update_description($conn,$logId,$desc);
        $result = mysqli_query($conn,$query);
        if(!$result) {
            navigate_to_pages('history',mysqli_error($conn));
        } else {
            navigate_to_pages('history');
        }
    }
    
    mysqli_close($conn);
?>