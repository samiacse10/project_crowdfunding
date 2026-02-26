<?php
$tran_id = $_GET['tran_id'];

// Simulate gateway processing delay
sleep(2);

<<<<<<< HEAD
// Redirect directly to success page
header("Location: success.php?tran_id=$tran_id");
exit();
?>
=======
$post_data['success_url'] = "http://localhost/crowdfunding/success.php";
$post_data['fail_url'] = "http://localhost/crowdfunding/fail.php";
$post_data['cancel_url'] = "http://localhost/crowdfunding/cancel.php";


$post_data['cus_name'] = "Donor";
$post_data['cus_email'] = "donor@email.com";

$direct_api_url = "https://sandbox.sslcommerz.com/gwprocess/v4/api.php";

$handle = curl_init();
curl_setopt($handle, CURLOPT_URL, $direct_api_url);
curl_setopt($handle, CURLOPT_POST, true);
curl_setopt($handle, CURLOPT_POSTFIELDS, $post_data);
curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);

$content = curl_exec($handle);
$code = curl_getinfo($handle, CURLINFO_HTTP_CODE);

if($code == 200){
    $sslcommerzResponse = json_decode($content, true);
    header("Location: ".$sslcommerzResponse['GatewayPageURL']);
}
?>
>>>>>>> 594c713dabe9d98dc84be454fc62389c8e8263eb
