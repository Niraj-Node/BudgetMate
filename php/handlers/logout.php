<?php
    include '../functions/navigation.php';
    session_start();
    session_destroy();
    navigate_to_index();
?>