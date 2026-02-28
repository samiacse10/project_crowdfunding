<?php
session_start();

// Check if user is logged in and is an admin
if(!isset($_SESSION['role']) || $_SESSION['role'] != 'admin'){
    // Not logged in or not admin → redirect to login page
    header("Location: ../login.php");
    exit();
}
?>