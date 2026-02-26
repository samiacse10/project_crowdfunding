<?php
include 'db.php';
include 'header.php';
session_start();

if(!isset($_SESSION['user_id'])){
    header("Location: login.php");
    exit();
}

$campaign_id = intval($_GET['id']);
?>

<h2>Donate</h2>

<form method="POST" action="payment_process.php">
    <input type="hidden" name="campaign_id" value="<?php echo $campaign_id; ?>">
    <input type="number" name="amount" placeholder="Enter Amount" required>
    <button type="submit" name="donate">Proceed to Payment</button>
</form>

<?php include 'footer.php'; ?>