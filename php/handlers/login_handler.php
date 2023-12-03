<!DOCTYPE html>
<html lang="en">
<head>
    <!--Meta Tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--Web Appearance-->
    <link rel="icon" type="image/png" sizes="32x32" href="../../favicon.png">
    <meta name="theme-color" content="#ffffff">
    <title>Sign in into BudgetMate</title>
    <!--CSS-->
    <link rel="stylesheet" href="../../css/bootstrap.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../../css/style.css">
</head>

<body>
    <div class="container center-page">
        <img src="../../img/loading.gif" alt="Loading....." style="width: 10%;height: auto;pointer-events: none;">
    </div>

<?php

include '../functions/db_config.php';
include '../functions/navigation.php';
include '../functions/sql_queries.php';

session_start();

if(isset($_POST['username']) && isset($_POST['password'])) 
{
    $username = $_POST['username'];
    $pass = $_POST['password'];

    $query = get_user_details($conn, $username);
    $result = mysqli_query($conn, $query);

    if(!$result) 
    {
        navigate_to_pages('login', mysqli_errno($conn));
        exit();
    } 
    else if(mysqli_num_rows($result) != 1) 
    {
        navigate_to_pages('login', "Username doesn't exist");
        exit();
    } 
    else 
    {
        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);

        // strip and escape pass to prevent sql injection
        $striped_pass = stripcslashes($pass);
        $mysql_pass = mysqli_real_escape_string($conn, $striped_pass);

        //verify pass after hashing with hashed pass from db
        if (!password_verify($mysql_pass, $row['hash_pwd'])) 
        {
            navigate_to_pages('login', "Invalid password");
            exit();
        } 
        else 
        {
            $_SESSION['username'] = $username;
            $_SESSION['user_id'] = $row['id'];
            navigate_to_pages('home');
        }
    }
} 
else 
{
    navigate_to_pages('login', "Cannot get username and password");
    exit();
}

mysqli_close($conn);
?>

</body>
</html>