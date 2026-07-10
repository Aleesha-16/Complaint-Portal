<?php

include "db.php";

if(isset($_GET['solve'])){

$id = $_GET['solve'];

mysqli_query($conn,

"UPDATE complaints
SET status='Resolved'
WHERE id='$id'");

}

if(isset($_POST['comment'])){

$id = $_POST['id'];

$comments = $_POST['comments'];

mysqli_query($conn,

"UPDATE complaints
SET comments='$comments'
WHERE id='$id'");

}

$result = mysqli_query($conn,

"SELECT * FROM complaints ORDER BY id DESC");

?>

<!DOCTYPE html>

<html>

<head>

<title>Admin Panel</title>

<link rel="stylesheet" href="style.css">

</head>

<body>

<?php include "navbar.php"; ?>

<h1 class="heading">

Admin Dashboard 

</h1>

<div class="cards-container">

<?php while($row=mysqli_fetch_assoc($result)){ ?>

<div class="card">

<h2>

<?php echo $row['title']; ?>

</h2>

<p>

<?php echo $row['description']; ?>

</p>

<p>

<b>Location:</b>

<?php echo $row['location']; ?>

</p>

<p>

<b>Status:</b>

<?php echo $row['status']; ?>

</p>

<p>

<b>Date:</b>

<?php echo $row['created_at']; ?>

</p>

<img
src="uploads/<?php echo $row['image']; ?>"
width="100%"
height="200"
style="margin-top:15px;border-radius:10px;object-fit:cover;">

<form method="POST">

<input
type="hidden"
name="id"
value="<?php echo $row['id']; ?>">

<textarea
name="comments"
placeholder="Add Admin Comment">
</textarea>

<button name="comment">

Add Comment

</button>

</form>

<a
href="admin.php?solve=<?php echo $row['id']; ?>"
class="btn">

Resolve Complaint

</a>

</div>

<?php } ?>

</div>

</body>

</html>