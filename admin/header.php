<?php
// Start session if not already started
if(session_status() == PHP_SESSION_NONE){
    session_start();
}

// Only allow admin users
if(!isset($_SESSION['role']) || $_SESSION['role'] != 'admin'){
    header("Location: ../login.php"); // redirect to login if not admin
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Admin Panel</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<!-- Bootstrap CSS for quick styling -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<!-- Font Awesome for icons -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<style>
body{
    font-family: Arial, sans-serif;
    background-color: #f4f6f9;
    margin: 0;
}

/* Admin Navbar */
nav.admin-nav{
    background: #007bff;
    color: #fff;
    padding: 12px 20px;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

nav.admin-nav a{
    color: #fff;
    margin-right: 15px;
    text-decoration: none;
    font-weight: 500;
    transition: 0.3s;
}

nav.admin-nav a:hover{
    color: #ffd700;
}

nav.admin-nav .admin-user{
    font-weight: bold;
}

.container{
    padding: 20px;
}
</style>
</head>
<body>

<!-- Admin Navbar -->
<nav class="admin-nav">
    <div class="nav-left">
        <a href="admin_dashboard.php"><i class="fa-solid fa-gauge"></i> Dashboard</a>
        <a href="manage_users.php"><i class="fa-solid fa-users"></i> Users</a>
        <a href="approve_campaign.php"><i class="fa-solid fa-hand-holding-dollar"></i> Pending Campaigns</a>
        <a href="view_all_donations.php"><i class="fa-solid fa-hand-holding-heart"></i> Donations</a>
        <a href="admin_logs.php"><i class="fa-solid fa-file-alt"></i> Logs</a>
    </div>
    <div class="nav-right">
        <span class="admin-user"><i class="fa-solid fa-user-shield"></i> <?=htmlspecialchars($_SESSION['full_name'])?></span>
        <a href="../logout.php"><i class="fa-solid fa-right-from-bracket"></i> Logout</a>
    </div>
</nav>

<div class="container">