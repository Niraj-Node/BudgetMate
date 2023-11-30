<?php
    include '../functions/db_config.php';
    include '../functions/navigation.php';
    include '../functions/sql_queries.php';
    session_start(); 

    if(isset($_POST['cpassword']) && isset($_POST['npassword']) && isset($_SESSION['username'])) 
    {
        $cpassword = $_POST['cpassword'];
        $npassword = $_POST['npassword'];
        $username = $_SESSION['username'];

        $query = get_user_details($conn,$username);
        $result = mysqli_query($conn,$query);

        if(!$result) {
            navigate_to_pages('settings',mysqli_errno($conn));
            exit();
        } 
        else if(mysqli_num_rows($result) <= 0) {
            navigate_to_pages('settings',"Username doesn't exist");
            exit();
        } 
        else 
        {
            $row = mysqli_fetch_array($result, MYSQLI_ASSOC);  
            $striped_pass = stripcslashes($cpassword);
            $mysql_pass = mysqli_real_escape_string($conn,$striped_pass);
            if(!password_verify($mysql_pass,$row['hash_pwd'])) {
                navigate_to_pages('settings',"Invalid current password");
                exit();
            } 
            else 
            {
                $query = update_password($conn,$username,$npassword);
                $result = mysqli_query($conn,$query);

                if(!$result) {
                    navigate_to_pages('settings',mysqli_errno($conn));
                } else {
                    successfulReg('settings',"Password Updated successfully!");
                }
            }
        }

    } 
    else {
        navigate_to_pages('settings',"Cannot get username or new password");
        exit();
    }

    mysqli_close($conn);
?>