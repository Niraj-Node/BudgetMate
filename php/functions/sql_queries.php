<?php

// Account Manipulation queries
function insert_username($conn, $username, $pass, int $currency)
{
    $stripped_username = stripcslashes($username);
    $stripped_pass = stripcslashes($pass);
    $mysql_username = mysqli_real_escape_string($conn, $stripped_username);
    $mysql_pass = mysqli_real_escape_string($conn, $stripped_pass);
    $mysql_currency = mysqli_real_escape_string($conn, "" . $currency);
    $hashed_pass = password_hash($mysql_pass, PASSWORD_DEFAULT);
    return "INSERT INTO `user`(`username`, `hash_pwd`, `currency_default`) VALUES ('$mysql_username','$hashed_pass',$mysql_currency)";
}
function update_password($conn, $username, $npassword)
{
    $stripped_username = stripcslashes($username);
    $stripped_pass = stripcslashes($npassword);
    $mysql_username = mysqli_real_escape_string($conn, $stripped_username);
    $mysql_pass = mysqli_real_escape_string($conn, $stripped_pass);
    $hashed_pass = password_hash($mysql_pass, PASSWORD_DEFAULT);
    return "UPDATE user SET hash_pwd='$hashed_pass' WHERE username='$mysql_username'";
}
function delete_account_1($conn, $user_id)
{
    $mysql_user_id = mysqli_real_escape_string($conn, $user_id);
    return "DELETE FROM log WHERE user_id='$mysql_user_id'";
}
function delete_account_2($conn, $username)
{
    $stripped_username = stripcslashes($username);
    $mysql_username = mysqli_real_escape_string($conn, $stripped_username);
    return "DELETE FROM user WHERE username='$mysql_username'";
}
function delete_data_1($conn, $user_id)
{
    $mysql_user_id = mysqli_real_escape_string($conn, $user_id);
    return "DELETE FROM log WHERE user_id='$mysql_user_id'";
}
function delete_data_2($conn, $username)
{
    $stripped_username = stripcslashes($username);
    $mysql_username = mysqli_real_escape_string($conn, $stripped_username);
    return "UPDATE user SET bank_bal=0, cash_bal=0 WHERE username='$mysql_username'";
}

// User table queries
function get_user_details($conn, $username)
{
    $stripped_username = stripcslashes($username);
    $mysql_username = mysqli_real_escape_string($conn, $stripped_username);
    return "SELECT * FROM user WHERE username='$mysql_username'";
}
function get_user_currency($conn, $username)
{
    $stripped_username = stripcslashes($username);
    $mysql_username = mysqli_real_escape_string($conn, $stripped_username);
    return "SELECT currency_default FROM user WHERE username='$mysql_username'";
}
function get_user_total_balance($conn, $username)
{
    $stripped_username = stripcslashes($username);
    $mysql_username = mysqli_real_escape_string($conn, $stripped_username);

    $query = "SELECT (cash_bal + bank_bal) AS total_balance 
              FROM user 
              WHERE username='$mysql_username'";

    return $query;
}
function get_user_balances($conn, $username)
{
    $stripped_username = stripcslashes($username);
    $mysql_username = mysqli_real_escape_string($conn, $stripped_username);
    return "SELECT bank_bal, cash_bal FROM user WHERE username='$mysql_username'";
}
function update_user_bal($conn, $username, int $account, int $balance_after)
{
    $stripped_username = stripcslashes($username);
    $mysql_username = mysqli_real_escape_string($conn, $stripped_username);
    $mysql_account = mysqli_real_escape_string($conn, $account);
    $mysql_amount = mysqli_real_escape_string($conn, $balance_after);
    $query='';
    switch ($mysql_account) 
    {
        case 1:
            $query = "UPDATE user SET cash_bal=$mysql_amount WHERE username='$mysql_username'";
            break;
        case 2:
            $query = "UPDATE user SET bank_bal=$mysql_amount WHERE username='$mysql_username'";
            break;
    }
    return $query;
}
function update_user_bal_after_del($conn, $username, int $account, int $balance_after, int $const_bal)
{
    $stripped_username = stripcslashes($username);
    $mysql_username = mysqli_real_escape_string($conn, $stripped_username);
    $mysql_account = mysqli_real_escape_string($conn, $account);
    $mysql_amount = mysqli_real_escape_string($conn, $balance_after);
    $mysql_cons_amount = mysqli_real_escape_string($conn, $const_bal);
    $query='';
    switch ($mysql_account) 
    {
        case 1:
            $query = "UPDATE user SET cash_bal=$mysql_amount, bank_bal=$mysql_cons_amount WHERE username='$mysql_username'";
            break;
        case 2:
            $query = "UPDATE user SET bank_bal=$mysql_amount, cash_bal=$mysql_cons_amount WHERE username='$mysql_username'";
            break;
    }
    return $query;
}


// log table queries
function get_total_balance_graph_data($conn, $user_id)
{
    return "SELECT (balance_after + other_balance) AS total_balance, log_date FROM log WHERE user_id=$user_id ORDER BY log_date ASC;";
}
function get_cash_balance_graph_data($conn, $user_id) 
{
    return "SELECT balance_after, log_date FROM log WHERE (user_id=$user_id AND account=1) ORDER BY log_date ASC;";
}

function get_bank_balance_graph_data($conn, $user_id) 
{
    return "SELECT balance_after, log_date FROM log WHERE (user_id=$user_id AND account=2) ORDER BY log_date ASC;";
}
function add_to_log($conn,int $user_id, int $account, int $type, int $amount, $description, int $new_balance_before, int $new_balance_after, int $const_bal)
{
    $mysql_user_id = mysqli_real_escape_string($conn, $user_id);
    $mysql_account = mysqli_real_escape_string($conn, $account);
    $mysql_type = mysqli_real_escape_string($conn, $type);
    $mysql_amount = mysqli_real_escape_string($conn, $amount);
    $stripped_desc = stripcslashes($description);
    $mysql_desc = mysqli_real_escape_string($conn, $stripped_desc);
    $mysql_balance_before = mysqli_real_escape_string($conn, $new_balance_before);
    $mysql_balance_after = mysqli_real_escape_string($conn, $new_balance_after);
    $mysql_const_bal = mysqli_real_escape_string($conn, $const_bal);
    $sql = "INSERT INTO log(user_id,type,account,amount,description,balance_affected,balance_after,other_balance) VALUES ('$mysql_user_id',$mysql_type,$mysql_account,$mysql_amount,'$mysql_desc',$mysql_balance_before,$mysql_balance_after,$mysql_const_bal)";
    return $sql;
}
function get_all_logs($conn, $user_id)
{
    $mysql_user_id = mysqli_real_escape_string($conn, $user_id);
    return "SELECT * FROM log WHERE user_id=$mysql_user_id ORDER BY log_date DESC";
}
function update_description($conn, int $logId, $description)
{
    $stripped_logId = stripcslashes($logId);
    $mysql_logId = mysqli_real_escape_string($conn, $stripped_logId);
    $stripped_description = stripcslashes($description);
    $mysql_description = mysqli_real_escape_string($conn, $stripped_description);
    return "UPDATE log SET description='$mysql_description' WHERE id=$mysql_logId";
}
function del_logs_FROM($conn, $logDate, $user_id)
{
    $mysql_user_id = mysqli_real_escape_string($conn, $user_id);
    $stripped_logDate = stripcslashes($logDate);
    $mysql_logDate = mysqli_real_escape_string($conn, $stripped_logDate);
    return "DELETE FROM log WHERE (log_date >= '$mysql_logDate' AND user_id=$mysql_user_id)";
}
function get_latest_log($conn, $user_id)
{
    $mysql_user_id = mysqli_real_escape_string($conn, $user_id);
    return "SELECT * FROM log WHERE user_id = '$mysql_user_id' ORDER BY log_date DESC LIMIT 1";
}