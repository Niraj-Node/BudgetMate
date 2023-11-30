<?php

// Get the current URL
$baseUrl = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https://" : "http://";
$main_dir = '/BudgetMate/';
$baseUrl .= $_SERVER['HTTP_HOST'] . $main_dir;

function navigate_to_index($error = '')
{
    global $baseUrl;
    $errorMessage = addslashes($error);
    $alertMessage = 'Error: ' . $errorMessage;
    
    echo '<script>';
    if ($error) {
        echo "alert('$alertMessage');";
    }
    echo "window.location.href = '$baseUrl';";
    echo '</script>';    
}

function navigate_to_pages($page, $error = '')
{
    global $baseUrl;
    $errorMessage = addslashes($error);
    $alertMessage = 'Error: ' . $errorMessage;
    $path = $baseUrl . "php/pages/$page.php";

    echo '<script>';
    if ($error) {
        echo "alert('$alertMessage');";
    }
    echo "window.location.href = '$path';";
    echo '</script>';
}

function navigate_to_routines($page)
{
    global $baseUrl;
    $path = $baseUrl ;

    echo '<script>window.location.href = "' . $path . '";</script>';
}

function successfulReg($page, $message = '')
{
    global $baseUrl;
    $alertMessage = addslashes($message);
    $path = $baseUrl . "php/pages/$page.php";

    echo '<script>';
    if ($message) {
        echo "alert('$alertMessage');";
    }
    echo "window.location.href = '$path';";
    echo '</script>';
}