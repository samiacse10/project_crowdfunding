<?php
include 'db.php';
session_start();

if(isset($_POST['donate'])){

    $campaign_id = intval($_POST['campaign_id']);
    $amount = floatval($_POST['amount']);
    $donor_id = $_SESSION['user_id'];
    $tran_id = uniqid("TXN_");

    mysqli_query($conn,"INSERT INTO donations 
        (campaign_id, donor_id, amount, transaction_id, payment_status, payment_method)
        VALUES 
        ('$campaign_id','$donor_id','$amount','$tran_id','pending','SSLCommerz')");

    header("Location: sslcommerz_init.php?tran_id=$tran_id");
    exit();
}
?>