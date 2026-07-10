<?php
session_start();

if($_SESSION['role']!="admin"){

    header("Location: ../login.php");

}
include "../db.php";
?>

<!DOCTYPE html>
<html>

<head>

<link rel="stylesheet" href="../style.css">

</head>

<body>

<div class="main-content">

<h1>👨 Users Management</h1>

<table>

<tr>

<th>ID</th>

<th>Name</th>

<th>Email</th>

<th>Role</th>

</tr>

<?php

$query = mysqli_query($conn,
"SELECT * FROM users");

while($row=mysqli_fetch_assoc($query)){

?>

<tr>

<td>
<?php echo $row['id']; ?>
</td>

<td>
<?php echo $row['name']; ?>
</td>

<td>
<?php echo $row['email']; ?>
</td>

<td>
<?php echo $row['role']; ?>
</td>

</tr>

<?php } ?>

</table>

</div>

</body>
</html>