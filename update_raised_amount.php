<?php
include 'db.php';

$campaign_id = $_GET['campaign_id'];
$amount = $_GET['amount'];

mysqli_query($conn,"UPDATE campaigns 
    SET raised_amount = raised_amount + $amount
    WHERE id='$campaign_id'");
?>