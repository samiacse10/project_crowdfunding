<?php
include 'db.php';
include 'header.php';

if($_SESSION['role'] != 'admin'){
    header("Location: index.php");
    exit();
}

$sql = "SELECT d.*, u.full_name, c.title 
        FROM donations d
        JOIN users u ON d.donor_id = u.id
        JOIN campaigns c ON d.campaign_id = c.id";

$result = mysqli_query($conn,$sql);
?>

<h2>All Donations</h2>

<table border="1">
<tr>
    <th>Donor</th>
    <th>Campaign</th>
    <th>Amount</th>
    <th>Status</th>
    <th>Transaction ID</th>
</tr>

<?php while($row=mysqli_fetch_assoc($result)){ ?>
<tr>
    <td><?php echo $row['full_name']; ?></td>
    <td><?php echo $row['title']; ?></td>
    <td><?php echo $row['amount']; ?></td>
    <td><?php echo $row['payment_status']; ?></td>
    <td><?php echo $row['transaction_id']; ?></td>
</tr>
<?php } ?>
</table>

<?php include 'footer.php'; ?>