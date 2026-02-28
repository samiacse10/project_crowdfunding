<?php
session_start();
include '../db.php'; // Database connection

// Only allow admins BEFORE sending any output
if(!isset($_SESSION['role']) || $_SESSION['role'] != 'admin'){
    header("Location: ../login.php"); // redirect non-admin users
    exit();
}

// Delete user
if(isset($_GET['delete'])){
    $id = intval($_GET['delete']); // sanitize input
    mysqli_query($conn,"DELETE FROM users WHERE id='$id'");
    header("Location: manage_users.php");
    exit();
}

// Fetch all users
$result = mysqli_query($conn,"SELECT * FROM users ORDER BY id ASC");

// Include header AFTER all redirects
include '../header.php';
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

/* Table Design */
table{
    width:100%;
    border-collapse:collapse;
    background:white;
    border-radius:10px;
    overflow:hidden;
    box-shadow:0px 2px 10px rgba(0,0,0,0.1);
}

th{
    background:#007bff;
    color:white;
    padding:12px;
}

td{
    padding:12px;
    text-align:center;
    border-bottom:1px solid #eee;
}

tr:hover{
    background:#f1f5ff;
}

/* Delete Button */
button{
    background:#dc3545;
    color:white;
    border:none;
    padding:8px 14px;
    border-radius:6px;
    cursor:pointer;
    transition:0.3s;
}

button:hover{
    background:#c82333;
}
</style>

<h2>Manage Users</h2>

<div class="table-container">
<table>
<tr>
    <th>ID</th>
    <th>Name</th>
    <th>Email</th>
    <th>Role</th>
    <th>Action</th>
</tr>

<?php if(mysqli_num_rows($result) > 0): ?>
    <?php while($row=mysqli_fetch_assoc($result)): ?>
<tr>
    <td><?php echo $row['id']; ?></td>
    <td><?php echo htmlspecialchars($row['full_name']); ?></td>
    <td><?php echo htmlspecialchars($row['email']); ?></td>
    <td><?php echo ucfirst(htmlspecialchars($row['role'])); ?></td>
    <td>
        <?php if($row['role'] != 'admin'): ?>
        <a href="?delete=<?php echo $row['id']; ?>" 
           onclick="return confirm('Are you sure you want to delete this user?');">
            <button>Delete</button>
        </a>
        <?php else: ?>
            <span style="color:gray;">Protected</span>
        <?php endif; ?>
    </td>
</tr>
    <?php endwhile; ?>
<?php else: ?>
<tr>
    <td colspan="5" style="text-align:center;">No users found.</td>
</tr>
<?php endif; ?>

</table>
</div>

<?php include '../footer.php'; ?>