<?php

session_start();

function requireLogin()
{
    if (!isset($_SESSION['admin_id'])) {
        header("Location: index.php");
        exit;
    }
}

?>