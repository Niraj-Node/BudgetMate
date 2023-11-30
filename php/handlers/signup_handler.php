<!DOCTYPE html>
<html lang="en">
<head>
    <!--Meta Tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--Web Appearance-->
    <link rel="icon" type="image/png" sizes="32x32" href="../../favicon.png">
    <meta name="theme-color" content="#ffffff">
    <title>Sign Up to BudgetMate</title>
    <!--CSS-->
    <link rel="stylesheet" href="../../css/bootstrap.min.css">
    <link rel="stylesheet" href="../../css/fontawesome.all.min.css">
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

if (isset($_POST['username']) && $_POST['password'] && $_POST['currency']) 
{
    $username = $_POST['username'];
    $pass = $_POST['password'];
    $repass = $_POST["repassword"];
    $curr = (int)$_POST['currency'];

    if($pass == $repass)
    {
        $query = get_user_details($conn, $username);
        $result = mysqli_query($conn, $query);

        if(mysqli_num_rows($result) > 0) 
        {
            navigate_to_pages('signup', "Username already exists");
            exit();
        } 
        else 
        {
            $query = insert_username($conn, $username, $pass, $curr);
            $result = mysqli_query($conn, $query);
            if($result) 
            {
                successfulReg('login',"Registration successful! You can now log in.");
            } 
            else 
            {
                navigate_to_pages('signup',mysqli_error($conn));
                exit();
            }
        }
    }
    else
    {
        navigate_to_pages('signup',"Passwords do not match");
        exit();
    }
} 
else 
{
    navigate_to_pages('signup', "Cannot get username or password or currency");
    exit();
}

mysqli_close($conn);
?>

</body>
</html>