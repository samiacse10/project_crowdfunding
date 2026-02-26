<?php
include 'db.php';

$id = $_GET['id'];
mysqli_query($conn,"DELETE FROM campaigns WHERE id='$id'");
header("Location: my_campaigns.php");
?>