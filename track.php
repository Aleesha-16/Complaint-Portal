<?php
session_start();

header("Cache-Control: no-cache, no-store, must-revalidate");
header("Pragma: no-cache");
header("Expires: 0");

if(!isset($_SESSION['user_id'])){

    header("Location: login.php");
    exit();

}

include "db.php";
?>

<!DOCTYPE html>
<html>

<head>

<title>Track Complaints</title>

<link rel="stylesheet" href="style.css">

</head>

<body>

<?php include "sidebar.php"; ?>

<div class="main-content">

<h1> Complaint Tracking</h1>

<div class="cards-container">

<?php

$user_id = $_SESSION['user_id'];

$query = mysqli_query($conn,
"SELECT * FROM complaints
ORDER BY id DESC");

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
<b>Status:</b>

<span style="
color:
<?php
if($row['status']=='Resolved'){
    echo 'green';
}
elseif($row['status']=='In Progress'){
    echo 'orange';
}
elseif($row['status']=='Under Review'){
    echo 'blue';
}
else{
    echo 'red';
}
?>
;">

<?php echo $row['status'] ?? 'Submitted'; ?>

</span>

</p>

<p>
<b>Location:</b>
<?php echo $row['location']; ?>
</p>

<p>
<b>Priority:</b>
<?php echo $row['priority']; ?>
</p>

<p>
<b>Date:</b>
<?php echo $row['created_at']; ?>
</p>

<?php if(!empty($row['image'])){ ?>

<img
src="uploads/<?php echo $row['image']; ?>"
width="100%"
height="200"
style="object-fit:cover;border-radius:10px;margin-top:10px;"
>

<?php } ?>

</div>

<?php } ?>

</div>

</div>

</body>
</html>