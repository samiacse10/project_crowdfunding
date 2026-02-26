<?php
include 'db.php';
include 'header.php';
include 'progress_bar.php';

$sql = "SELECT * FROM campaigns WHERE status='approved'";
$result = mysqli_query($conn,$sql);
?>

<h2>Approved Campaigns</h2>

<div class="campaign-grid">
<?php while($row = mysqli_fetch_assoc($result)) { ?>
    <div class="campaign-card">
        <img src="uploads/<?php echo $row['image']; ?>" width="100%">
        <h3><?php echo $row['title']; ?></h3>

        <p>Target: ৳<?php echo $row['target_amount']; ?></p>
        <p>Raised: ৳<?php echo $row['raised_amount']; ?></p>

        <?php showProgress($row['raised_amount'],$row['target_amount']); ?>

        <a href="campaign_details.php?id=<?php echo $row['id']; ?>">
            <button>View Details</button>
        </a>
    </div>
<?php } ?>
</div>

<?php include 'footer.php'; ?>