<?php
if(session_status() == PHP_SESSION_NONE){
    session_start();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Crowdfunding Platform</title>

<style>
body{
    margin:0;
    font-family:Arial, sans-serif;
}

/* Navigation Bar */
nav{
    background:#007bff;
    padding:15px;
    display:flex;
    justify-content:space-between;
    align-items:center;
    flex-wrap:wrap;
}

/* Navigation Links */
nav a{
    color:white;
    text-decoration:none;
    margin:5px 15px;
    font-size:16px;
    font-weight:bold;
    transition:0.3s;
}

nav a:hover{
    opacity:0.8;
}

/* Right side menu */
.nav-links{
    display:flex;
    align-items:center;
    flex-wrap:wrap;
}
</style>

</head>

<body>

<nav>
    <div>
        <a href="index.php">Crowdfunding Home</a>
    </div>

    <div class="nav-links">

<?php if(!isset($_SESSION['role'])){ ?>

        <a href="login.php">Login</a>
        <a href="register.php">Register</a>

<?php } else { ?>

        <?php if($_SESSION['role'] == 'admin'){ ?>
            <a href="admin_dashboard.php">Dashboard</a>
            <a href="browse_campaigns.php">Browse Campaigns</a>
        <?php } ?>

        <?php if($_SESSION['role'] == 'organizer'){ ?>
            <a href="organizer_dashboard.php">Dashboard</a>
        <?php } ?>

        <?php if($_SESSION['role'] == 'donor'){ ?>
            <a href="donor_dashboard.php">Dashboard</a>
            <a href="browse_campaigns.php">Browse Campaigns</a>
        <?php } ?>

        <a href="logout.php">Logout</a>

<?php } ?>

    </div>
</nav>
<hr>