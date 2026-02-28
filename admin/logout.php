<?php
session_start();
include 'auth.php';

// Destroy all session data
session_unset();
session_destroy();

// Redirect to admin login page
header("Location: login.php");
exit();
?>