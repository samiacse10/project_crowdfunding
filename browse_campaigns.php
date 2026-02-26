<?php
session_start();
include 'db.php';
include 'header.php';
include 'progress_bar.php';

/* No role restriction — all logged users can browse campaigns */
if(!isset($_SESSION['role'])){
    header("Location: login.php");
    exit();
}

/* Fetch only approved campaigns */
$sql = "SELECT * FROM campaigns WHERE status='approved'";
$result = mysqli_query($conn,$sql);
?>

<style>
body{
    font-family: Arial, sans-serif;
    background:#f4f6f9;
    margin:0;
    padding:0;
}

h2{
    text-align:center;
    margin-top:25px;
    color:#333;
}

/* Campaign Grid */
.campaign-grid{
    display:grid;
    grid-template-columns: repeat(auto-fit, minmax(280px,1fr));
    gap:25px;
    padding:30px;
}

/* Campaign Card */
.campaign-card{
    background:white;
    padding:18px;
    border-radius:12px;
    box-shadow:0px 2px 12px rgba(0,0,0,0.1);
    transition:0.3s ease;
}

.campaign-card:hover{
    transform:translateY(-6px);
}

.campaign-card img{
    width:100%;
    height:180px;
    object-fit:cover;
    border-radius:10px;
}

.campaign-card h3{
    margin:12px 0;
}

.campaign-card p{
    color:#555;
    margin:6px 0;
}

/* View Button */
.view-btn{
    display:block;
    text-align:center;
    background:#28a745;
    color:white;
    padding:12px;
    border-radius:8px;
    text-decoration:none;
    margin-top:12px;
    font-weight:bold;
    transition:0.3s;
}

.view-btn:hover{
    background:#218838;
}
</style>

<h2>Browse Campaigns</h2>

<div class="campaign-grid">

<?php while($row = mysqli_fetch_assoc($result)) { ?>

    <div class="campaign-card">

        <img src="uploads/<?php echo $row['image']; ?>">

        <h3><?php echo $row['title']; ?></h3>

        <p><strong>Target:</strong> ৳<?php echo $row['target_amount']; ?></p>
        <p><strong>Raised:</strong> ৳<?php echo $row['raised_amount']; ?></p>

        <?php showProgress($row['raised_amount'],$row['target_amount']); ?>

        <a class="view-btn" href="campaign_details.php?id=<?php echo $row['id']; ?>">
            View Details
        </a>

    </div>

<?php } ?>

</div>

<?php include 'footer.php'; ?>