<?php
include 'db.php';
$socialQuery = mysqli_query($conn,"SELECT * FROM social_links");
?>

<div class="footer">

    <div class="footer-container">

        <!-- Column 1 -->
        <div class="footer-col">
            <h3>About Us</h3>
            <p>
                We help underprivileged children by raising funds 
                through trusted and verified campaigns.
            </p>
        </div>

        <!-- Column 2 -->
        <div class="footer-col">
            <h3>Quick Links</h3>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="login.php">Login</a></li>
                <li><a href="register.php">Register</a></li>
                <li><a href="contact.php">Contact</a></li>
            </ul>
        </div>

        <!-- Column 3 -->
        <div class="footer-col">
            <h3>Contact</h3>
            <p>Email: support@crowdfunding.com</p>
            <p>Phone: +880 1234-567890</p>
            <p>Location: Bangladesh</p>
        </div>

        <!-- Column 4 -->
        <div class="footer-col">
            <h3>Follow Us</h3>
            <div class="social-icons">
                <?php while($row = mysqli_fetch_assoc($socialQuery)) { ?>
                    
                    <?php
                        $icon = "";
                        if($row['platform'] == 'facebook') $icon = "fab fa-facebook-f";
                        if($row['platform'] == 'twitter') $icon = "fab fa-twitter";
                        if($row['platform'] == 'youtube') $icon = "fab fa-youtube";
                        if($row['platform'] == 'instagram') $icon = "fab fa-instagram";
                    ?>

                    <a href="<?php echo $row['url']; ?>" target="_blank">
                        <i class="<?php echo $icon; ?>"></i>
                    </a>

                <?php } ?>
            </div>

            <!-- Newsletter -->
            <form method="POST" action="subscribe.php" class="newsletter">
                <input type="email" name="email" placeholder="Enter your email" required>
                <button type="submit">Subscribe</button>
            </form>
        </div>

    </div>

    <div class="footer-bottom">
        © <?php echo date("Y"); ?> Crowdfunding | All Rights Reserved
    </div>

</div>

<!-- Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<style>

.footer{
    background:linear-gradient(135deg,#141e30,#243b55);
    color:white;
    padding:50px 20px 20px 20px;
    margin-top:60px;
}

.footer-container{
    display:grid;
    grid-template-columns: repeat(auto-fit,minmax(220px,1fr));
    gap:30px;
    max-width:1200px;
    margin:auto;
}

.footer-col h3{
    margin-bottom:15px;
    font-size:18px;
    border-bottom:2px solid #00c6ff;
    display:inline-block;
    padding-bottom:5px;
}

.footer-col p,
.footer-col li{
    font-size:14px;
    opacity:0.9;
    line-height:1.6;
}

.footer-col ul{
    list-style:none;
    padding:0;
}

.footer-col ul li{
    margin-bottom:8px;
}

.footer-col ul li a{
    color:white;
    text-decoration:none;
    transition:0.3s;
}

.footer-col ul li a:hover{
    color:#00c6ff;
    padding-left:5px;
}

/* Social */
.social-icons a{
    display:inline-block;
    margin-right:10px;
    width:40px;
    height:40px;
    line-height:40px;
    text-align:center;
    border-radius:50%;
    background:white;
    color:#243b55;
    transition:0.3s;
}

.social-icons a:hover{
    background:#00c6ff;
    color:white;
    transform:scale(1.1);
}

/* Newsletter */
.newsletter{
    margin-top:15px;
}

.newsletter input{
    width:70%;
    padding:8px;
    border:none;
    border-radius:5px;
    margin-bottom:8px;
}

.newsletter button{
    padding:8px 12px;
    border:none;
    border-radius:5px;
    background:#00c6ff;
    color:white;
    cursor:pointer;
    transition:0.3s;
}

.newsletter button:hover{
    background:#0096c7;
}

/* Bottom */
.footer-bottom{
    text-align:center;
    margin-top:30px;
    font-size:14px;
    opacity:0.7;
    border-top:1px solid rgba(255,255,255,0.2);
    padding-top:15px;
}

/* Responsive */
@media(max-width:768px){
    .newsletter input{
        width:100%;
    }
}

</style>

</body>
</html>