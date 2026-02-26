<?php
include 'db.php';

if(isset($_GET['tran_id'])){
    $tran_id = $_GET['tran_id'];

    mysqli_query($conn,"UPDATE donations 
                        SET payment_status='failed'
                        WHERE transaction_id='$tran_id'");
}

echo "<h2>Payment Failed!</h2>";
?>