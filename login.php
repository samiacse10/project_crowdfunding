<?php
session_start();
include 'db.php';

// Flash message from redirect (like from donate.php)
$flash_message = '';
if(isset($_SESSION['flash_message'])){
    $flash_message = $_SESSION['flash_message'];
    unset($_SESSION['flash_message']);
}

// Handle login
$error = '';
if(isset($_POST['login'])){
    $email = mysqli_real_escape_string($conn,$_POST['email']);
    $password = mysqli_real_escape_string($conn,$_POST['password']);

    $sql = "SELECT * FROM users WHERE email='$email'";
    $result = mysqli_query($conn,$sql);

    if(mysqli_num_rows($result) == 1){
        $row = mysqli_fetch_assoc($result);
        if(password_verify($password, $row['password'])){
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['full_name'] = $row['full_name'];
            $_SESSION['role'] = $row['role'];
            header("Location: index.php");
            exit();
        } else {
            $error = "Invalid Email or Password";
        }
    } else {
        $error = "Invalid Email or Password";
    }
}
?>

<?php include 'header.php'; ?>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/canvas-confetti@1.6.0/dist/confetti.browser.min.js"></script>

<style>
body.login-page {
    min-height: 100vh;
    background: linear-gradient(135deg,#6a11cb,#2575fc);
    background-size: 400% 400%;
    animation: gradientBG 15s ease infinite;
    display: flex;
    flex-direction: column;
}
@keyframes gradientBG {
    0% {background-position:0% 50%;}
    50% {background-position:100% 50%;}
    100% {background-position:0% 50%;}
}

.login-container {
    flex: 1;
    display: flex;
    justify-content: center;
    align-items: center;
    padding: 20px;
}

.login-card {
    background: rgba(255,255,255,0.95);
    border-radius: 20px;
    padding: 40px 30px;
    max-width: 400px;
    width: 100%;
    box-shadow: 0 20px 60px rgba(0,0,0,0.3);
    transition: transform 0.5s ease, box-shadow 0.5s ease;
    text-align: center;
}
.login-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 30px 80px rgba(0,0,0,0.4);
}

.login-card h2 {
    margin-bottom: 25px;
    color: #2575fc;
    font-weight: 700;
}

.form-floating>.form-control:focus~label,
.form-floating>.form-control:not(:placeholder-shown)~label {
    transform: scale(0.85) translateY(-1.5rem);
    color: #6a11cb;
}

button {
    background: linear-gradient(90deg,#6a11cb,#2575fc);
    border: none;
    font-weight: bold;
    font-size: 16px;
    border-radius: 10px;
    transition: all 0.3s ease;
}
button:hover {
    transform: translateY(-2px);
    box-shadow: 0 10px 25px rgba(0,0,0,0.3);
}

.social-login {
    display: flex;
    gap: 15px;
    margin-top: 20px;
}
.social-login button {
    flex: 1;
    display: flex;
    justify-content: center;
    align-items: center;
}

.spinner-border {
    width: 1.2rem;
    height: 1.2rem;
    margin-left: 10px;
}

.dark-toggle {
    position: fixed;
    top: 15px;
    right: 15px;
    cursor: pointer;
    font-size: 18px;
    z-index: 1000;
    color: #fff;
}

/* Dark mode overrides */
body.dark-mode.login-page {
    background: #121212 !important;
}
body.dark-mode .login-card {
    background: #1e1e1e !important;
    color: #e0e0e0;
    box-shadow: 0 20px 60px rgba(0,0,0,0.7);
}
body.dark-mode .form-control, body.dark-mode .form-select {
    background: #2c2c2c;
    color: #e0e0e0;
    border: 1px solid #555;
}
body.dark-mode label { color: #aaa; }
body.dark-mode button { background: linear-gradient(90deg,#2575fc,#6a11cb); }
</style>

<div class="login-page">
    <div class="login-container">
        <div class="login-card">
            <h2>Login</h2>

            <?php if($flash_message){ ?>
                <div class="alert alert-warning"><?php echo $flash_message; ?></div>
            <?php } ?>

            <?php if($error){ ?>
                <div class="alert alert-danger"><?php echo $error; ?></div>
            <?php } ?>

            <form id="loginForm" method="POST">
                <div class="form-floating mb-3">
                    <input type="email" name="email" class="form-control" id="email" placeholder="Email" required>
                    <label for="email">Email</label>
                </div>

                <div class="form-floating mb-3">
                    <input type="password" name="password" class="form-control" id="password" placeholder="Password" required>
                    <label for="password">Password</label>
                </div>

                <button type="submit" name="login" class="btn w-100 py-2" id="submitBtn">
                    Login <span id="spinner" class="spinner-border spinner-border-sm d-none"></span>
                </button>
            </form>

            <div class="social-login mt-3">
                <button class="btn btn-danger"><i class="bi bi-google"></i> Google</button>
                <button class="btn btn-primary"><i class="bi bi-facebook"></i> Facebook</button>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
// Animated submit button
const form = document.getElementById('loginForm');
const submitBtn = document.getElementById('submitBtn');
const spinner = document.getElementById('spinner');

form.addEventListener('submit', (e)=>{
    spinner.classList.remove('d-none');
    submitBtn.disabled = true;
});
</script>

<?php include 'footer.php'; ?>