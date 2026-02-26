<?php
include 'db.php';
include 'header.php';

$id = $_GET['id'];

if(isset($_POST['update'])){
    $title = $_POST['title'];
    mysqli_query($conn,"UPDATE campaigns SET title='$title' WHERE id='$id'");
}

$row = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM campaigns WHERE id='$id'"));
?>

<form method="POST">
<input type="text" name="title" value="<?php echo $row['title']; ?>">
<button name="update">Update</button>
</form>

<?php include 'footer.php'; ?>