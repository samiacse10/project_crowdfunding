<?php
session_start();
include 'db.php';
include 'header.php';
include 'progress_bar.php';

// Redirect logged-in users to their dashboards
if(isset($_SESSION['role'])){
    if($_SESSION['role'] == 'admin'){ header("Location: admin_dashboard.php"); exit();}
    if($_SESSION['role'] == 'organizer'){ header("Location: organizer_dashboard.php"); exit();}
    if($_SESSION['role'] == 'donor'){ header("Location: donor_dashboard.php"); exit();}
}

// Fetch approved campaigns
$campaign_sql = "SELECT * FROM campaigns WHERE status='approved'";
$campaign_result = mysqli_query($conn,$campaign_sql);

// Fetch latest 4 news
$news_sql = "SELECT * FROM news ORDER BY created_at DESC LIMIT 4";
$news_result = mysqli_query($conn,$news_sql);
?>

<style>
body{
    font-family: 'Segoe UI', sans-serif;
    margin:0;
    padding:0;
    background:#f4f6f9;
}

/* Hero Banner */
.hero{
    background:linear-gradient(135deg,#007bb0,#00c6ff);
    color:white;
    text-align:center;
    padding:80px 20px 50px 20px;
}

.hero h1{
    font-size:42px;
    margin-bottom:20px;
}

.hero p{
    font-size:18px;
    max-width:600px;
    margin:0 auto;
}

/* Campaign Grid */
.campaign-grid{
    display:grid;
    grid-template-columns: repeat(auto-fit,minmax(280px,1fr));
    gap:25px;
    padding:30px;
}

.campaign-card{
    background:linear-gradient(145deg,#ffffff,#e6f2ff);
    padding:20px;
    border-radius:15px;
    box-shadow:0 10px 25px rgba(0,0,0,0.1);
    transition:0.3s;
    display:flex;
    flex-direction:column;
}

.campaign-card:hover{
    transform:translateY(-10px);
    box-shadow:0 15px 30px rgba(0,0,0,0.15);
}

.campaign-card img{
    border-radius:10px;
    height:180px;
    object-fit:cover;
    transition:0.3s;
}

.campaign-card img:hover{
    transform:scale(1.05);
}

.campaign-card h3{
    margin:15px 0 10px 0;
    font-size:20px;
    color:#007bff;
}

.campaign-card p{
    color:#555;
    font-weight:500;
    margin:3px 0;
}

button{
    background:linear-gradient(90deg,#28a745,#218838);
    color:white;
    border:none;
    padding:12px 15px;
    border-radius:8px;
    cursor:pointer;
    width:100%;
    font-size:16px;
    font-weight:bold;
    margin-top:auto;
    transition:0.3s;
}

button:hover{
    background:linear-gradient(90deg,#218838,#1e7e34);
}

/* Progress Bar */
.progress-container{
    background:#ddd;
    border-radius:20px;
    overflow:hidden;
    height:12px;
    margin:10px 0 15px 0;
}

.progress-bar{
    height:100%;
    background:#28a745;
    width:0%;
    border-radius:20px;
    transition:width 1s ease-in-out;
}

/* News Section */
.news-grid{
    display:grid;
    grid-template-columns: repeat(auto-fit,minmax(250px,1fr));
    gap:20px;
    padding:20px;
}

.news-card{
    background:white;
    border-radius:12px;
    box-shadow:0 5px 15px rgba(0,0,0,0.1);
    overflow:hidden;
    transition:0.3s;
}

.news-card img{
    width:100%;
    height:150px;
    object-fit:cover;
}

.news-card h3{
    font-size:18px;
    color:#007bff;
    margin:10px 15px 5px 15px;
}

.news-card p{
    font-size:14px;
    color:#555;
    margin:0 15px 10px 15px;
}

.news-card a{
    text-decoration:none;
    color:#28a745;
    font-weight:bold;
    margin:0 15px 10px 15px;
    display:block;
}

.news-card:hover{
    transform:translateY(-5px);
    box-shadow:0 10px 25px rgba(0,0,0,0.15);
}

/* About / Info Links */
.info-links{
    display:flex;
    flex-wrap:wrap;
    justify-content:center;
    gap:20px;
    padding:30px 0;
    text-align:center;
}

.info-links a{
    color:#007bff;
    text-decoration:none;
    font-weight:bold;
}

.info-links a:hover{
    color:#00c6ff;
}
</style>

<!-- Hero Section -->
<div class="hero">
    <h1>Support Underprivileged Children</h1>
    <p>Join our crowdfunding platform to help children in need. Start a campaign, donate, or spread awareness.</p>
    <a href="donate.php"><button style="max-width:200px; margin-top:20px;">Donate Now</button></a>
</div>

<!-- Approved Campaigns -->
<h2 style="text-align:center; margin-top:40px;">Approved Campaigns</h2>
<div class="campaign-grid">
<?php while($row = mysqli_fetch_assoc($campaign_result)) { 
    $percent = ($row['target_amount']>0) ? round(($row['raised_amount']/$row['target_amount'])*100) : 0;
?>
    <div class="campaign-card">
        <img src="uploads/<?php echo $row['image']; ?>" alt="<?php echo $row['title']; ?>">
        <h3><?php echo $row['title']; ?></h3>

        <p>Target: ৳<?php echo number_format($row['target_amount']); ?></p>
        <p>Raised: ৳<?php echo number_format($row['raised_amount']); ?></p>

        <div class="progress-container">
            <div class="progress-bar" style="width: <?php echo $percent; ?>%;"></div>
        </div>

        <a href="campaign_details.php?id=<?php echo $row['id']; ?>">
            <button>View Details</button>
        </a>
    </div>
<?php } ?>
</div>

<!-- Recent News -->
<h2 style="text-align:center; margin-top:40px;">Recent Updates</h2>
<div class="news-grid">
<?php while($news = mysqli_fetch_assoc($news_result)) { ?>
    <div class="news-card">
        <img src="uploads/<?php echo $news['image']; ?>" alt="<?php echo $news['title']; ?>">
        <h3><?php echo $news['title']; ?></h3>
        <p><?php echo substr($news['description'],0,100); ?>...</p>
        <a href="news_details.php?id=<?php echo $news['id']; ?>">Read More</a>
    </div>
<?php } ?>
</div>

<!-- Info Links -->
<div class="info-links">
    <a href="about.php">About This Website</a>
    <a href="history.php">Our History</a>
    <a href="recent_works.php">Recent Works</a>
</div>

<script>
// Animate progress bars
document.querySelectorAll('.progress-bar').forEach(bar=>{
    const width = bar.style.width;
    bar.style.width = '0%';
    setTimeout(()=>{ bar.style.width = width; },100);
});
</script>

<?php include 'footer.php'; ?>