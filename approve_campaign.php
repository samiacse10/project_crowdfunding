<?php
include 'db.php';
include 'header.php';
include 'progress_bar.php';

if($_SESSION['role'] != 'admin'){
    header("Location: index.php");
    exit();
}

if(isset($_GET['approve'])){
    $id = $_GET['approve'];
    mysqli_query($conn,"UPDATE campaigns SET status='approved' WHERE id='$id'");
}

if(isset($_GET['reject'])){
    $id = $_GET['reject'];
    mysqli_query($conn,"UPDATE campaigns SET status='rejected' WHERE id='$id'");
}

$result = mysqli_query($conn,"SELECT * FROM campaigns WHERE status='pending'");
?>

<h2>Pending Campaigns</h2>

<?php while($row=mysqli_fetch_assoc($result)){ ?>
    <div class="campaign-card">
        <h3><?php echo $row['title']; ?></h3>

        <p>Target: ৳<?php echo $row['target_amount']; ?></p>
        <p>Raised: ৳<?php echo $row['raised_amount']; ?></p>

        <?php showProgress($row['raised_amount'],$row['target_amount']); ?>

        <a href="?approve=<?php echo $row['id']; ?>"><button>Approve</button></a>
        <a href="?reject=<?php echo $row['id']; ?>"><button class="danger">Reject</button></a>
    </div>
<?php } ?>

<?php include 'footer.php'; ?>