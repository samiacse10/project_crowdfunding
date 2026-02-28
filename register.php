<?php
include 'db.php';
include 'header.php';

$message = "";
$success = false;

// Process form submission
if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $name = mysqli_real_escape_string($conn,$_POST['full_name']);
    $email = mysqli_real_escape_string($conn,$_POST['email']);
    $password = mysqli_real_escape_string($conn,$_POST['password']);
    $phone = mysqli_real_escape_string($conn,$_POST['phone']);
    $role = mysqli_real_escape_string($conn,$_POST['role']);

    // Check duplicate email
    $check = mysqli_query($conn,"SELECT * FROM users WHERE email='$email'");
    if(mysqli_num_rows($check) > 0){
        $message = "Email already registered!";
    } else {
        $hashed_password = password_hash($password,PASSWORD_DEFAULT);
        $sql = "INSERT INTO users (full_name,email,password,phone,role)
                VALUES ('$name','$email','$hashed_password','$phone','$role')";
        if(mysqli_query($conn,$sql)){
            $success = true;
        } else {
            $message = "Error: ".mysqli_error($conn);
        }
    }
}
?>

<!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<!-- Bootstrap Icons -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

<!-- Confetti -->
<script src="https://cdn.jsdelivr.net/npm/canvas-confetti@1.6.0/dist/confetti.browser.min.js"></script>

<style>
body.register-page {
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
.register-container {
    flex: 1;
    display: flex;
    justify-content: center;
    align-items: center;
    padding: 20px;
}
.register-card {
    background: rgba(255,255,255,0.95);
    border-radius: 20px;
    padding: 40px 30px;
    max-width: 450px;
    width: 100%;
    box-shadow: 0 20px 60px rgba(0,0,0,0.3);
    transition: transform 0.5s ease, box-shadow 0.5s ease;
    position: relative;
}
.register-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 30px 80px rgba(0,0,0,0.4);
}
h2 {
    text-align: center;
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
body.dark-mode.register-page {
    background: #121212 !important;
}
body.dark-mode .register-card {
    background: #1e1e1e !important;
    color: #e0e0e0;
    box-shadow: 0 20px 60px rgba(0,0,0,0.7);
}
body.dark-mode .form-control, body.dark-mode .form-select {
    background: #2c2c2c;
    color: #e0e0e0;
    border: 1px solid #555;
}
body.dark-mode label {
    color: #aaa;
}
body.dark-mode button {
    background: linear-gradient(90deg,#2575fc,#6a11cb);
}
</style>

<div class="register-page">
    <div class="register-container">
        <div class="register-card">
            <h2>Register</h2>

            <?php if($message != ""){ ?>
                <div class="alert alert-danger text-center"><?php echo $message; ?></div>
            <?php } ?>

            <?php if($success){ ?>
                <div class="alert alert-success text-center">
                    Registration successful!
                </div>
            <?php } ?>

            <form id="registerForm" method="POST">
                <div class="form-floating mb-3">
                    <input type="text" name="full_name" class="form-control" id="fullName" placeholder="Full Name" required>
                    <label for="fullName">Full Name</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="email" name="email" class="form-control" id="email" placeholder="Email" required>
                    <label for="email">Email</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="text" name="phone" class="form-control" id="phone" placeholder="Phone">
                    <label for="phone">Phone</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="password" name="password" class="form-control" id="password" placeholder="Password" required>
                    <label for="password">Password</label>
                </div>
                <div class="mb-3">
                    <select name="role" class="form-select" required>
                        <option value="" disabled selected>Select Role</option>
                        <option value="donor">Donor</option>
                        <option value="organizer">Organizer</option>
                    </select>
                </div>
                <button type="submit" id="submitBtn" class="btn w-100 py-2">
                    Register <span id="spinner" class="spinner-border spinner-border-sm d-none"></span>
                </button>
            </form>

            <div class="social-login mt-3">
                <button class="btn btn-danger"><i class="bi bi-google"></i> Google</button>
                <button class="btn btn-primary"><i class="bi bi-facebook"></i> Facebook</button>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
// Animated submit button
const form = document.getElementById('registerForm');
const submitBtn = document.getElementById('submitBtn');
const spinner = document.getElementById('spinner');

form.addEventListener('submit', (e)=>{
    spinner.classList.remove('d-none');
    submitBtn.disabled = true;
});

// Confetti effect if registration successful
<?php if($success){ ?>
setTimeout(()=>{
    confetti({
        particleCount: 150,
        spread: 70,
        origin: { y: 0.6 }
    });
},500);
<?php } ?>
</script>

<?php include 'footer.php'; ?>