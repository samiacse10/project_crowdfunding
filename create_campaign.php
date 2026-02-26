<?php
include 'db.php';
include 'header.php';

if(isset($_POST['create'])){

    $title = $_POST['title'];
    $desc = $_POST['description'];
    $target = $_POST['target'];
    $image = $_FILES['image']['name'];

    move_uploaded_file($_FILES['image']['tmp_name'],"uploads/".$image);

    $organizer_id = $_SESSION['user_id'];

    mysqli_query($conn,"INSERT INTO campaigns 
        (organizer_id,title,description,target_amount,image)
        VALUES ('$organizer_id','$title','$desc','$target','$image')");
}
?>

<h2>Create Campaign</h2>

<form method="POST" enctype="multipart/form-data">
<input type="text" name="title" placeholder="Title" required>
<textarea name="description" placeholder="Description"></textarea>
<input type="number" name="target" placeholder="Target Amount" required>
<input type="file" name="image" required>
<button name="create">Submit</button>
</form>

<?php include 'footer.php'; ?>