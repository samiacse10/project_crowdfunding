<?php
include 'db.php';
include 'header.php';
include 'progress_bar.php';

$user_id = $_SESSION['user_id'];
$result = mysqli_query($conn,"SELECT * FROM campaigns WHERE organizer_id='$user_id'");
?>

<h2>My Campaigns</h2>

<?php while($row=mysqli_fetch_assoc($result)){ ?>
    <div class="campaign-card">
        <h3><?php echo $row['title']; ?> (<?php echo $row['status']; ?>)</h3>

        <p>Target: ৳<?php echo $row['target_amount']; ?></p>
        <p>Raised: ৳<?php echo $row['raised_amount']; ?></p>

        <?php showProgress($row['raised_amount'],$row['target_amount']); ?>

        <a href="edit_campaign.php?id=<?php echo $row['id']; ?>"><button>Edit</button></a>
        <a href="delete_campaign.php?id=<?php echo $row['id']; ?>"><button class="danger">Delete</button></a>
    </div>
<?php } ?>

<?php include 'footer.php'; ?>