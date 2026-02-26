<?php
include 'db.php';
include 'header.php';

if($_SESSION['role'] != 'admin'){
    header("Location: index.php");
    exit();
}

$sql = "SELECT a.*, u.full_name 
        FROM admin_logs a
        JOIN users u ON a.admin_id = u.id
        ORDER BY a.created_at DESC";

$result = mysqli_query($conn,$sql);
?>

<h2>Admin Logs</h2>

<table border="1">
<tr>
    <th>Admin</th>
    <th>Action</th>
    <th>Date</th>
</tr>

<?php while($row=mysqli_fetch_assoc($result)){ ?>
<tr>
    <td><?php echo $row['full_name']; ?></td>
    <td><?php echo $row['action']; ?></td>
    <td><?php echo $row['created_at']; ?></td>
</tr>
<?php } ?>
</table>

<?php include 'footer.php'; ?>