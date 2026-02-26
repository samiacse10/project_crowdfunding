<?php
include 'db.php';
include 'header.php';
include 'progress_bar.php';

if($_SESSION['role'] != 'admin'){
    header("Location: index.php");
    exit();
}

$result = mysqli_query($conn,"SELECT * FROM campaigns");
?>

<h2>Admin Dashboard</h2>

<div class="admin-menu">
    <a href="approve_campaign.php"><button>Pending Campaigns</button></a>
    <a href="manage_users.php"><button>Manage Users</button></a>
    <a href="view_all_donations.php"><button>View Donations</button></a>
    <a href="admin_logs.php"><button>Admin Logs</button></a>
</div>

<h3>All Campaign Overview</h3>

<?php while($row=mysqli_fetch_assoc($result)){ ?>
    <div class="campaign-card">
        <h4><?php echo $row['title']; ?> (<?php echo $row['status']; ?>)</h4>
        <p>Target: ৳<?php echo $row['target_amount']; ?></p>
        <p>Raised: ৳<?php echo $row['raised_amount']; ?></p>

        <?php showProgress($row['raised_amount'],$row['target_amount']); ?>
    </div>
<?php } ?>

<?php include 'footer.php'; ?>