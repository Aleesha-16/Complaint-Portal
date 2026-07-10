<?php
session_start();

if(!isset($_SESSION['user_id'])){

    header("Location: login.php");

}
include "db.php";

$result = mysqli_query($conn,

"SELECT * FROM complaints ORDER BY id DESC");

?>

<!DOCTYPE html>

<html>

<head>

<title>Complaints</title>

<link rel="stylesheet" href="style.css">

</head>

<body>
    <form action="filter.php">

<input
type="text"
name="search"
placeholder="Search complaint">

<button>
Search
</button>

</form>

<?php include "sidebar.php"; ?>
<div class="main-content">
<h1 class="heading">

All Complaints 📋

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

<b>Department:</b>

<?php echo $row['department']; ?>

</p>

<p>

<b>Priority:</b>

<?php echo $row['priority']; ?>

</p>

<p>

<b>Date:</b>

<?php echo $row['created_at']; ?>

</p>

<p>

<b>Status:</b>

<span class="status">

<?php echo $row['status']; ?>

</span>

</p>

<p>

<b>Comments:</b>

<?php echo $row['comments']; ?>

</p>

<img
src="uploads/<?php echo $row['image']; ?>"
width="100%"
height="200"
style="margin-top:15px;border-radius:10px;object-fit:cover;">

</div>

<?php } ?>

</div>
</div>
</body>

</html>