<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Crowdfunding for Children</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<div class="navbar">
    <a href="index.php">Home</a>

    <?php if(isset($_SESSION['user_id'])) { ?>
        <a href="logout.php">Logout</a>
        <span class="welcome">Welcome, <?php echo $_SESSION['full_name']; ?></span>
    <?php } else { ?>
        <a href="login.php">Login</a>
        <a href="register.php">Register</a>
    <?php } ?>
</div>

<div class="container">