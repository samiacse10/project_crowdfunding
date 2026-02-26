<?php
include 'db.php';

if(isset($_GET['tran_id'])){

    $tran_id = $_GET['tran_id'];

    $res = mysqli_query($conn,"SELECT * FROM donations WHERE transaction_id='$tran_id'");
    $donation = mysqli_fetch_assoc($res);

    if($donation && $donation['payment_status'] == 'pending'){

        $donation_id = $donation['id'];
        $campaign_id = $donation['campaign_id'];
        $amount = $donation['amount'];

        // Update donation status
        mysqli_query($conn,"UPDATE donations 
                            SET payment_status='success'
                            WHERE transaction_id='$tran_id'");

        // Insert SSL transaction record (mock)
        mysqli_query($conn,"INSERT INTO sslcommerz_transactions
            (donation_id, tran_id, amount, currency, status, store_amount)
            VALUES
            ('$donation_id','$tran_id','$amount','BDT','VALID','$amount')");

        // Update campaign raised amount
        mysqli_query($conn,"UPDATE campaigns
                            SET raised_amount = raised_amount + $amount
                            WHERE id='$campaign_id'");

        echo "<h2>Payment Successful!</h2>";
        echo "<p>Thank you for your donation ❤️</p>";
    }
    else{
        echo "<h2>Transaction already processed or not found.</h2>";
    }
}
?>