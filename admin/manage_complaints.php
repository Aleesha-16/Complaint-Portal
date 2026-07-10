<?php
include "../db.php";
session_start();

if($_SESSION['role']!="admin"){

    header("Location: ../login.php");

}
?>

<!DOCTYPE html>
<html>

<head>

<link rel="stylesheet" href="../style.css">

</head>

<body>

<div class="main-content">

<h1>📂 Manage Complaints</h1>

<div class="cards-container">

<?php

$query = mysqli_query($conn,
"SELECT * FROM complaints");

while($row=mysqli_fetch_assoc($query)){

?>

<div class="card">

<h2>
<?php echo $row['title']; ?>
</h2>

<p>
<?php echo $row['description']; ?>
</p>

<p>
Status:
<?php echo $row['tracking_status']; ?>
</p>

<img
src="../uploads/<?php echo $row['image']; ?>"
width="100%"
height="200"
style="object-fit:cover; border-radius:10px;"
>

</div>

<?php } ?>

</div>

</div>

</body>
</html>