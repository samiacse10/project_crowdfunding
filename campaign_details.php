<?php
include 'db.php';
include 'header.php';
include 'progress_bar.php';

$id = $_GET['id'];
$sql = "SELECT * FROM campaigns WHERE id='$id'";
$result = mysqli_query($conn,$sql);
$row = mysqli_fetch_assoc($result);
?>

<h2><?php echo $row['title']; ?></h2>
<img src="uploads/<?php echo $row['image']; ?>" width="400">

<p><?php echo $row['description']; ?></p>
<p>Target: ৳<?php echo $row['target_amount']; ?></p>
<p>Raised: ৳<?php echo $row['raised_amount']; ?></p>

<?php showProgress($row['raised_amount'],$row['target_amount']); ?>

<a href="donate.php?id=<?php echo $row['id']; ?>">
    <button>Donate Now</button>
</a>

<?php include 'footer.php'; ?>