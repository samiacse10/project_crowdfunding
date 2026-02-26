<?php
include 'db.php';

if(isset($_POST['register'])){

    $name = $_POST['full_name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $phone = $_POST['phone'];
    $role = $_POST['role'];

    $sql = "INSERT INTO users (full_name,email,password,phone,role)
            VALUES ('$name','$email','$password','$phone','$role')";

    if(mysqli_query($conn,$sql)){
        echo "<script>alert('Registration Successful'); window.location='login.php';</script>";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>

<?php include 'header.php'; ?>

<h2>Register</h2>

<form method="POST">
    <input type="text" name="full_name" placeholder="Full Name" required>
    <input type="email" name="email" placeholder="Email" required>
    <input type="text" name="phone" placeholder="Phone">
    <input type="password" name="password" placeholder="Password" required>

    <select name="role">
        <option value="donor">Donor</option>
        <option value="organizer">Organizer</option>
    </select>

    <button type="submit" name="register">Register</button>
</form>

<?php include 'footer.php'; ?>