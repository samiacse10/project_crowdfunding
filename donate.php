<?php
session_start();
include 'db.php';

// Get campaign ID safely
$campaign_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Check login BEFORE including header
if(!isset($_SESSION['user_id'])){
    // Store a flash message in session
    $_SESSION['flash_message'] = "Please login or register first to donate.";
    header("Location: login.php");
    exit();
}

include 'header.php';
?>

<style>
body{
    font-family:Arial, sans-serif;
    background:#f4f6f9;
}

/* Page Title */
h2{
    text-align:center;
    margin-top:40px;
}

/* Donation Box */
.donate-container{
    width:35%;
    margin:50px auto;
    background:white;
    padding:35px;
    border-radius:12px;
    box-shadow:0px 2px 15px rgba(0,0,0,0.1);
    text-align:center;
}

/* Input Field */
.donate-container input{
    width:100%;
    padding:14px;
    margin:15px 0;
    border-radius:6px;
    border:1px solid #ddd;
    font-size:16px;
}

/* Button */
button{
    width:100%;
    padding:14px;
    background:#28a745;
    color:white;
    border:none;
    border-radius:6px;
    font-size:18px;
    cursor:pointer;
    transition:0.3s;
}

button:hover{
    background:#218838;
}
</style>

<h2>Donate to Campaign</h2>

<div class="donate-container">
    <form method="POST" action="payment_process.php">
        <input type="hidden" name="campaign_id" value="<?php echo $campaign_id; ?>">
        <input type="number" name="amount" placeholder="Enter Donation Amount (৳)" required>
        <button type="submit" name="donate">Proceed to Payment</button>
    </form>
</div>

<?php include 'footer.php'; ?>