<?php
session_start(); 
include 'auth.php'; // start session
include '../db.php';       // db.php is in parent folder
include '../header.php';   // header.php is in parent folder

// Only allow admins
if(!isset($_SESSION['role']) || $_SESSION['role'] != 'admin'){
    header("Location: login.php"); // redirect non-admin users to login
    exit();
}

// Fetch admin logs with admin names
$sql = "SELECT a.*, u.full_name 
        FROM admin_logs a
        JOIN users u ON a.admin_id = u.id
        ORDER BY a.created_at DESC";

$result = mysqli_query($conn,$sql);
?>

<style>
body{
    font-family:Arial, sans-serif;
    background:#f4f6f9;
}

/* Title */
h2{
    text-align:center;
    margin-top:20px;
}

/* Table Container */
.table-container{
    width:90%;
    margin:30px auto;
    overflow-x:auto;
}

/* Table Styling */
table{
    width:100%;
    border-collapse:collapse;
    background:white;
    border-radius:10px;
    overflow:hidden;
    box-shadow:0px 2px 10px rgba(0,0,0,0.1);
}

th{
    background:#343a40;
    color:white;
    padding:12px;
}

td{
    padding:12px;
    text-align:center;
    border-bottom:1px solid #eee;
}

/* Hover Effect */
tr:hover{
    background:#f1f5ff;
}

/* Date Column */
td:nth-child(3){
    color:#555;
}
</style>

<h2>Admin Logs</h2>

<div class="table-container">
<table>
<tr>
    <th>Admin</th>
    <th>Action</th>
    <th>Date</th>
</tr>

<?php if(mysqli_num_rows($result) > 0): ?>
    <?php while($row = mysqli_fetch_assoc($result)): ?>
<tr>
    <td><?php echo htmlspecialchars($row['full_name']); ?></td>
    <td><?php echo htmlspecialchars($row['action']); ?></td>
    <td><?php echo $row['created_at']; ?></td>
</tr>
    <?php endwhile; ?>
<?php else: ?>
<tr>
    <td colspan="3" style="text-align:center;">No logs found.</td>
</tr>
<?php endif; ?>

</table>
</div>

<?php include '../footer.php'; ?>