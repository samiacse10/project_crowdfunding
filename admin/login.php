<?php
session_start();
include 'auth.php';
include '../db.php'; // adjust path if needed

// Redirect if already logged in as admin
if(isset($_SESSION['role']) && $_SESSION['role'] == 'admin'){
    header("Location: admin_dashboard.php");
    exit();
}

$error = "";

if(isset($_POST['login'])){
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = $_POST['password'];

    $query = "SELECT * FROM users WHERE email='$email' AND role='admin' LIMIT 1";
    $result = mysqli_query($conn, $query);

    if(mysqli_num_rows($result) == 1){
        $user = mysqli_fetch_assoc($result);
        // For now, plain password check (replace with password_hash in production)
        if($user['password'] === $password){
            $_SESSION['role'] = 'admin';
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['full_name'] = $user['full_name'];
            header("Location: admin_dashboard.php");
            exit();
        } else {
            $error = "Invalid password!";
        }
    } else {
        $error = "Admin not found!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Admin Login</title>
<style>
body { font-family: Arial; background:#f4f6f9; }
.login-container { width: 350px; margin: 100px auto; background: white; padding: 30px; border-radius:10px; box-shadow:0 2px 10px rgba(0,0,0,0.1); }
h2 { text-align:center; margin-bottom:20px; }
input { width:100%; padding:10px; margin:10px 0; border-radius:5px; border:1px solid #ccc; }
button { width:100%; padding:10px; background:#007bff; color:white; border:none; border-radius:5px; cursor:pointer; }
button:hover { background:#0056b3; }
.error { color:red; text-align:center; }
</style>
</head>
<body>

<div class="login-container">
    <h2>Admin Login</h2>
    <?php if($error != "") { echo "<p class='error'>$error</p>"; } ?>
    <form method="post">
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit" name="login">Login</button>
    </form>
</div>

</body>
</html>