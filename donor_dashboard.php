<?php
include 'db.php';
include 'header.php';

$user_id = $_SESSION['user_id'];

$sql = "SELECT * FROM donations WHERE donor_id='$user_id'";
$result = mysqli_query($conn,$sql);
?>

<h2>My Donations</h2>

<table border="1">
<tr>
    <th>Transaction ID</th>
    <th>Amount</th>
    <th>Status</th>
</tr>

<?php while($row=mysqli_fetch_assoc($result)) { ?>
<tr>
    <td><?php echo $row['transaction_id']; ?></td>
    <td><?php echo $row['amount']; ?></td>
    <td><?php echo $row['payment_status']; ?></td>
</tr>
<?php } ?>
</table>

<?php include 'footer.php'; ?>