<?php
include 'db.php';
include 'header.php';

if($_SESSION['role'] != 'admin'){
    header("Location: index.php");
    exit();
}

if(isset($_GET['delete'])){
    $id = $_GET['delete'];
    mysqli_query($conn,"DELETE FROM users WHERE id='$id'");
}

$result = mysqli_query($conn,"SELECT * FROM users");
?>

<h2>Manage Users</h2>

<table border="1">
<tr>
    <th>ID</th>
    <th>Name</th>
    <th>Email</th>
    <th>Role</th>
    <th>Action</th>
</tr>

<?php while($row=mysqli_fetch_assoc($result)){ ?>
<tr>
    <td><?php echo $row['id']; ?></td>
    <td><?php echo $row['full_name']; ?></td>
    <td><?php echo $row['email']; ?></td>
    <td><?php echo $row['role']; ?></td>
    <td>
        <a href="?delete=<?php echo $row['id']; ?>">
            <button class="danger">Delete</button>
        </a>
    </td>
</tr>
<?php } ?>
</table>

<?php include 'footer.php'; ?>