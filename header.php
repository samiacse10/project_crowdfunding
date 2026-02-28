<?php
if(session_status() == PHP_SESSION_NONE){
    session_start();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Crowdfunding Platform</title>

<!-- Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<style>
body{
    margin:0;
    font-family:'Segoe UI', sans-serif;
    transition: background 0.3s, color 0.3s;
}

/* Sticky Navbar */
nav{
    position:fixed;
    top:0;
    width:100%;
    z-index:1000;
    background:linear-gradient(45deg,#141e30,#243b55);
    padding:12px 30px;
    display:flex;
    justify-content:space-between;
    align-items:center;
    box-shadow:0 5px 15px rgba(0,0,0,0.2);
}

/* Logo */
.logo{
    color:white;
    font-size:20px;
    font-weight:bold;
    text-decoration:none;
}

/* Left & Right containers */
.nav-left, .nav-right{
    display:flex;
    align-items:center;
    gap:15px;
}

/* Links */
.nav-left a, .nav-right a{
    color:white;
    text-decoration:none;
    font-size:15px;
    transition:0.3s;
}

.nav-left a:hover, .nav-right a:hover{
    color:#00c6ff;
}

/* Role Badge */
.role-badge{
    padding:5px 10px;
    border-radius:20px;
    font-size:12px;
    font-weight:bold;
    background:#00c6ff;
    color:#fff;
}

/* Dropdown */
.dropdown, .nav-dropdown{
    position:relative;
}

.dropdown-content{
    display:none;
    position:absolute;
    top:100%;
    left:0;
    background:white;
    min-width:150px;
    box-shadow:0 8px 20px rgba(0,0,0,0.2);
    border-radius:8px;
    overflow:hidden;
    z-index:1000;
}

.dropdown-content a{
    display:block;
    padding:10px;
    color:#333;
    text-decoration:none;
}

.dropdown-content a:hover{
    background:#f1f1f1;
}

.dropdown:hover .dropdown-content,
.nav-dropdown:hover .dropdown-content{
    display:block;
}

/* Mobile */
.menu-toggle{
    display:none;
    color:white;
    font-size:22px;
    cursor:pointer;
}

.mobile-menu{
    display:none;
    position:absolute;
    top:55px;
    right:0;
    width:220px;
    background:#243b55;
    flex-direction:column;
    padding:15px;
    border-radius:0 0 8px 8px;
    z-index:1000;
}

.mobile-menu a{
    color:white;
    padding:10px;
    text-decoration:none;
    display:block;
}

.mobile-menu a:hover{
    background:#00c6ff;
    color:#000;
}

@media(max-width:768px){
    .nav-left, .nav-right{
        display:none;
    }
    .menu-toggle{
        display:block;
    }
}

/* Dark Mode */
body.dark-mode{
    background:#121212;
    color:#eee;
}

body.dark-mode nav{
    background:#1e1e1e;
}

body.dark-mode .nav-left a,
body.dark-mode .nav-right a{
    color:#eee;
}

body.dark-mode .dropdown-content{
    background:#2c2c2c;
}

body.dark-mode .dropdown-content a{
    color:#eee;
}

body.dark-mode .dropdown-content a:hover{
    background:#444;
}

body.dark-mode .role-badge{
    background:#2575fc;
}
</style>

<script>
function toggleDarkMode(){
    document.body.classList.toggle('dark-mode');
    localStorage.setItem('dark-mode', document.body.classList.contains('dark-mode'));
}

function toggleMobileMenu(){
    const menu = document.querySelector(".mobile-menu");
    menu.style.display = (menu.style.display === "flex") ? "none" : "flex";
}

window.addEventListener('DOMContentLoaded', ()=>{
    if(localStorage.getItem('dark-mode') === 'true'){
        document.body.classList.add('dark-mode');
    }
});
</script>
</head>

<body>

<nav>
    <!-- Logo -->
    <a href="index.php" class="logo">
        <i class="fa-solid fa-hand-holding-heart"></i> Crowdfunding
    </a>

    <!-- Left (Donate) -->
    <div class="nav-left">
        <div class="nav-dropdown">
            <a href="#"><i class="fa-solid fa-hand-holding-dollar"></i> Donate <i class="fa-solid fa-caret-down"></i></a>
            <div class="dropdown-content">
                <a href="donate.php">Make Donation</a>
                <a href="browse_campaigns.php">Browse Campaigns</a>
            </div>
        </div>
    </div>

    <!-- Right (User / Login / Dark) -->
    <div class="nav-right">
        <?php if(!isset($_SESSION['role'])){ ?>
            <a href="login.php"><i class="fa-solid fa-right-to-bracket"></i> Login</a>
            <a href="register.php"><i class="fa-solid fa-user-plus"></i> Register</a>
        <?php } else { ?>
            <span class="role-badge"><?php echo ucfirst($_SESSION['role']); ?></span>
            <a href="dashboard.php">Dashboard</a>

            <div class="dropdown">
                <a href="#"><i class="fa-solid fa-user-circle"></i> Profile <i class="fa-solid fa-caret-down"></i></a>
                <div class="dropdown-content">
                    <a href="profile.php">My Profile</a>
                    <a href="settings.php">Settings</a>
                    <a href="logout.php">Logout</a>
                </div>
            </div>
        <?php } ?>
    </div>

    <!-- Dark mode toggle -->
    <i class="fa-solid fa-moon menu-toggle" onclick="toggleDarkMode()"></i>

    <!-- Hamburger -->
    <i class="fa-solid fa-bars menu-toggle" onclick="toggleMobileMenu()"></i>

    <!-- Mobile Menu -->
    <div class="mobile-menu">
        <!-- Left links -->
        <div class="nav-left-mobile">
            <a href="donate.php">Make Donation</a>
            <a href="browse_campaigns.php">Browse Campaigns</a>
        </div>
        <!-- Right links -->
        <div class="nav-right-mobile">
            <?php if(!isset($_SESSION['role'])){ ?>
                <a href="login.php">Login</a>
                <a href="register.php">Register</a>
            <?php } else { ?>
                <a href="dashboard.php">Dashboard</a>
                <a href="profile.php">Profile</a>
                <a href="settings.php">Settings</a>
                <a href="logout.php">Logout</a>
            <?php } ?>
        </div>
    </div>
</nav>

<!-- Push page content below navbar -->
<div style="margin-top:70px;"></div>